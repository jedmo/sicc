<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(MunicipalitySeeder::class);
        $this->call(MunicipalDistrictSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(ProfileTypeSeeder::class);
        $this->call(MemberSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(ZoneSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(CellSeeder::class);
        $this->call(CellMemberSeeder::class);
        $this->call(MultiplicationSeeder::class);
        $this->call(GoalSeeder::class);
        $this->call(GoalControlSeeder::class);
    }
}
