# mukurufx

### Requirements

The Mukuru FX Package is a Laravel 5.4 Package and will only work with a working installation of Laravel 5.4
The below are all required before installing this package:

    PHP 7 
    Laravel 5.4
    MySQL DB

### Installation Instructions

Download the MukuruFX Package from : https://github.com/Peace-N/mukurufx

1. Create a Folder named packages in the root of your Laravel Installations
2. Copy the downloaded mukurufx into packages alternatively clone mukurufx into packages

### Registration Autoload PSR4

For the Package to work we need to register it under the PSR-4 Dev array, to do that use:

    "autoload-dev": {
            "psr-4": {
                "Mukuru\\MukuruFX\\": "packages/mukurufx/src"
            }
        },

### Register Service Provider

To use this Package in Laravel, you need to register the package service provider under Laravel's Config Services Provider Array.
Add the below line to: config\app.php under the 'providers' => [

     \Mukuru\MukuruFX\MukuruFXServiceProvider::class,
     
After you have registered the service provider,  open your commandline or terminal:

Run the following commands:

1. composer dump-autoload -o

### Publishing the Vendor (This will publish assets e.g css/js and config file)

1. php artisan vendor:publish

### Publishing Migrations [Database Schema] This will create database tables in your Laravel configured MySQL Database

1. php artisan migrate

### Accessing the Config File

To access the config file: config/mukurufxconfig.php

### Loading Currency Data to our Database

#### There are 2 ways to Load Live Currency Data in our DB (Let's explore both options)
1. By visiting the below endpoint: /fetchfxrates
  Example: 
  http://localhost:8000/fetchfxrates
  
2. By running a Cron Job this is setup via Laravel Scheduling that will uopdate currencies every 5 mins

    Copy the file 
       from: packages\mukurufx\src\Mukuru\MukuruFX\classes\commands\MukuruFXUpdate.php
       to:   app\Console\Commands\MukuruFXUpdate.php

    The next step in to Update the Kernel commands array as:
    
    Update the following file:  app\Console\Kernel.php

    protected $commands = [
            //
            '\App\Console\Commands\MukuruFXUpdate'
        ];

    Under the Schedule Function:

    protected function schedule(Schedule $schedule)
        {
             $schedule->command('MukuruFXUpdate:fxupdate')
                 ->everyFiveMinutes();
        }
        
   To run the schedule run the following command in your terminal in your terminal: 
    
    Php artisan MukuruFXUpdate:fxupdate
    
### Finally

Now that our Currency Table is populated with data let's visit our application view page:

http://localhost:8000/mukurufx/orders

### Application EndPoints - (optional)

#### Get Cached FX Rates from our DB:

http://localhost:8000/mukurufx/orders/latestfxrates

#### Orders Creation [Used Internally by Angular]

http://localhost:8000/mukurufx/orders/new

