<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */


namespace MDHossain\laravelLogs\Http\Controllers;

use MDHossain\laravelLogs\Models\ActivityLog;
use MDHossain\laravelLogs\Contracts\ActivityLogInterface;
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

    public function index(Request $request, ActivityLogInterface $activityLogs) {
        
      
        $requestData = $request->all();
        $data = $activityLogs->allErrorLogs($requestData);
        $url = "report/error-log-print";
        return view('errorlogs.error-log', ['data' => $data, 'url' => $url]);
    }

    public function ajax(Request $request, ActivityLogInterface $activityLogs) {

   

        try {
            $filters = $request->all();
           $data = $activityLogs->allErrorLogs($filters);
           // echo "<pre>";
            //print_r($data);

//            print_r($data);die;
            return view('adminlte::report.error-log-grid', ["data" => $data]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function _print(Request $request, ActivityLogInterface $activityLogs) {

        try {
            $filters = $request->all();
            $data = $activityLogs->allErrorLogs($filters);

//            print_r($data);die;
            return view('adminlte::report.error-log-print', ["data" => $data, "request" => $filters]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
