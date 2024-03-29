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
class AuditLogsController extends Controller {

    public function __construct() {

    }

    public function auditLogs(Request $request, ActivityLogInterface $activityLogs) {

        $data = $activityLogs->getAllAuditLogs();
        return view('laravel-logs::auditlogs.audit-log-grid', ['data' => $data]);
    }

    public function index(Request $request, ActivityLogInterface $activityLogs) {


        $requestData = $request->all();
        $data = $activityLogs->allAuditLogs($requestData);
        $url = "audit-log-print";
        return view('laravel-logs::auditlogs.audit-log', ['data' => $data, 'url' => $url]);
    }

    public function ajax(Request $request, ActivityLogInterface $activityLogs) {



        try {
            $filters = $request->all();
           $data = $activityLogs->allAuditLogs($filters);
           // echo "<pre>";
            //print_r($data);

//            print_r($data);die;
            return view('laravel-logs::auditlogs.audit-log-grid', ["data" => $data]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function _print(Request $request, ActivityLogInterface $activityLogs) {

        try {
            $filters = $request->all();
            $data = $activityLogs->allAuditLogs($filters);

//            print_r($data);die;
            return view('laravel-logs::auditlogs.audit-log-print', ["data" => $data, "request" => $filters]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
