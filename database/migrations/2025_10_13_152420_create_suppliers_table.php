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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->enum('supplier_type', ['person','company']);
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->default('uploads/suppliers/default.png');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
