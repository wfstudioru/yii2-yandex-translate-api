# Yii2 extension to Yandex Translate API

Yandex Translate API

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require wfstudioru/yii2-yandex-translate-api "dev-master"
```

or add

```
"wfstudioru/yii2-yandex-translate-api": "dev-master"
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
        'class' => 'wfstudioru\translate\Translation',
        'key' => 'INSERT-YOUR-API-KEY',
    ],
    ...
],
```

```php
Yii::$app->translate->translate($source, $target, $text);
```

### Usage

```php
Yii::$app->translate->translate('en-US', 'ru-RU', 'Hi everybody!');
```

the response would be:

```php 
array (
    'code' => 200,    
    'lang' => 'en-ru',
    'text' => array (
        0 => 'Привет всем!' 
                   )
      )

```
