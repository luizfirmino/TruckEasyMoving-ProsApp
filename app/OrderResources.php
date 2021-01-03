<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class OrderResources extends Model
{
     protected $fillable = [
        'orderId',
        'resourceId',
        'roleId',
        'timeStarts',
        'timeEnds',
        'accepted'
    ];
    
    //protected $primaryKey = ['orderId','resourceId'];
    
    // View
    protected $table = 'order_resources';
    
    public static function UpdateOrderResource($data){
        
        DB::table('order_resources')->updateOrInsert(
            ['orderId' => $data->orderId, 'resourceId' => $data->resourceId],
            ['roleId' => $data->roleId, 'timeStarts' => $data->timeStarts, 'timeEnds' => $data->timeEnds, 'updated_at' => now(),  'accepted' => $data->accepted]
        );
        
        return true;
    }
    
    public static function GetOrderResource($orderId, $resourceId){
        return DB::table('order_resources')->where('orderId', $orderId)->where('resourceId', $resourceId)->first();
    }
    
    public static function GetOrderResources($orderId){
        return DB::select('SELECT * FROM adm_vw_order_resources WHERE orderId = ' . $orderId . ' order by roleId');
    }
    
    public static function DeleteOrderResource($orderId, $resourceId){
        return DB::delete('DELETE FROM order_resources WHERE orderId = ' . $orderId . ' AND resourceId = ' . $resourceId);
    }
    
    public static function DeleteOrderResources($orderId){
        return DB::delete('DELETE FROM order_resources WHERE orderId = ' . $orderId);
    }
    
}
