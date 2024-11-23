# phpunit-slicer documentation

PHPUnit-slicer is a tool to split a PHPUnit test suite into multiple test suites.

## Install

### From latest release
PHPUnit-slicer binary is available on [release page](https://github.com/abenevaut/phpunit-slicer/releases/latest)

```bash
curl -L -o phpunit-slicer https://github.com/abenevaut/phpunit-slicer/releases/latest/download/phpunit-slicer
chmod +x phpunit-slicer
```

A hash file is available to check the integrity of the binary.

```bash
curl -L -o phpunit-slicer https://github.com/abenevaut/phpunit-slicer/releases/latest/download/phpunit-slicer.sha512sum
sha512sum -c phpunit-slicer.sha512sum
```

### From composer
Or, you can install the tool locally or globally with composer, depending on your usage.

```bash
composer require abenevaut/phpunit-slicer
```

```bash
composer global require abenevaut/phpunit-slicer
```

- [Packagist](https://packagist.org/packages/abenevaut/phpunit-slicer)

## Usage
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
