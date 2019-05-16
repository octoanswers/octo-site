# Simple Translator

Sample directory structure

```shell
 app/
 |-- lang/
 |    |-- en/
 |    |    |-- main.json
 |    |    |-- home-page.json
 |    |-- ru/
 ...
```

``en`` ``en_US``


```php
use Gomzyakov\Translator;

$translator = new Translator('ru', ROOT_PATH."/app/lang");
```

https://laravel.com/docs/5.8/localization