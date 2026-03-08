<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $table = 'paiements';

    protected $fillable = [
        'commande_id',
        'customer_id',
        'token',
        'code_transaction',
        'reference_paiement',
        'montant',
        'telephone',
        'mode_paiement',
        'statut',
        'date_paiement',
        'heure_paiement'
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class,'commande_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
