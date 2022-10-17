<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'userid',
        'name',
        'price',
        'image',
    ];
public function category(){
  return $this->belongsToMany(Category::class,'prod-cat','prod','cat');
}
}
