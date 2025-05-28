<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['branch_id', 'code', 'percent', 'expiration_date'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'discount_id');
    }
}

