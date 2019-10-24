# How to use Audit and Error Logs in your laravel app
A Laravel package is a set of reusable classes created to add extra functionality to a Laravel website. In clearer terms, a package is to Laravel, what plugins are to WordPress. The primary goal of Laravel packages is to reduce development time by making reusable features into a set of standalone classes that can be used within any Laravel project.

[View tutorial](https://pusher.com/tutorials/publish-laravel-packagist)

## Getting Started
- Create a fresh laravel package

```
composer create-project --prefer-dist laravel/laravel packagetestapp 
```
- change directory to the new folder

```
cd packagetestapp
```

- When it's done you need to configure your env file and set your app key and other necessary details. In your terminal type:

```
cp .env.example .env
```

- generate the app key

```
php artisan key:generate
```
- create a folder called `packages`, then create a new folder called samuelayo. 
> Note that you can subtitute samuelayo with your own vendor name. Be sure to change the refrence in every other aspect of the app

- clone this repository to the newly created folder

 
- You can install the package via composer::

```
composer require mdhossain/laravel-logs

```
 

- Next, we need to add our new Service Provider in our `config/app.php` inside the `providers` array:

```
'providers' => [
         ...,
            App\Providers\RouteServiceProvider::class, 
            // Our new package class
            Mdhossain\LaravelLogs\LaravelLogsServiceProvider::class,
         ],
```
- Migrate the database tables

```
php artisan migrate:refresh

```

- You can use  your controller for log data save:

```
use MDHossain\laravelLogs\Contracts\ActivityLogInterface;

public function insertUser(ActivityLogInterface $activitylog){
    
    $activitylog->dataSave($id=null, $log_description, $data, $log_title, $log_type);
    
}

```


- You can browse for log show:

```
http://localhost:8000/audit-log
http://localhost:8000/error-log

```

OR 

- Call your controller view

```
return view('laravel-logs::auditlogs.audit-log');
return view('laravel-logs::errorlogs.error-log');

```

And finally, start the application by running:

```
php artisan serve
```

Visit http://localhost:8000/ in your browser to view the demo.



## Built With

* [Laravel](https://laravel.com/) - The PHP framework for web artisans.
        