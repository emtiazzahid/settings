# Kodeeo-Setting
Persistent settings for Laravel.

## Installation

1. Kodeeo-Setting is a Laravel package so you can install it via Composer. Run this command in your terminal from your project directory:

    ```sh
    composer require kodeeo/settings
    ```
    This will both update composer.json and install the package into the vendor/ directory.

2. Register the package
    * Laravel 5.5 and up Uses package auto discovery feature, no need to edit the config/app.php file.

    * Laravel 5.4 and below Register the package with laravel in config/app.php under providers with the following:
    ```
    'providers' => [
            Kodeeo\Settings\Providers\SettingsServiceProvider::class,
        ];
    ```

3. Now run this command in your terminal to publish this package resources:

    ```
    php artisan vendor:publish --provider="Kodeeo\Settings\Providers\SettingsServiceProvider"
    ```
4. (Optional) Customize
    * If you want to customize the table name and columns name you can change the values in 
    config\kodeeo-settings.php file
    * After that to reset the configuration values please run this command:
    ```php
    php artisan config:cache
    ``` 
5. Now run this command in your terminal to migrate the table in your database:
    ```php
    php artisan migrate
    ``` 
    
## Using Settings Model
Use `SettingsEloquent` model in your controller.

## Example
   ```
    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    use App\Http\Requests;
    use Kodeeo\Settings\Models\SettingsEloquent;

    class TestController extends Controller
    {
        public function test()
        {
            SettingsEloquent::set('email', 'test@mail.com');
            $settings = SettingsEloquent::all();
            dd($settings->toArray());
        }
    }

    ```

## API List
- [all](https://github.com/kodeeo/settings#all)
- [set](https://github.com/kodeeo/settings#set)
- [get](https://github.com/kodeeo/settings#get)
- [has](https://github.com/kodeeo/settings#has)
- [forget](https://github.com/kodeeo/settings#current)

### all

For getting all settings value paired by key you can use `all` method.

```php
YourSettingModel::all(); // return collection
```

### set

For set value you can use `set` method.

```php
YourSettingModel::set('key', 'value'); // return null
```
Multiple data store by key
```php
YourSettingModel::set(['key1' => 'value', 'key2' => ['subkey2' => 'value-of-subkey2'] ]); // return null
```

### get

For get value you can use `get` method.

```php
YourSettingModel::get('key'); // return collection or string or null
```
Fallback Support:
```php
YourSettingModel::get('key2.subkey2'); // return collection or string or null
```
You can also getting all setting value
```php
YourSettingModel::get(); // return collection
```

### has 
For checking key exists or not you can use `has` method.

```php
YourSettingModel::has('key'); // return bool
```
Multiple key Forget:
```php
YourSettingModel::has(['key1', 'key2']); // return collection
```

### forget

For delete key you can use `forget` method.

```php
YourSettingModel::forget('key'); // return integer 0 or 1
```
Multiple key Forget:
```php
YourSettingModel::forget(['key1', 'key2']); // return interger - how many key successfully delete.
```

## Helper
Get / set the specified setting value. If an array is passed as the key, we will assume you want to set an array of values.

```
$value = settings('app.timezone');
$value = settings('app.timezone', $default);
```
You may set settings variables by passing an array of key / value pairs:
```
settings(['app.debug' => true]);
```

