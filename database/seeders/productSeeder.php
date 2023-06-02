<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        product::create([
            'name'=>'Ocean',
            'category'=>'Furniture',
            'status'=>'Active',
            'sales'=>11,
            'stocks'=>50,
            'price'=>50000,
        ]); 
    }
}
