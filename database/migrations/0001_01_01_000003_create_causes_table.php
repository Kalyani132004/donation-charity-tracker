<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("causes", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description")->nullable();
            $table->decimal("target_amount", 12, 2)->default(0);
            $table->enum("status", ["active", "inactive"])->default("active");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("causes");
    }
};
