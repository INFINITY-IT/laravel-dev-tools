# Laravel Dev Tools

[![Latest Stable Version](http://poser.pugx.org/infinity-it/laravel-dev-tools/v)](https://packagist.org/packages/infinity-it/laravel-dev-tools)
[![Total Downloads](http://poser.pugx.org/infinity-it/laravel-dev-tools/downloads)](https://packagist.org/packages/infinity-it/laravel-dev-tools)
[![Latest Unstable Version](http://poser.pugx.org/infinity-it/laravel-dev-tools/v/unstable)](https://packagist.org/packages/infinity-it/laravel-dev-tools)
[![License](http://poser.pugx.org/infinity-it/laravel-dev-tools/license)](https://packagist.org/packages/infinity-it/laravel-dev-tools)

## Packages

|                                                                                                               |                                                                                                                                               |
|---------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------|
| [barryvdh/laravel-debugbar](https://packagist.org/packages/barryvdh/laravel-debugbar)                         | ![](http://poser.pugx.org/barryvdh/laravel-debugbar/v) ![](http://poser.pugx.org/barryvdh/laravel-debugbar/downloads)                         |
| [barryvdh/laravel-ide-helper](https://packagist.org/packages/barryvdh/laravel-ide-helper)                     | ![](http://poser.pugx.org/barryvdh/laravel-ide-helper/v) ![](http://poser.pugx.org/barryvdh/laravel-ide-helper/downloads)                     |
| [bestmomo/laravel5-artisan-language](https://packagist.org/packages/bestmomo/laravel5-artisan-language)       | ![](http://poser.pugx.org/bestmomo/laravel5-artisan-language/v) ![](http://poser.pugx.org/bestmomo/laravel5-artisan-language/downloads)       |
| [kitloong/laravel-migrations-generator](https://packagist.org/packages/kitloong/laravel-migrations-generator) | ![](http://poser.pugx.org/kitloong/laravel-migrations-generator/v) ![](http://poser.pugx.org/kitloong/laravel-migrations-generator/downloads) |
| [laravel-lang/common](https://packagist.org/packages/laravel-lang/common)                                     | ![](http://poser.pugx.org/laravel-lang/common/v) ![](http://poser.pugx.org/laravel-lang/common/downloads)                                     |
| [nunomaduro/collision](https://packagist.org/packages/nunomaduro/collision)                                   | ![](http://poser.pugx.org/nunomaduro/collision/v) ![](http://poser.pugx.org/nunomaduro/collision/downloads)                                   |
| [orangehill/iseed](https://packagist.org/packages/orangehill/iseed)                                           | ![](http://poser.pugx.org/orangehill/iseed/v) ![](http://poser.pugx.org/orangehill/iseed/downloads)                                           |
| [reliese/laravel](https://packagist.org/packages/reliese/laravel)                                             | ![](http://poser.pugx.org/reliese/laravel/v) ![](http://poser.pugx.org/reliese/laravel/downloads)                                             |

## Install

The recommended way to install this is through composer:

```bash
composer require --dev "infinity-it/laravel-dev-tools:1.0.0"
```

## Laravel Artisan Language

- Config file `config/artisan-language.php` <sup>*(`^1.1.0`)*</sup> :
```php

if (!class_exists('\Mohamedhk2\LaravelDevTools\Classes\RegexConfig'))
    return [];

use \Mohamedhk2\LaravelDevTools\Classes\RegexConfig;

return [
    'scan_paths' => [
        app_path(),
        resource_path('views'),
        ...
    ],
    'lang_path' => base_path('lang'),
    #
    'patterns' => [
        new RegexConfig('/(@lang|__|\$t|\$tc)\s*(\(\s*[\'"])([^$]*)([\'"]+\s*(,[^\)]*)*\))/U', 3),
        new RegexConfig('/(?:trans|__)\s*\(\s*(?:"((?:[^"]|\\")+)"|\'((?:[^\']|\\\')+)\')\s*(?:,\s*[^)]*\s*)?\)/U', 1, function ($regConf, $out) {
            /**
             * @var $regConf RegexConfig
             */
            return array_values(array_filter(array_merge($out[1], $out[2])));
        }),
    ]
];
```

- usage : [README](https://github.com/bestmomo/laravel-artisan-language?tab=readme-ov-file#readme)

## License

The Laravel Dev Tools is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
