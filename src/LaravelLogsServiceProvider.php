<?php
namespace Mdhossain\LaravelLogs;
use Illuminate\Support\ServiceProvider;
use Mdhossain\LaravelLogs\Contracts\ActivityLogInterface;
use Mdhossain\LaravelLogs\Services\ActivityLogService;
class LaravelLogsServiceProvider extends ServiceProvider {
    public function boot()
    {
       $this->loadRoutesFrom(__DIR__.'/routes/web.php');
       $this->loadViewsFrom(__DIR__.'/resources/views', 'laravelLogs');
       $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
       $this->app->bind(ActivityLogInterface::class, ActivityLogService::class);
    }
    public function register()
    {

    }
}
