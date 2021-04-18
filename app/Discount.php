<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
 
      protected $primaryKey   = 'id';
    protected $table        = 'discounts';
    public $incrementing = true;
     public $timestamps   = true;
    
    protected $fillable = [
        
        'repeat_times',
        'status',
        'discount_value',
        'created_at',
        'updated_at',
    ];
}
