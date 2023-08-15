# flat-tree-converter
PHP Flat tree to JSON converter contender task

## Sanity check

```
$ ./bin flattree2json tests/sanity/input.csv tests/sanity/tmp.json
$ diff tmp.json tests/sanity/output.json
$ rm tmp.json
```
