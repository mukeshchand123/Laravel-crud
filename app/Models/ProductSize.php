<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProductSize extends Model
{
    use HasFactory;
   
    protected $table = 'productsize';
    protected $fillable = [
        
        'prod_id',
        'size_id',
        
    ];
   // protected $dates = [ 'deleted_at' ];
}
