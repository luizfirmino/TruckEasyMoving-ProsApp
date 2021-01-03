<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class OrderBilling extends Model
{
    
    protected $table = 'order_billing';
    protected $primaryKey = 'orderId';
    
}
