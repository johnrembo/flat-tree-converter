# Flat Tree to JSON converter

Flat tree to json converter contender test task implementation

## Dependencies

POSIX shell
PHP >= 8
Composer >= 2.4.4

## Deploy

Clone, run composer install
```
$ composer install
```

## Usage

```
$ bin/flattree2json <input-file-path> <output-file-path>
```

## Unit test

```
$ composer exec --verbose phpunit tests
```

## Functional test

```
$ bin/flattree2json tests/functional/input.csv tmp.json
$ diff tmp.json tests/functional/output.json
$ rm tmp.json
```

&copy; 2023, Rembo
