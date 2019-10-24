<?php
 namespace MDHossain\laravelLogs;
 use Illuminate\Support\ServiceProvider;
 use MDHossain\laravelLogs\Contracts\ActivityLogInterface;
 use MDHossain\laravelLogs\Services\ActivityLogService;
 class ContactFormServiceProvider extends ServiceProvider {
     public function boot()
     {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'contactform');
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
        $this->app->bind(ActivityLogInterface::class, ActivityLogService::class);
     }
     public function register()
     {
         
     }
 }