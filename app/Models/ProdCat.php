<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdCat extends Model
{
    use HasFactory;
    protected $table = 'prod-cat';
    protected $fillable = [
        
        'prod',
        'cat',
        
    ];
    // public function product(){
    //     $this->belongsTo(Product::class,'prod','id');
    // }
    // public function category(){
    //     $this->belongsTo(Category::class,'cat','id');
    // }
}
