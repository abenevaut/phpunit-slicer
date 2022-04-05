# PHPUnit-slicer

Tool to slice PHPUnit tests files to tests suites.

## Install

### Install in project

```
composer require --dev abenevaut/phpunit-slicer
```

### Install globally
```
composer global require abenevaut/phpunit-slicer
```

## Usage

```
vendor/bin/phpunit-slicer slice 4 ./phpunit.xml.dist ./phpunit.xml ./tests
```

```
phpunit-slicer slice 4 ./phpunit.xml.dist ./phpunit.xml ./tests
```

```
vendor/bin/phpunit --testsuite sliced-testsuite-0 --configuration phpunit.xml
vendor/bin/pest --testsuite sliced-testsuite-1 --configuration phpunit.xml
php artisan test --testsuite sliced-testsuite-2 --configuration phpunit.xml
php laravel-zero-project test --testsuite sliced-testsuite-3 --configuration phpunit.xml
```
