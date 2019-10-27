# How to use Audit and Error Logs in your laravel app
 Its easy to use in your laravel app. You can save all audit and error log type data and then also show all in your laravel app. Easy to track your actions and also find errors from your application by using this package. All logs are stored in database in this package.

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

- You can use  your controller for log data show:

```
use MDHossain\laravelLogs\Contracts\ActivityLogInterface;

public function showLogs(ActivityLogInterface $activitylog){
    
    For audit logs
    $activitylog->getAllAuditLogs();

    For error logs
    $activitylog->getAllErrorLogs();
    
}

```

- You can use  your controller for log data show by date wise search:

```
use MDHossain\laravelLogs\Contracts\ActivityLogInterface;

public function filterLogs(ActivityLogInterface $activitylog){
    
    For audit logs Search by to date and from date
    $activitylog->allAuditLogs($search = array();

    For error logs Search by to date and from date
    $activitylog->allErrorLogs($search = array();
    
}

```


- You can browse for log show:

```
http://localhost:8000/audit-log
http://localhost:8000/error-log

```

OR 

- Call your controller direct view

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
        