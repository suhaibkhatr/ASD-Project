<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\RolesEnum;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table("users")->truncate();
        User::factory(50)->create();

        User::factory()->create([
            "name" => "Suhaib Khater",
            "email" => "suhaib@test.com",
            "role_id" => RolesEnum::ADMIN,
            "password" => Hash::make("1234"),
        ]);

        User::factory()->create([
            "name" => "Test User",
            "email" => "test@test.com",
        ]);

        DB::table("roles")->truncate();

        Role::factory()->createMany([
            ["title" => "admin"],
            ["title" => "supplier"],
        ]);
    }
}
