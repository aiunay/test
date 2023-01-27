<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = [
            ['name'=>'Gold', 'hallmark'=> '585'],
            ['name'=>'Gold', 'hallmark'=> '375'],
            ['name'=>'Silver', 'hallmark'=> '925'],
        ];

        Material::insert($materials);
    }
}
