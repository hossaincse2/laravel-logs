<?php

namespace Mdhossain\LaravelLogs\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class ActivityLog extends Model {

    //use SoftDeletes;
   protected $table = "activity_logs";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'log_type', 'long_text', 'request_uri', 'client_ip', 'user_id', 'store_id', 'factory_id'
    ];

        protected $with = ['user'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        ''
    ];

     
}
