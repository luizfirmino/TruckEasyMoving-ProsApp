<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Resources extends Model
{
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'phoneNumber',
        'address',
        'addressComp',   
        'city',
        'state',   
        'zipcode',
        'active',
        'userId',
        'contractNumber'
    ];
    
    // View
    protected $table = 'resources';
    protected $primaryKey = 'resourceId';
    
    public static function getResourceRoles($resourceId){
        return DB::table('resource_roles')->where('resourceId', $resourceId)->pluck('roleId')->all();
    }
    
    public static function DeleteResourceRoles($resourceId){
        return DB::delete('DELETE FROM resource_roles WHERE resourceId = ' . $resourceId);
    }
    
    public static function InsertResourceRoles($resourceId, $roleId){
        return DB::insert('INSERT INTO resource_roles VALUES('. $resourceId . ',' . $roleId . ')');
    }
    
}
