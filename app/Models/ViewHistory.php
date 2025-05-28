<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewHistory extends Model
{
    protected $table = 'view_histories';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['user', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
