<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Combos extends Model
{
    
    public static function GetStatus(){
       return DB::select('SELECT orderStatusId, status FROM order_status ORDER BY `order`');
    }
    
    public static function GetSources(){
       return DB::select('SELECT orderSourceId, name FROM order_sources ORDER BY orderSourceId');
    }
    
    public static function GetServices(){
        return DB::select("SELECT orderServiceId, CONCAT(service, (CASE WHEN active=0 THEN ' (Desactived)' ELSE '' END)) as service  FROM order_services ORDER BY service");
    }
    
    public static function GetCustomers(){
        return DB::select("SELECT customerId, CONCAT(firstName, ' ', IFNULL(lastname, '')) as name FROM customers ORDER BY firstName");
    }
    
    public static function GetResources(){
        return DB::select("SELECT resourceId, CONCAT(firstName, ' ',  IF(lastName is NULL, '', lastName)) as name FROM resources WHERE active = 1 ORDER BY firstName;");
    }
    
    public static function GetRoles(){
        return DB::select("SELECT roleId, name FROM roles ORDER BY roleId");
    }
    
    public static function GetEquipments(){
        return DB::select("SELECT equipmentId, name FROM equipments ORDER BY name");
    }    
    
    public static function GetRevenueCategories($accGroupId){
        return DB::select("SELECT revenueCategoryId, name FROM revenue_categories where accGroupId = " . $accGroupId . " ORDER BY name");
    }
    
    public static function GetUsers(){
        return DB::select("SELECT id, CONCAT(firstName, ' ', IFNULL(lastName,'')) as name FROM users ORDER BY firstName");
    }
    
    public static function GetMonths(){
       return DB::select('SELECT month, name FROM vw_months ORDER BY month');
    }
    
    public static function GetYears(){
       return DB::select('SELECT year, year1 FROM vw_years ORDER BY year');
    }
    
    public static function GetHours(){
       return DB::select('SELECT hour, hour1 FROM vw_hours ORDER BY hour');
    }
    
}
