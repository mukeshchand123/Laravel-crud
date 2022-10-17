<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Image extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'image';
    protected $fillable = [
        'id',
        'prod',
        'name',
        'dir',
    ];
    protected $dates = [ 'deleted_at' ];
    public function product()
    {
        return $this->belongsTo(Product::class,'prod');
    }
}
