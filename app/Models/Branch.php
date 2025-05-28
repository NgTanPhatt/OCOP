<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['name', 'avatar', 'address', 'phone', 'email', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'branch_id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'branch_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'branch_id');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class, 'branch_id');
    }
}

