<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("donations", function (Blueprint $table) {
            $table->id();
            $table->string("receipt_number")->unique();
            $table->foreignId("donor_id")->constrained("donors")->cascadeOnDelete();
            $table->foreignId("cause_id")->constrained("causes")->cascadeOnDelete();
            $table->decimal("amount", 12, 2);
            $table->enum("donation_mode", ["Cash", "UPI", "Bank Transfer", "Cheque", "Card"]);
            $table->date("donation_date");
            $table->string("financial_category");
            $table->text("notes")->nullable();
            $table->foreignId("created_by")->constrained("users")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("donations");
    }
};
