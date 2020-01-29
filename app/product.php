<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use SoftDeletes;
     protected $fillable = ['product_name','product_description','product_price','product_quantity','alert_quantity'];
    protected $dates = ['deleted_at'];


}
