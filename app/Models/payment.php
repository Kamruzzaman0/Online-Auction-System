<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(product::class, 'product_id', 'id');
    }
}
