<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers\Admin\ActivityLogs;
use App\Contracts\ActivityLogInterface;
use App\Models\ActivityLog;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Class AuditLogsController
 * @package App\Http\Controllers\Admin\Report
 */
class AuditLogsController extends Controller {

    public function __construct() {
        
    }

    public function index(Request $request, ActivityLogInterface $activityLogs) {
        
      
        $requestData = $request->all();
        $data = $activityLogs->allAuditLogs($requestData);
        $url = "report/audit-log-print";
        return view('adminlte::report.audit-log', ['data' => $data, 'url' => $url]);
    }

    public function ajax(Request $request, ActivityLogInterface $activityLogs) {

   

        try {
            $filters = $request->all();
           $data = $activityLogs->allAuditLogs($filters);
           // echo "<pre>";
            //print_r($data);

//            print_r($data);die;
            return view('adminlte::report.audit-log-grid', ["data" => $data]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function _print(Request $request, ActivityLogInterface $activityLogs) {

        try {
            $filters = $request->all();
            $data = $activityLogs->allAuditLogs($filters);

//            print_r($data);die;
            return view('adminlte::report.audit-log-print', ["data" => $data, "request" => $filters]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
