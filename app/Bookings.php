<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    
    protected $table = 'adm_vw_bookings';
    protected $primaryKey = 'orderId';
    
        
    public static function GetServiceRoles($orderServiceId){
        return DB::select('SELECT r.roleId, r.`name`, sr.number FROM service_roles sr INNER JOIN roles r ON sr.roleId = r.roleId WHERE sr.orderServiceId = '. $orderServiceId . ' ORDER by number');
    }
    
    
    public static function GetResourcesByRole($roleId){
        return DB::select("SELECT resourceId, CONCAT(firstName, ' ', IFNULL(lastname, '')) as resourceName FROM	resources WHERE active = 1 AND resourceId IN (SELECT resourceId FROM resource_roles WHERE roleId = " . $roleId . ") ORDER BY firstName");
    }
    
    public static function GetOrderResources($orderId){
        return DB::select('CALL spGetBookingResources(?);', [$orderId]);
    }
}
