# Yii2 extension to Yandex Translate API

Yandex Translate API

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require babl86/yii2-yandex-translate-api "dev-master"
```

or add

```
"babl86/yii2-yandex-translate-api": "dev-master"
```

to the ```require``` section of your `composer.json` file.

## Usage

### Create Yandex API Key (free to use)

1. Go to the [Yandex Translate API Site](https://tech.yandex.ru/translate/).
2. Create new API Key.

### Component Configuration

```php
'components' => [
    ...
    'translate' => [
        'class' => 'babl86\translate\Translation',
        'key' => 'INSERT-YOUR-API-KEY',
    ],
    ...
],
```

```php
Yii::$app->translate->translate($source, $target, $text);
```