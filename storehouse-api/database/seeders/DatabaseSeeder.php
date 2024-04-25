<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\StorehouseType;
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

        StorehouseType::factory()->createMany([
            [
                "title" => "Public Warehouse",
                "description" => "A public warehouse is a storage facility that is owned and operated by a third-party logistics (3PL) company.
                These warehouses offer storage space to businesses on a short-term or long-term basis.
                Public warehouses are a good option for businesses that need flexible storage solutions
                or that do not have the space to store their own inventory.",
            ],
            [
                "title" => "Private Warehouse",
                "description" => "A private warehouse is a storage facility that is owned and operated by a single company.
                These warehouses are used to store the company's own inventory.
                Private warehouses offer businesses more control over their inventory and can be customized to meet the specific needs of the business.",
            ],
            [
                "title" => "Distribution Center",
                "description" => "A distribution center is a warehouse that is used to store and distribute goods to customers.
                Distribution centers are typically larger than public warehouses and have more sophisticated material handling systems.
                They are often located near transportation hubs, such as airports or seaports.",
            ],
            [
                "title" => "Cold Storage Warehouse",
                "description" => "A cold storage warehouse is a warehouse that is designed to store perishable goods at a controlled temperature.
                Cold storage warehouses are typically used to store food, beverages, and pharmaceuticals.",
            ],
            [
                "title" => "Smart Warehouse",
                "description" => "A smart warehouse is a warehouse that uses automation and technology to improve efficiency and productivity.
                Smart warehouses often use robots to pick and pack orders, as well as sensors to track inventory levels.",
            ],
        ]);
    }
}
