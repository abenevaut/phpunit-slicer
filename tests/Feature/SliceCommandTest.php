<?php

use Symfony\Component\Console\Exception\RuntimeException;

it('slice without argument', function () {
    $this->artisan('slice');
})->throws(RuntimeException::class);

it('slice with wrong arguments', function () {
    $this
        ->artisan('slice', [
            'number-tests-suites' => 0,
            'phpunit-configuration' => 'badpath',
            'phpunit-configuration-destination' => 'badpath',
            'tests-directory' => 'badpath'
        ])
        ->assertExitCode(1)
        ->expectsOutput('The number-tests-suites must be at least 1.')
        ->expectsOutput('The phpunit-configuration must be a valid file path.')
        ->expectsOutput('The tests-directory must be a valid directory path.');
});

it('slice', function () {
    $destination = base_path('phpunit.xml.test');

    $this
        ->artisan('slice', [
            'number-tests-suites' => 4,
            'phpunit-configuration' => base_path('phpunit.xml.dist'),
            'phpunit-configuration-destination' => $destination,
            'tests-directory' => base_path('tests')
        ])
        ->assertExitCode(0)
        ->expectsOutput("PHPUnit.xml sliced at {$destination}");
});
