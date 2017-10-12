# Kodeeo-Setting
Persistent settings in Laravel

### Features

* Settings

## Installation

Kodeeo-Setting is a Laravel package so you can install it via Composer. Run this command in your terminal from your project directory:

```sh
composer require kodeeo/settings
```

## Use Traits
Use `GeTraits` traits in your model.


## API List
- [set](https://github.com/kodeeo/settings#set)
- [get](https://github.com/kodeeo/settings#get)
- [forget](https://github.com/kodeeo/settings#current)
- [has](https://github.com/kodeeo/settings#has)

### set

For set value you can use `set` method.

```php
YourSettingModel::set('key', 'value');
```

### get

For get value you can use `get` method.

```php
YourSettingModel::get('key');
```

### forget

For delete key you can use `forget` method.

```php
YourSettingModel::forget('key');
```

### has 

coming soon...
