<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */


namespace Mdhossain\LaravelLogs\Http\Controllers;

use Mdhossain\LaravelLogs\Models\ActivityLog;
use Mdhossain\LaravelLogs\Contracts\ActivityLogInterface;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Class AuditLogsController
 * @package App\Http\Controllers\Admin\Report
 */
class ErrorLogsController extends Controller {

    private $activityLogs;

    public function __construct(ActivityLogInterface $activityLogs) {
        $this->activityLogs = $activityLogs;
    }

    // public function getLogData() {

    //          return $this->activityLogs->allErrorLogs();
    // }

    public function getAllErrorLogs(ActivityLogInterface $activityLogs) {

        $data = $activityLogs->allErrorLogs();
        return view('laravel-logs::errorlogs.error-log-grid', ['data' => $data]);
    }
    public function index(Request $request, ActivityLogInterface $activityLogs) {


        $requestData = $request->all();
        $data = $activityLogs->allErrorLogs($requestData);
        $url = "error-log-print";
        return view('laravel-logs::errorlogs.error-log', ['data' => $data, 'url' => $url]);
    }

    public function ajax(Request $request, ActivityLogInterface $activityLogs) {



        try {
            $filters = $request->all();
           $data = $activityLogs->allErrorLogs($filters);
           // echo "<pre>";
            //print_r($data);

//            print_r($data);die;
            return view('laravel-logs::errorlogs.error-log-grid', ["data" => $data]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function _print(Request $request, ActivityLogInterface $activityLogs) {

        try {
            $filters = $request->all();
            $data = $activityLogs->allErrorLogs($filters);

//            print_r($data);die;
            return view('laravel-logs::errorlogs.error-log-print', ["data" => $data, "request" => $filters]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
