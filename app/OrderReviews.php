<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderReviews extends Model
{
    protected $fillable = [
        'orderId',
        'review',
        'stars',
        'onwebsite',
        'created_at',
        'updated_at'
    ];
    
    protected $primaryKey = 'orderId';
    protected $table = 'order_reviews';
    
}
