<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    
    // View
    protected $table = 'app_vw_jobs';
    
    public static function getJobsToday($userId){
        return DB::table('app_vw_jobs_today')->where('userId', $userId)->get();
    }
    
    public static function getJobResourceConfirmation($orderId,$userId){
        return DB::table('order_resources')->where('orderId',$orderId)->where('resourceId', $userId)->first();
    }
    
    public static function getJobsComing($userId){
        return DB::table('app_vw_jobs_coming')->where('userId', $userId)->get();
    }
    
    public static function getJobsPending($userId){
        return DB::table('app_vw_jobs_pending')->where('userId', $userId)->get();
    }
    
    public static function getJobAddresses($orderId){
        return DB::table('app_vw_job_addresses')->where('orderId', $orderId)->get();
    }
    
    public static function getJobEquipments($orderId){
        return DB::table('app_vw_job_equipments')->where('orderId', $orderId)->get();
    }
    
    public static function getJobFiles($orderId){
        return DB::table('order_files')->where('orderId', $orderId)->get();
    }
    
    public static function getJobResources($orderId){
        return DB::table('app_vw_job_resources')->where('orderId', $orderId)->get();
    }
    
    public static function getCheckTime($orderId, $userId){
        return DB::table('app_vw_job_resource_check')->where('orderId', $orderId)->where('userId', $userId)->first();
    }
    
    public static function checkIn($orderId, $userId){
        return DB::select('CALL app_sp_resource_check(?, ?);', [$orderId, $userId]);
    }
    
    public static function setResourceJobConfirmation($orderId, $userId, $accepted){
        DB::update('UPDATE order_resources SET accepted = ?, updated_at = current_timestamp() WHERE orderId = ? AND resourceId = ?;', [$accepted, $orderId, $userId]);    
    }
    
    public static function getPastJobs($userId){
        return DB::table('app_vw_past_jobs')->where('userId', $userId);
    }
    
    public static function getJobDetails($orderId, $userId){
        return DB::table('app_vw_job_details')->where('orderId', $orderId)->where('userId', $userId)->first();
    }
    
    public static function getJobResourcePayments($orderId, $userId){
        return DB::table('app_vw_job_resource_payment')->where('orderId', $orderId)->where('userId', $userId)->get();
    }
    
    public static function calcJob($orderId, $timeStart, $timeEnd){
        return DB::select('CALL spCalcJobHours(?, ?, ?);', [$orderId, $timeStart, $timeEnd]);
    }
    
    public static function checkResourceLeader($orderId, $userId){
        return DB::select('SELECT 1 FROM order_resources ors WHERE orderId = ? AND resourceId = ? AND EXISTS(SELECT NULL FROM roles WHERE roleId = ors.roleId AND leader = 1)', [$orderId, $userId]);
    }
    
    public static function getCustomerJobDetails($orderId){
        return DB::table('app_vw_customer_job_details')->where('orderId', $orderId)->first();
    }
    
    public static function getJobBilling($orderId){
        return DB::table('order_billing')->where('orderId',$orderId)->first();
    }
    
    public static function updateJobBillingPayment($orderId, $proof_payment, $service){
        DB::update('UPDATE order_billing SET proof_payment = ?, checkoutService = ?, paid = 1 WHERE orderId = ?;', [$proof_payment, $service, $orderId]);
        DB::update('UPDATE orders SET orderStatusId = ? WHERE orderId = ?;', [Orders::orderStatusId_PROC_PAYMENT, $orderId]);
    }
    
    public static function getOverview($userId, $month){
        return DB::select('CALL app_user_overview(?, ?);', [$userId, $month]);
    }
    
}
