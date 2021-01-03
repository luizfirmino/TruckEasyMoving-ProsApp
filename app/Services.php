<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $fillable = [
        'service',
        'hourRate',
        'minimumHours',
        'minuteIncrements',
        'active',
        'description',
        'preparation'
    ];
    
    protected $primaryKey = 'orderServiceId';
    protected $table = 'order_services';
    
    public static function InsertServiceRoles($serviceId, $roleId, $number){
        return DB::insert('INSERT INTO service_roles VALUES('. $serviceId . ',' . $roleId . ',' . $number . ')');
    }
    
    public static function GetServiceRoles($id){
        return DB::select('SELECT r.roleId, r.`name` FROM service_roles sr INNER JOIN roles r ON sr.roleId = r.roleId WHERE sr.orderServiceId = '. $id . ' ORDER by number');
    }
    
    public static function DeleteServiceRoles($id){
        return DB::delete('DELETE FROM service_roles WHERE orderServiceId = '. $id);
    }
    
}
