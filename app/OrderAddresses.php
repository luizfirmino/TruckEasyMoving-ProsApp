<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class OrderAddresses extends Model
{
     protected $fillable = [
        'orderId',
        'address',
        'addressComp',
        'city',
        'state',
        'zipcode',
        'order',
        'notes'
    ];
    
    // View
    protected $table = 'order_addresses';
    protected $primaryKey = 'addressId';
    
     public static function GetOrderAddress($orderId, $addressId){
         
        return DB::table('order_addresses')->where('orderId', $orderId)->where('addressId', $addressId)->first();
         
    }
    
    public static function GetOrderAddresses($orderId){
        return DB::select('SELECT * FROM order_addresses WHERE orderId = ' . $orderId);
    }
    
    public static function DeleteOrderAddress($orderId, $addressId){
        return DB::delete('DELETE FROM order_addresses WHERE orderId = ' . $orderId . ' AND addressId = ' . $addressId);
    }
    
}
