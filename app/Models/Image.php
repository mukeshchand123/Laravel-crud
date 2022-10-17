<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'image';
    protected $fillable = [
        'id',
        'prod',
        'name',
        'dir',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class,'prod');
    }
}
