

## How to check JavaScript JSON syntax from the command line
~~~
https://askubuntu.com/questions/876815/json-validator-in-ubuntu-16-04
https://www.xmodulo.com/validate-json-command-line-linux.html
https://www.commandlinefu.com/commands/view/24247/use-jq-to-validate-and-pretty-print-json-output
https://formulae.brew.sh/formula/jsonlint
https://github.com/stedolan/jq/issues/1637
https://github.com/stedolan/jq/issues/1539
https://lindevs.com/install-jq-on-ubuntu/
https://stackoverflow.com/questions/6041741/fastest-way-to-check-if-a-string-is-json-in-php
https://www.codegrepper.com/code-examples/php/check+if+is+valid+json+php
https://arjunphp.com/check-is-a-string-valid-json-php/
~~~


```php
function isJson($string) {
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}
```

### node
```
node --check some.js
node --check some-invalid.js
jshint --verbose test.js
```

### jsonlint
```
sudo apt install jsonlint
jsonlint test.json
```

### jq
```
sudo apt-get install jq -y
jq . may-file.json
cat file.json | jq
jq '.' test.json
echo '123' | jq .
echo '{"a": 1' | jq type
```

```
Some of the options include:
-c               compact instead of pretty-printed output;
-n               use `null` as the single input value;
-e               set the exit status code based on the output;
-s               read (slurp) all inputs into an array; apply filter to it;
-r               output raw strings, not JSON texts;
-R               read raw strings, not JSON texts;
-C               colorize JSON;
-M               monochrome (don't colorize JSON);
-S               sort keys of objects on output;
--tab            use tabs for indentation;
--arg a v        set variable $a to value <v>;
--argjson a v    set variable $a to JSON value <v>;
--slurpfile a f  set variable $a to an array of JSON texts read from <f>;
--rawfile a f    set variable $a to a string consisting of the contents of <f>;
--args           remaining arguments are string arguments, not files;
--jsonargs       remaining arguments are JSON arguments, not files;
```


### python
```
python -m json.tool file.json
```

### json-spec
```
sudo pip install json-spec
json validate --schema-file=schema.json --document-file=data.json
json validate --schema-file=schema.json < data.json
json validate --schema-file=schema.json --document-json='{"foo": ["bar", "baz"]}'
```

