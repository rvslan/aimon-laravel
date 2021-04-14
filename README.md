Laravel Aimon Package
=====================

A laravel wrapper package for the Aimon.it API.

For more information see [Aimon](https://www.aimon.it/)

[![License](https://poser.pugx.org/rvslan/aimon-laravel/license)](https://packagist.org/packages/rvslan/aimon-laravel) [![Total Downloads](https://poser.pugx.org/rvslan/aimon-laravel/downloads)](https://packagist.org/packages/rvslan/aimon-laravel) [![Coverage Status](https://coveralls.io/repos/github/rvslan/aimon-laravel/badge.svg)](https://coveralls.io/github/rvslan/aimon-laravel)


## Requirements ##

Laravel 6 or later


Installation
------------
Installation is a quick 2 step process:

1. Download aimon-laravel using composer
2. Configure your Aimon credentials

### Step 1: Download aimon-laravel using composer

Add rvslan/aimon-laravel by running the command:

```
composer require rvslan/aimon-laravel
```


### Step 2: Configure Aimon credentials

```
php artisan vendor:publish --provider="Rvslan\Aimon\AimonServiceProvider"
```

Add this in you **.env** file

```
AIMON_SMS_LOGIN=your_login // without @aimon.it
AIMON_SMS_PASSWD=your_password
AIMON_ID_API=your_id_api
AIMON_DATABASE_LOG=true // set false if database log is not required
```

Usage
-----

```php
<?php

$sms = app('aimon')->sendSms([
        'to' => '391234567891', // mobile including country code
        'from' => 'Workgroup',
        'text' => 'Hello world',
    ]); // the second parameter is optional if database log is disabled
````
