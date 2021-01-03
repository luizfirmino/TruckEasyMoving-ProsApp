<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class OrderEquipments extends Model
{
     protected $fillable = [
        'orderId',
        'equipmentId',
        'notes'
    ];
    
    //protected $primaryKey = ['orderId','resourceId'];
    
    // View
    protected $table = 'order_equipments';
    
    public static function GetOrderEquipments($orderId){
        return DB::select('SELECT * FROM adm_vw_order_equipments WHERE orderId = ' . $orderId);
    }
    
    public static function DeleteOrderEquipment($orderId, $equipmentId){
        return DB::delete('DELETE FROM order_equipments WHERE orderId = ' . $orderId . ' AND equipmentId = ' . $equipmentId);
    }
    
}
