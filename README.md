# PHPUnit-slicer

Tool to slice PHPUnit tests files to tests suites.

- [Real use case with circleci.com](https://medium.com/@abenevaut/paralize-circleci-php-pipelines-61a0b8c21ac2)

## Install

- [Available on Packagist.org - abenevaut/phpunit-slicer](https://packagist.org/packages/abenevaut/phpunit-slicer)

### In PHP project
```shell
composer require --dev abenevaut/phpunit-slicer
```

#### Usage
```shell
vendor/bin/phpunit-slicer slice 4 ./phpunit.xml.dist ./phpunit.xml ./tests
```

### Globally
```shell
composer global require abenevaut/phpunit-slicer
```

#### Usage
```shell
phpunit-slicer slice 4 ./phpunit.xml.dist ./phpunit.xml ./tests
```

### Use cases
```shell
vendor/bin/phpunit --testsuite sliced-testsuite-0 --configuration phpunit.xml
vendor/bin/pest --testsuite sliced-testsuite-1 --configuration phpunit.xml
php artisan test --testsuite sliced-testsuite-2 --configuration phpunit.xml
php laravel-zero-project test --testsuite sliced-testsuite-3 --configuration phpunit.xml
```

## Build
```shell
php phpunit-slicer app:build phpunit-slicer
php phpunit-slicer app:build phpunit-slicer --build-version=0.0.X
```
