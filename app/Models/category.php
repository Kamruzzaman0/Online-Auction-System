<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function user1()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }
    
}
