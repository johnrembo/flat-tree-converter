# flat-tree-converter
php flat tree to json converter contender task

## sanity check

```
$ ./bin flattree2json tests/functional/input.csv tmp.json
$ diff tmp.json tests/functional/output.json
$ rm tmp.json
```
