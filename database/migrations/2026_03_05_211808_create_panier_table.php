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
        Schema::create('panier', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('session_id', 250)->nullable();
            $table->unsignedBigInteger('product_id');
            $table->integer('quantite')->default(1);
            $table->double('prix_unitaire', 10, 2);
            $table->enum('statut', ['panier','commande'])->default('panier');
            $table->timestamps();

            $table->index('customer_id');
            $table->index('session_id');
            $table->index('product_id');
        });

        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->double('montant_total', 10, 2);
            $table->string('code_transaction')->nullable();
            $table->enum('statut', [
                'en_attente',
                'payee',
                'annulee'
            ])->default('en_attente');

            $table->timestamp('date_commande')->nullable();
            $table->timestamps();
        });

        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');

            $table->string('token', 250);
            $table->string('code_transaction')->nullable();
            $table->string('reference_paiement')->nullable();
            $table->double('montant', 10, 2);
            $table->string('telephone', 20); 
            $table->string('mode_paiement'); // OM, MTN, Wave, Carte
            $table->enum('statut', [
                'en_attente',
                'succes',
                'echec'
            ])->default('en_attente');

            $table->date('date_paiement')->nullable();
            $table->time('heure_paiement')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panier');
        Schema::dropIfExists('commandes');
        Schema::dropIfExists('paiements');
    }
};
