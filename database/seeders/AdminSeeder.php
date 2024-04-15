<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table("admin")->insert(Array(
            'id_role' => 2,
            'name' => 'javier',
            'username'=>'javiercundapi',
            "last_name"=>"cundapi",
            "mother_last_name"=>"toledo",
            "password"=>bcrypt('holamundo1234'),
            "password_text"=>"holamundo1234"
        ));
    }
}
