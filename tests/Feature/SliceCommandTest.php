<?php

it('slice phpunit tests files', function () {
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
