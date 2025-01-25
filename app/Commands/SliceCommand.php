<?php

namespace App\Commands;

use App\Rules\DirectoryExistsRule;
use App\Rules\FileExistsRule;
use App\Services\PHPUnitConfigurationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class SliceCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'slice {number-tests-suites : Number of tests suites to generate}
        {phpunit-configuration : Path to phpunit.xml.dist (or phpunit.xml) to add generated tests suites}
        {phpunit-configuration-destination : Path to save phpunit.xml with generated tests suites}
        {tests-directory : Path to tests directory where to search tests. All tests should end with "Test.php"}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Slice PHPUnit tests files to tests suites.';

    /**
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handle()
    {
        $validator = Validator::make([
            'number-tests-suites' => $this->argument('number-tests-suites'),
            'phpunit-configuration' => $this->argument('phpunit-configuration'),
            'phpunit-configuration-destination' => $this->argument('phpunit-configuration-destination'),
            'tests-directory' => $this->argument('tests-directory'),
        ], [
            'number-tests-suites' => 'integer|min:1',
            'phpunit-configuration' => [new FileExistsRule()],
            'phpunit-configuration-destination' => 'required',
            'tests-directory' => [new DirectoryExistsRule()],
        ]);

        if ($validator->errors()->any() === true) {
            foreach ($validator->errors()->all() as $errorMessage) {
                $this->error($errorMessage);
            }

            return self::FAILURE;
        }

        resolve(PHPUnitConfigurationService::class)
            ->setConfigurationFile($validator->validate()['phpunit-configuration'])
            ->generateTestsSuites(
                $validator->validate()['tests-directory'],
                $validator->validate()['number-tests-suites']
            )
            ->saveTo($validator->validate()['phpunit-configuration-destination']);

        $this->info("PHPUnit.xml sliced at {$validator->validate()['phpunit-configuration-destination']}");

        return self::SUCCESS;
    }
}
