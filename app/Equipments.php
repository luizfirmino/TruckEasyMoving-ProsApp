<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Equipments extends Model
{
     protected $fillable = [
        'equipmentId',
        'name',
        'qtd',
        'address',
        'addressComp',
        'city',
        'state',
        'zipcode',
        'value' 
    ];
    
    protected $primaryKey = 'equipmentId';
    
}
