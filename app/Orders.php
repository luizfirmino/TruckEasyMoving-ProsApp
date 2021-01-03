<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    
    protected $fillable = [
        'orderStatusId',
        'customerId',
        'orderServiceId',
        'orderSourceId',
        'dateSchedule',
        'timeSchedule',
        'notes',
        'duration'
    ];
    
    protected $primaryKey = 'orderId';
    
    // ORDER STATUS
    public const orderStatusId_RECEIVED = 1;
    public const orderStatusId_BOOKED = 2;
    public const orderStatusId_IN_PROGRESS = 3;
    public const orderStatusId_PENDING_PAYMENT = 7;
    public const orderStatusId_PROC_PAYMENT = 8;
    public const orderStatusId_PAID = 5;
    public const orderStatusId_CANCELLED = 6;
    public const orderStatusId_ARQUIVED = 4;
    
    public static function GetOrders($request){

        $orders = DB::table('adm_vw_orders');
        
        if (!empty($request->get('q_orderStatusId'))){
            $orders->where('orderStatusId', '=', $request->get('q_orderStatusId'));
        }
        
        if (!empty($request->get('q_orderServiceId'))){
            $orders->where('orderServiceId', '=', $request->get('q_orderServiceId'));
        }
        
        if (!empty($request->get('q_customer'))){
            $orders->where('firstName', 'like', $request->get('q_customer') . '%');
        }
        
        if (!empty($request->get('q_contractNumber'))){
            $orders->where('contractNumber', 'like', $request->get('q_contractNumber') . '%');
        }
        
        if (!empty($request->get('q_phoneNumber'))){
            $orders->where('phoneNumber', 'like', $request->get('q_phoneNumber') . '%');
        }
        
        if (!empty($request->get('q_dateSchedule'))){
            $orders->where('dateSchedule', '=', $request->get('q_dateSchedule') );
        }
        
        return $orders->simplePaginate(15);
    }
    
    public static function GetOrdersCalendar(){
        return DB::table('adm_vw_orders_calendar')->get();
    }
    
    public static function GetOrdersPendingConfirmation(){
        return DB::table('adm_vw_orders_pending_confirmation')->get();
    }
    
    public static function GetOrdersInProgress(){
        return DB::table('adm_vw_orders_in_progress')->get();
    }
    
    public static function GetOrdersReceived(){
        return DB::table('adm_vw_orders_received')->get();
    }
    
    public static function GetOrdersReminders(){
        return DB::table('adm_vw_orders_reminders')->get();
    }
    
    public static function ProcessPayment($orderId, $payment, $tip, $duration, $checkoutId, $checkoutService){
        return DB::select('CALL spProcessPayments(?, ?, ?, ?,?,?);', [$orderId, $payment, $tip, $duration, $checkoutId, $checkoutService]);
    }
    
    public static function GetOrder($orderId){
        return DB::table('adm_vw_orders')->where('orderId',$orderId)->first();
    }
        
    
}
