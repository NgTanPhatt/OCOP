<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['name', 'content', 'avatar', 'branch_id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}

