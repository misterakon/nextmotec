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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customers')
                ->nullOnDelete();

            // ID généré pour CinetPay
            $table->string('transaction_id', 100)->unique();
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_status', ['pending', 'accepted', 'failed'])
                  ->default('pending');
            // Orange Money, Wave, etc.
            $table->string('payment_method', 50)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
