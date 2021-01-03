<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    protected $fillable = [
        'revenueCategoryId',
        'date',
        'value'
    ];
    
    protected $primaryKey = 'revenueId';
    protected $table = 'revenue';
    public $timestamps = false;
    
    public static function GetAdministrativeExpenses(){
        return DB::table('adm_vw_adm_expenses')->simplePaginate(15);
    }
    
}
