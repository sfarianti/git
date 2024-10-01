<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create(
        [
            'category_name' => 'PRODUK DAN BAHAN BAKU',
            'category_parent' => 'BREAKTHROUGH INNOVATION',
        ]);
        
        Category::create(
        [
            'category_name' => 'TEKHNOLOGY & PROSES PRODUKSI',
            'category_parent' => 'BREAKTHROUGH INNOVATION',
        ]);
        
        Category::create(
        [
            'category_name' => 'MANAGEMENT',
            'category_parent' => 'BREAKTHROUGH INNOVATION',
        ]);
        
        Category::create(
        [
            'category_name' => 'GKM PLANT',
            'category_parent' => 'INCREMENTAL INNOVATION',
        ]);
        
        Category::create(
        [
            'category_name' => 'GKM OFFICE',
            'category_parent' => 'INCREMENTAL INNOVATION',
        ]);
        
        Category::create(
        [
            'category_name' => 'PKM PLANT',
            'category_parent' => 'INCREMENTAL INNOVATION',
        ]);
        
        Category::create(
        [
            'category_name' => 'PKM OFFICE',
            'category_parent' => 'INCREMENTAL INNOVATION',
        ]);
        
        Category::create(
        [
            'category_name' => 'SS PLANT',
            'category_parent' => 'INCREMENTAL INNOVATION',
        ]);
        
        Category::create(
        [
            'category_name' => 'SS OFFICE',
            'category_parent' => 'INCREMENTAL INNOVATION',
        ]);

        Category::create(
        [
            'category_name' => 'IDEA',
            'category_parent' => 'IDEA BOX',
        ]);
    }
}
