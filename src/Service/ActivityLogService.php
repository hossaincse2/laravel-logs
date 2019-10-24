<?php

namespace Mdhossain\LaravelLogs\Services;

use Mdhossain\LaravelLogs\Models\ActivityLog;
use Mdhossain\LaravelLogs\Contracts\ActivityLogInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityLogService implements ActivityLogInterface {

    private $activitylogEloquent;

    /**
     *
     * @param ActivityLogInterface $activityLogInterface
     */
    public function __construct(ActivityLog $activityLog) {
        $this->activitylogEloquent = $activityLog;
    }

    /**
     * @param array $search
     * @return array
     */
    public function dataSave($id, $log_txt, $ArrayDataByID, $log_title, $log_type) {

        //echo "100"; exit;
//        print_r($data);
//        exit;
        // User Login Information
        $user_id = Auth::user()->id;
        $store_id = (NULL);
        $factory_id = (NULL);

        if (Auth::User()->hasGroup('store-admin')) {
            $store_id = Auth::user()->store_id;
        }
        if (Auth::User()->hasGroup('factory-admin')) {
            $factory_id = Auth::user()->factory_id;
        }


        // User PC IP AND Client IP AND URL Information
        $myPcIP = getHostByName(getHostName());
        //echo $browser = $_SERVER['HTTP_USER_AGENT'];
        $clientIPaddress = request()->ip();
        $clientUrl = request()->url();
        //$uri = \Request::getRequestUri();
        $macaddress = $this->macaddress();


        if ($log_type == "audit_log") {
            //$log_txt = preg_replace('#,(\s+|)\)#', '$1)', var_export($log_txt, true));
            //$log_txt = '' . PHP_EOL . $log_txt . ';';
             $log_txt = $this->auditLogDescription($id, $log_txt, $ArrayDataByID);
             
             if($log_txt==false){
                 return false;
             }
            
            
        
        }


        $actiVityLog = $this->activitylogEloquent;
        $actiVityLog->title = $log_title;
        $actiVityLog->log_type = $log_type;
        $actiVityLog->long_text = $log_txt;
        $actiVityLog->request_uri = $clientUrl;
        $actiVityLog->client_ip = $myPcIP;
        $actiVityLog->user_id = $user_id;
        $actiVityLog->store_id = $store_id;
        $actiVityLog->factory_id = $factory_id;

        $actiVityLog->save();
        //print_r(DB::getQueryLog());exit;
    }

    /**
     * @param array $data
     * @return array
     */
    public function macaddress() {

        ob_start();
//Get the ipconfig details using system commond
        system('ipconfig /all');

// Capture the output into a variable
        $mycom = ob_get_contents();
// Clean (erase) the output buffer
        ob_clean();

        $findme = "Physical";
//Search the "Physical" | Find the position of Physical text
        $pmac = strpos($mycom, $findme);

// Get Physical Address
        $mac = substr($mycom, ($pmac + 36), 17);
//Display Mac Address
        return $mac;
    }

    public function allAuditLogs($search = array()) {



        $auditLogs = $this->activitylogEloquent;

        //store

        if (isset($search['user_type']) && $search['user_type'] == "store") {
            $store_id = Auth::user()->store_id;
            $auditLogs = $auditLogs->where("store_id", "=", $store_id);
        }

        if (isset($search['user_type']) && $search['user_type'] == "factory") {
            $factory_id = Auth::user()->factory_id;
            $auditLogs = $auditLogs->where("factory_id", "=", $factory_id);
        }


        $auditLogs = $auditLogs->where("log_type", "=", "audit_log");

        if ((isset($search['start_at']) && isset($search['end_at'])) && ($start_at = $search['start_at'] && $end_at = $search['end_at'])) {
            $search['end_at'] = $search['end_at'] . " 23:59:59";
            $search['start_at'] = $search['start_at'] . " 00:00:00";
            $auditLogs = $auditLogs->where("created_at", ">=", $search['start_at'])->where("created_at", "<=", $search['end_at']);
        } else if (isset($search['start_at']) && $start_at = $search['start_at']) {
            $search['start_at'] = $search['start_at'] . " 00:00:00";
            $auditLogs = $auditLogs->where("created_at", ">=", $start_at);
        } else if (isset($search['end_at']) && $end_at = $search['end_at']) {
            $search['end_at'] = $search['end_at'] . " 23:59:59";
            $search['start_at'] = $search['start_at'] . " 00:00:00";
            $auditLogs = $auditLogs->where("created_at", "<=", $end_at);
        }

        return $auditLogs->orderBy('id', 'desc')->get();
        //echo $auditLogs->toSql();exit;
        //dd(DB::getQueryLog());
    }

    public function allErrorLogs($search = array()) {

        $auditLogs = $this->activitylogEloquent;

        //store

        if (isset($search['user_type']) && $search['user_type'] == "store") {
            $store_id = Auth::user()->store_id;
            $auditLogs = $auditLogs->where("store_id", "=", $store_id);
        }

        if (isset($search['user_type']) && $search['user_type'] == "factory") {
            $factory_id = Auth::user()->factory_id;
            $auditLogs = $auditLogs->where("factory_id", "=", $factory_id);
        }


        $auditLogs = $auditLogs->where("log_type", "=", "error_log");

        if ((isset($search['start_at']) && isset($search['end_at'])) && ($start_at = $search['start_at'] && $end_at = $search['end_at'])) {
            $search['end_at'] = $search['end_at'] . " 23:59:59";
            $search['start_at'] = $search['start_at'] . " 00:00:00";
            $auditLogs = $auditLogs->where("created_at", ">=", $search['start_at'])->where("created_at", "<=", $search['end_at']);
        } else if (isset($search['start_at']) && $start_at = $search['start_at']) {
            $search['start_at'] = $search['start_at'] . " 00:00:00";
            $auditLogs = $auditLogs->where("created_at", ">=", $start_at);
        } else if (isset($search['end_at']) && $end_at = $search['end_at']) {
            $search['end_at'] = $search['end_at'] . " 23:59:59";
            $search['start_at'] = $search['start_at'] . " 00:00:00";
            $auditLogs = $auditLogs->where("created_at", "<=", $end_at);
        }

        return $auditLogs->orderBy('id', 'desc')->get();
        //echo $auditLogs->toSql();exit;
        //dd(DB::getQueryLog());
    }

    public function auditLogDescription($id, $requestExcept, $ArrayDataByID) {

        
        if ($id) {
            $changeArray = array_diff_assoc($requestExcept, $ArrayDataByID); // only unique value return  [activated_at => 2019-10-02, issued_at => 2019-10-02]
            $changeKeys = array_keys($changeArray); // only key value return   [0 => activated_at, 1=> issued_at]
                
          // echo count($changeKeys); exit;
            
  
            if(count($changeKeys)<1){
                return false; 
            }
                // [id=>1, activated_at=>2019-10-02,issued_at=>2019-10-02]   // [activated_at=>0,issued_at=>1]
               
            $oldArray = array_intersect_key($ArrayDataByID, array_flip($changeKeys));  // Match value return [activated_at=>2019-10-02 00:00:00,issued_at=>2019-10-02 00:00:00]
            
            
            $newArray = array();

            foreach ($oldArray as $key => $value) {
                $newArray["old_" . $key] = $value;
            }

            $merge_array = array_merge($newArray, $changeArray); 
            $oldvalueNewValue = "";
            foreach ($merge_array as $key => $value) {
                $oldvalueNewValue.=$key . "=" . $value . ", ";
            } 
            return $oldvalueNewValue = rtrim($oldvalueNewValue, ', ');
        } else {
             foreach ($requestExcept as $key => $value) {
                $NewValue.=$key . "=" . $value . ", ";
            }
             return $NewValue = rtrim($NewValue, ', ');
        }
    }

}
