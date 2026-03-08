<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = 'commandes';

    protected $fillable = [
        'code',
        'customer_id',
        'montant_total',
        'code_transaction',
        'statut',
        'date_commande'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class,'commande_id');
    }
}
