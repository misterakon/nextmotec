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

           $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
           $table->foreignId('customer_type_id')->constrained('customer_types')->cascadeOnDelete();

            $table->string('name', 255);
            $table->decimal('price', 10, 2)->default(0); 
            $table->text('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->string('download_link', 255)->nullable();
            $table->boolean('active')->default(true);

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
