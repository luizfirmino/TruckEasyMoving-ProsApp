<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    
     public static function GetPaymentsByResource($request){

        $query = DB::table('adm_rep_paymentsByResource');
        
        if (!empty($request->get('q_month'))){
            $query->whereRaw('MONTH(dateSchedule) = ' . $request->get('q_month'));
        }
        
        if (!empty($request->get('q_year'))){
            $query->whereRaw('YEAR(dateSchedule) = ' . $request->get('q_year'));
        }
         
        if (!empty($request->get('q_resourceId'))){
            $query->whereRaw('resourceId = ' . $request->get('q_resourceId'));
        }
        
        return $query->get();
    }
    
    public static function GetEarningsByOrder($request){

        $orders = DB::table('adm_rep_earningsByOrder');
        
        if (!empty($request->get('q_month'))){
            $orders->whereRaw('MONTH(dateSchedule) = ' . $request->get('q_month'));
        }else{
            //$orders->whereRaw('MONTH(dateSchedule) = ' . date("m"));
        }
        
        if (!empty($request->get('q_year'))){
            $orders->whereRaw('YEAR(dateSchedule) = ' . $request->get('q_year'));
        }else{
            //$orders->whereRaw('YEAR(dateSchedule) = ' . date("Y"));
        }
        
        return $orders->get();
    }
    
    public static function GetAccountingGroups($request){

        $orders = DB::table('adm_rep_accountingGroups');
        
        if (!empty($request->get('q_month'))){
            $orders->where('m', '=', $request->get('q_month'));
        }
        
        if (!empty($request->get('q_year'))){
            $orders->where('y', '=', $request->get('q_year'));
        }
        
        return $orders->get();
    }
    
    public static function GetOrdersBySource($request){

        $orders = DB::table('adm_rep_ordersbysource');
        
        if (!empty($request->get('q_year'))){
            $orders->where('year', '=', $request->get('q_year'));
        }
        
        $orders->orderByRaw('source, year, month');
                
        return $orders->get();
    }
    
    public static function GetOrdersCalendar(){
        return DB::table('adm_vw_orders_calendar')->get();
    }
    
    public static function GetOrdersPendingConfirmation(){
        return DB::table('adm_vw_orders_pending_confirmation')->get();
    }
    
    public static function GetOrdersDayBeforeConfirmation(){
        return DB::table('adm_vw_orders_confirmation')->get();
    }
    
}
