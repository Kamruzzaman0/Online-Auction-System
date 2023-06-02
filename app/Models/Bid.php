<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }
 
    use HasFactory;
}
