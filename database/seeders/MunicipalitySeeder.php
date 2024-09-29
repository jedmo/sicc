<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Municipality::create(['name' => 'Ahuachapán Norte','department_id' => 1]);
        Municipality::create(['name' => 'Ahuachapán Centro','department_id' => 1]);
        Municipality::create(['name' => 'Ahuachapán Sur','department_id' => 1]);
        Municipality::create(['name' => 'Cabañas Este','department_id' => 2]);
        Municipality::create(['name' => 'Cabañas Oeste','department_id' => 2]);
        Municipality::create(['name' => 'Chalatenango Norte','department_id' => 3]);
        Municipality::create(['name' => 'Chalatenango Centro','department_id' => 3]);
        Municipality::create(['name' => 'Chalatenango Sur','department_id' => 3]);
        Municipality::create(['name' => 'Cuscatlán Norte','department_id' => 4]);
        Municipality::create(['name' => 'Cuscatlán Sur','department_id' => 4]);
        Municipality::create(['name' => 'La Libertad Norte','department_id' => 5]);
        Municipality::create(['name' => 'La Libertad Centro','department_id' => 5]);
        Municipality::create(['name' => 'La Libertad Oeste','department_id' => 5]);
        Municipality::create(['name' => 'La Libertad Este','department_id' => 5]);
        Municipality::create(['name' => 'La Libertad Costa','department_id' => 5]);
        Municipality::create(['name' => 'La Libertad Sur','department_id' => 5]);
        Municipality::create(['name' => 'La Paz Oeste','department_id' => 6]);
        Municipality::create(['name' => 'La Paz Centro','department_id' => 6]);
        Municipality::create(['name' => 'La Paz Este','department_id' => 6]);
        Municipality::create(['name' => 'La Unión Norte','department_id' => 7]);
        Municipality::create(['name' => 'La Unión Sur','department_id' => 7]);
        Municipality::create(['name' => 'Morazán Norte','department_id' => 8]);
        Municipality::create(['name' => 'Morazán Sur','department_id' => 8]);
        Municipality::create(['name' => 'San Miguel Norte','department_id' => 9]);
        Municipality::create(['name' => 'San Miguel Centro','department_id' => 9]);
        Municipality::create(['name' => 'San Miguel Oeste','department_id' => 9]);
        Municipality::create(['name' => 'San Salvador Norte','department_id' => 10]);
        Municipality::create(['name' => 'San Salvador Oeste','department_id' => 10]);
        Municipality::create(['name' => 'San Salvador Este','department_id' => 10]);
        Municipality::create(['name' => 'San Salvador Centro','department_id' => 10]);
        Municipality::create(['name' => 'San Salvador Sur','department_id' => 10]);
        Municipality::create(['name' => 'San Vicente Norte','department_id' => 11]);
        Municipality::create(['name' => 'San Vicente Sur','department_id' => 11]);
        Municipality::create(['name' => 'Santa Ana Norte','department_id' => 12]);
        Municipality::create(['name' => 'Santa Ana Centro','department_id' => 12]);
        Municipality::create(['name' => 'Santa Ana Este','department_id' => 12]);
        Municipality::create(['name' => 'Santa Ana Oeste','department_id' => 12]);
        Municipality::create(['name' => 'Sonsonate Norte','department_id' => 13]);
        Municipality::create(['name' => 'Sonsonate Centro','department_id' => 13]);
        Municipality::create(['name' => 'Sonsonate Este','department_id' => 13]);
        Municipality::create(['name' => 'Sonsonate Oeste','department_id' => 13]);
        Municipality::create(['name' => 'Usulután Norte','department_id' => 14]);
        Municipality::create(['name' => 'Usulután Este','department_id' => 14]);
        Municipality::create(['name' => 'Usulután Oeste','department_id' => 14]);
    }
}
