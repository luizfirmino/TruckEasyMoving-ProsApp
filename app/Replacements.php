<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Replacements extends Model
{
    protected $fillable = [
        'orderId',
        'resourceId',
        'active',
        'notes'
    ];
    
    protected $primaryKey = 'replacementId';
    
    public static function getReplacements($userId, $active){
        
        $result = DB::table('app_vw_replacements');
        
        if (!empty($userId)) {
            $result->where('resourceId',$userId);
        }
        
        if (!empty($active)) {
            $result->where('active',$active);
        }
        
        $result->orderBy('created_at', 'DESC');
        
        return $result;
    }
    
    public static function getReplacement($id){
        return DB::table('app_vw_replacements')->where('replacementId',$id)->first();
    }
    
    public static function InsertReplacementResources($id, $resourceId){
        return DB::insert('INSERT INTO replacement_resources(replacementId,resourceId) VALUES('. $id . ',' . $resourceId . ')');
    }
    
    public static function desactivateReplacementResources($id){
        return DB::update('UPDATE replacement_resources SET accepted = 0, updated_at = CURRENT_TIMESTAMP() WHERE accepted is null AND replacementId = '. $id);
    }
    
    public static function updateReplacementResource($id, $userId, $accepted){
        return DB::update('UPDATE replacement_resources SET accepted = ' . $accepted . ', updated_at = CURRENT_TIMESTAMP() WHERE replacementId = '. $id . ' AND resourceId = ' . $userId);
    }
    
    public static function getResourcesAvailable($id, $userId){
        return DB::select('CALL app_replacement_resourcesAvailable(?, ?);', [$id, $userId]);        
    }
    
    public static function getReplacementResourcesStatus($id){
        return DB::select('SELECT * FROM app_vw_replacement_resources_status WHERE replacementId = ' . $id);    
    }
    
    public static function getReplacementAvailable($orderId, $userId){
        return DB::table('app_vw_replacements_available')->where('orderId',$orderId)->where('resourceId',$userId)->first();
    }
    
    public static function getReplacementsRemaining($id){
        return DB::select('SELECT COUNT(*) as replacementsRemaining FROM replacement_resources WHERE accepted is null AND replacementId = ' . $id);
    }
    
    public static function checkReplacementActiveByOrderResource($orderId, $userId){
        return DB::table('app_vw_replacements')->where('orderId', $orderId)->where('resourceId',$userId)->where('active', 1)->first();
    }
    
    

}
