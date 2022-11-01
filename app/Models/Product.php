<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
   use SoftDeletes;
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'userid',
        'name',
        'price',
        'image',
    ];
    protected $dates = [ 'deleted_at' ];
  public function category(){
    return $this->belongsToMany(Category::class,'prod-cat','prod','cat');
  }
  public function size(){
    return $this->belongsToMany(Size::class,'productsize','prod_id','size_id');
  }
  public function image(){
    return $this->hasMany(Image::class,'prod');
  }
}
