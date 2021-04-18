<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
 
      protected $primaryKey   = 'id';
    protected $table        = 'customers';
    public $incrementing = true;
     public $timestamps   = true;
    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'discount_amount',
        'created_at',
        'updated_at',
    ];
}
