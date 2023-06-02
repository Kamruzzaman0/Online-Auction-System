<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $guarded=[];
    public function category()
    {
        return $this->belongsTo(category::class, 'cate_id', 'id');
    }
    public function sub_category()
    {
        return $this->belongsTo(sub_category::class, 'sub_cate_id', 'id');
    }
    public function user3()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }
    public function search($query)
    {
        return $this->where('name', 'like', '%'.$query.'%')->get();
    }
   
    
    use HasFactory;
}
