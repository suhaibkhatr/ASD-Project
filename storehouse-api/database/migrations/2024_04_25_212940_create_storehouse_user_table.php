<?php

use App\Models\Storehouse;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("storehouse_users", function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, "user_id");
            $table->foreignIdFor(Storehouse::class, "storehouse_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("storehouse_users");
    }
};
