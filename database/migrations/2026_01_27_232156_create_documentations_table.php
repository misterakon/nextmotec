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
        Schema::create('documentations', function (Blueprint $table) {
            $table->id();
             $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();
            $table->string('title', 255);
            // Type de doc : guide, pdf, lien, faq...
            $table->enum('type', ['pdf', 'link', 'markdown', 'video', 'faq'])
                ->default('link');
            // URL (pdf, page, vidéo) ou chemin storage
            $table->string('url', 500)->nullable();
             $table->longText('content')->nullable(); // Pour markdown ou FAQ
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentations');
    }
};
