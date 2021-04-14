# aimon-laravel
Laravel wrapper package for the Aimon.it API

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
