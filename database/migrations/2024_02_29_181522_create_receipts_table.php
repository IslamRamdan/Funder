<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->integer('count_sheres');
            $table->string('method');
            $table->string('image');
            $table->string('receipt_number');
            $table->date('deposit_date');
            $table->string('deposited_amount');
            $table->string('status');
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("property_id")->constrained("properties")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
