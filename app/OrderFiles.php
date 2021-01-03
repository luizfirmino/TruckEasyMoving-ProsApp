<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\UploadFiles;

class OrderFiles extends Model
{
    
    protected $fillable = [
        'orderId',
        'path',
        'thumbnail',
        'created_by',
        'notes'
    ];
    
    protected $primaryKey = 'fileId';
    protected $table = "order_files";
    
}
