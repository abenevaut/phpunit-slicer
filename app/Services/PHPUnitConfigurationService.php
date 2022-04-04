<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PHPUnitConfigurationService
{
    /**
     * @var null|\DOMDocument
     */
    private ?\DOMDocument $configurationFile = null;

    /**
     * @param  string  $configurationFile
     *
     * @return $this
     */
    public function setConfigurationFile(string $configurationFile): self
    {
        $this->configurationFile = new \DOMDocument();
        $this->configurationFile->load($configurationFile);

        return $this;
    }

    /**
     * @param  string  $testsDirectory
     * @param  int  $numberTestsSuites
     *
     * @return $this
     * @throws \DOMException
     * @throws \Throwable
     */
    public function generateTestsSuites(string $testsDirectory, int $numberTestsSuites = 4)
    {
        throw_if(!$this->isInitialized(), new \Exception('Configuration file is not set.'));

        $testSuites = $this->configurationFile->createElement('testsuites');

        collect(File::allFiles($testsDirectory))
            ->filter(function (string $file) {
                return Str::contains($file, 'Test.php');
            })
            ->split($numberTestsSuites)
            ->each(function ($filesList, $index) use ($testSuites) {
                $testSuite = $this->configurationFile->createElement('testsuite');
                $testSuite->setAttribute('name', "sliced-testsuite-{$index}");

                collect($filesList)
                    ->each(function ($file) use ($testSuite) {
                        $testSuite->appendChild($this->configurationFile->createElement('file', $file));
                    });

                $testSuites->appendChild($testSuite);
            });

        $phpunit = $this->configurationFile->getElementsByTagName('phpunit')->item(0);
        $phpunit->replaceChild($testSuites, $phpunit->getElementsByTagName('testsuites')->item(0));

        return $this;
    }

    /**
     * @param  string  $destination
     *
     * @return false|int
     * @throws \Throwable
     */
    public function saveTo(string $destination)
    {
        throw_if(!$this->isInitialized(), new \Exception('Configuration file is not set.'));

        return $this->configurationFile->save($destination);
    }

    /**
     * @return bool
     */
    private function isInitialized(): bool
    {
        return $this->configurationFile instanceof \DOMDocument;
    }
}
