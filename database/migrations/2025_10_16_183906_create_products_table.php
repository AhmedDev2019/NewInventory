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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            
            $table->foreignId('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->foreignId('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreignId('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreignId('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->decimal('price',10,2)->nullable();
            $table->integer('stock_alert')->default(0);
            $table->integer('quantity')->default(0);
            $table->decimal('discount',10,2)->nullable();

            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('image')->default('uploads/products/default.png');
            $table->string('status')->default('pending'); // pending , received .
            $table->integer('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
