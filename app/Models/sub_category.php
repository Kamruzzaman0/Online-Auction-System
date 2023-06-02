<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_category extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(category::class, 'cate_id', 'id');
    }
    public function user2()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }
    
}
