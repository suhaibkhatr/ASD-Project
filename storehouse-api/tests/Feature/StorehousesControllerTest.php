<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Storehouse;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StorehousesControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and authenticate it
        $this->user = User::create([
            "name" => "Test User",
            "email" => "test@test.com",
            "password" => "12345",
            "role_id" => 1,
        ]);
        $this->actingAs($this->user);
    }

    public function test_can_create_storehouse()
    {
        $data = [
            "title" => "first Store House",
            "address" => "1000 N 4th st",
            "city" => "Fairfield",
            "state" => "Iowa",
            "storehouse_type_id" => 2,
        ];

        $response = $this->post("/api/storehouse", $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas("storehouses", $data);
    }

    public function test_can_read_storehouse()
    {
        $storehouse = Storehouse::create([
            "title" => "first Store House",
            "address" => "1000 N 4th st",
            "city" => "Fairfield",
            "state" => "Iowa",
            "storehouse_type_id" => 2,
        ]);

        $response = $this->get("/api/storehouse/" . $storehouse->id);

        $response->assertStatus(200); // Assuming 200 is returned for successful retrieval
        $response->assertJson($storehouse->toArray()); // Assuming you return product data in JSON format
    }

    public function test_can_update_storehouse()
    {
        $storehouse = Storehouse::create([
            "title" => "first Store House",
            "address" => "1000 N 4th st",
            "city" => "Fairfield",
            "state" => "Iowa",
            "storehouse_type_id" => 2,
        ]);

        $storehouse->users()->attach($this->user);

        $updateData = [
            "title" => "Updated Title",
        ];

        $response = $this->put(
            "/api/storehouse/" . $storehouse->id,
            $updateData
        );

        $response->assertStatus(202); // Assuming 200 is returned for successful update
        $this->assertDatabaseHas("storehouses", $updateData); // Check if the product has been updated in the database
    }

    public function test_can_delete_product()
    {
        $storehouse = Storehouse::create([
            "title" => "first Store House",
            "address" => "1000 N 4th st",
            "city" => "Fairfield",
            "state" => "Iowa",
            "storehouse_type_id" => 2,
        ]);

        $response = $this->delete("/api/storehouse/" . $storehouse->id);

        $response->assertStatus(200);
        $this->assertSoftDeleted("storehouses", ["id" => $storehouse->id]);
    }
}
