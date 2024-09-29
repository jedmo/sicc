<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        District::create(["id" => 1, "code" => "01", "full_code" => "D:01", "user_id" => 1509, "status" => 1]);
        District::create(["id" => 2, "code" => "02", "full_code" => "D:02", "user_id" => 581, "status" => 1]);
        District::create(["id" => 3, "code" => "03", "full_code" => "D:03", "user_id" => 343, "status" => 1]);
        District::create(["id" => 4, "code" => "04", "full_code" => "D:04", "user_id" => 6333, "status" => 1]);
        District::create(["id" => 5, "code" => "05", "full_code" => "D:05", "user_id" => 6174, "status" => 1]);
        District::create(["id" => 6, "code" => "06", "full_code" => "D:06", "user_id" => 6733, "status" => 1]);
        District::create(["id" => 7, "code" => "07", "full_code" => "D:07", "user_id" => null, "status" => 1]);
        District::create(["id" => 8, "code" => "08", "full_code" => "D:08", "user_id" => 7204, "status" => 1]);
        District::create(["id" => 9, "code" => "09", "full_code" => "D:09", "user_id" => 343, "status" => 1]);
        District::create(["id" => 10, "code" => "10", "full_code" => "D:10", "user_id" => null, "status" => 1]);
    }
}
