<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class OrderRevenue extends Model
{
    
    protected $fillable = [
        'orderId',
        'revenueCategoryId',
        'resourceId',
        'date',
        'value'     
    ];
    
    protected $table = 'revenue';
    protected $primaryKey = 'revenueId';
    public $timestamps = false;
    
    public static function GetOrderRevenues($orderId){
        return DB::select('SELECT * FROM adm_vw_order_revenue WHERE orderId = ' . $orderId);
    }
    
}
