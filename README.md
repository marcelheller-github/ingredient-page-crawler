# Ingredient Name Importer

## Install Dependencies

Dependencies have to be installed with [composer](https://getcomposer.org/):

``` bash
$ composer install
```

## Install Dev Tooling

Developement tools have to be installed with [phive](https://phar.io/#Install):

``` bash
$ phive install
```

## Run the tests

Unit tests:

``` bash
$ ./tools/phpunit
```

Mutation tests:

``` bash
$ ./tools/infection
```

## Run static analyzer

Run the static code analyzer:

``` bash
$ PHAN_DISABLE_XDEBUG_WARN=1 PHAN_ALLOW_XDEBUG=0 ./tools/phan
```

## Run code style check

Run the [code style check](https://github.com/squizlabs/PHP_CodeSniffer):

``` bash
$ ./tools/phpcs src tests
```

