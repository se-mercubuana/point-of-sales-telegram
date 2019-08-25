<?php

use Illuminate\Database\Seeder;
use \Faker\Provider\Uuid;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::insert([
            'id' => Uuid::uuid(),
            'name' => "Manager",
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        \App\Role::insert([
            'id' => Uuid::uuid(),
            'name' => "Admin",
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
