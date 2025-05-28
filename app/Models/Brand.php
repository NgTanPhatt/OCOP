<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['name'];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'brand_id');
    }
}

