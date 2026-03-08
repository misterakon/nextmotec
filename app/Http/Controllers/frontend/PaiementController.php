<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Paiement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaiementController extends Controller
{    
    private $api_key = "31853675155dcf6d1eb5e30.64785459";
	private $site_id = '520300';

    private function generateTransactionCode()
    {
        //la derniere commande
        $last = Commande::orderBy('id','desc')->first();

        if($last && $last->code_transaction){

            //on extrait Pxxx
            preg_match('/P(\d+)/', $last->code_transaction, $matches);

            $num = isset($matches[1]) ? intval($matches[1]) + 1 : 1;

        }else{
            $num = 1;
        }

        // format P001
        $p = 'P'.str_pad($num,3,'0',STR_PAD_LEFT);

        $datetime = Carbon::now()->format('YmdHisv');

        //NT.20260307154523123.P002
        return "NT.$datetime.$p";
    }
    
    public function paiement(Request $request)
    {
        if(!Auth::guard('customer')->check()){
            return redirect()->route('connexion')
                            ->with('error','Veuillez vous connecter pour continuer');
        }

        $commande_id = $request->id;   
        $url_back = $request->url_back; 

        if(!$commande_id){
            return back()->with('error','Commande introuvable');
        }
        //on recupere la commande
        $commande = Commande::where('id',$commande_id)
                            ->where('customer_id', Auth::guard('customer')->id())
                            ->firstOrFail();
        
        $montant = $commande->montant_total;
        $code_transaction = $this->generateTransactionCode();

        //url de notification quand le paiement est ok
        $url_success = route('notify');

        $update = $commande->update([
            'code_transaction' => $code_transaction
        ]);

        if($update)
        {
            $res = $this->create_payments($montant, $code_transaction, $commande_id, $url_back, $url_success);
            
            if($res->code == "201" && $res->message == "CREATED")
            {
                return redirect()->to($res->data->payment_url);
            }else{
                return back()->with('error','Erreur lors de la création du paiement');
            }
        }	
        
        return back()->with('error','Impossible de lancer le paiement');
    }

    //Pour la creation du token
    public function create_payments($montant, $tran_id, $commande_id, $url_back, $url_success)
	{
		$api_key = $this->api_key;
		$site_id = $this->site_id;

        $commande = Commande::find($commande_id);
        $customer = $commande->customer;
		
		$lien = "https://api-checkout.cinetpay.com/v2/payment";

		$postdata = http_build_query(
		    array(
				'apikey' => $api_key,
				'site_id' => $site_id,
				'transaction_id' => $tran_id,
                'amount' => $montant,
                'currency' => 'XOF',
                'description' => "Paiement commande ".$commande->code,

                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_surname' => $customer->last_name ?? $customer->name,
                'customer_email' => $customer->email,
                'customer_phone_number' => $customer->phone,
                'customer_address' => $customer->adresse ?? 'Abidjan',
	
				'notify_url' => $url_success,
				'return_url' => $url_back, 
            )
		);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => $postdata
		    )
		);

		$context  = stream_context_create($opts);
		$result   = file_get_contents($lien, false, $context);

		//var_dump($result);
		return json_decode($result);
	}

    //verifier l'etat du paiement
    public function check_status_cinetpay($tran_id)
	{
		$api_key = $this->api_key;
		$site_id = $this->site_id;
		
		$lien = "https://api-checkout.cinetpay.com/v2/payment/check";

		$postdata = http_build_query(
		    array(
				'apikey' => $api_key,
				'site_id' => $site_id,
				'transaction_id' => $tran_id,
		    )
		);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => $postdata
		    )
		);

		$context  = stream_context_create($opts);
		$result   = file_get_contents($lien, false, $context);

		//var_dump($result);
		return json_decode($result);
	}

    //methode post qui reçoit les données après paiement 
    public function notify_payment(Request $request)
    {
        $transaction_id = $request->transaction_id;
        if(!$transaction_id){
            return response()->json(['message'=>'transaction manquante'], 400);
        }

        //on check la commande liée
        $commande = Commande::where('code_transaction', $transaction_id)->first();
        if(!$commande){
            return response()->json(['message'=>'transaction inconnue'], 404);
        }

        //VERIFICATION API CINETPAY
        $response = Http::post('https://api-checkout.cinetpay.com/v2/payment/check',[
            'apikey' => $this->api_key,
            'site_id' => $this->site_id,
            'transaction_id' => $transaction_id
        ]);

        $res = $response->object();

        if($res->code == "00" && $res->data->status == "ACCEPTED")
        {
            //on s'assure ici du montant payé
            if($res->data->amount != $commande->montant_total){
                return response()->json(['error'=>'montant invalide'], 403);
            }

            //On va vérifier si le paiement est déjà enregistré
            $check = Paiement::where('reference_paiement',$res->data->operator_id)->first();

            if(!$check){

                Paiement::create([
                    'commande_id' => $commande->id,
                    'customer_id' => $commande->customer_id,
                    'code_transaction' => $transaction_id,
                    'reference_paiement' => $res->data->operator_id,
                    'montant' => $res->data->amount,
                    'telephone' => $res->data->cel_phone_num ?? null,
                    'mode_paiement' => $res->data->payment_method,
                    'statut' => 'succes',
                    'date_paiement' => date('Y-m-d', strtotime($res->data->payment_date)),
                    'heure_paiement' => date('H:i:s', strtotime($res->data->payment_date)),
                ]);

            }

            //mise à jour du statut dans commande
            $commande->update([
                'statut' => 'payee'
            ]);

        }

        return response()->json(['message'=>'ok']);
    }

    //verifier le paiement de façon manuelle
    public function check_payment($transaction_id)
    {
        if(!$transaction_id){
            return response()->json(['message'=>'transaction manquante'], 400);
        }

        //on check la commande liée
        $commande = Commande::where('code_transaction', $transaction_id)->first();
        if(!$commande){
            return response()->json(['message'=>'transaction inconnue'], 404);
        }

        //VERIFICATION API CINETPAY
        $response = Http::post('https://api-checkout.cinetpay.com/v2/payment/check',[
            'apikey' => $this->api_key,
            'site_id' => $this->site_id,
            'transaction_id' => $transaction_id
        ]);

        $res = $response->object();

        dd($res);

        if($res->code == "00" && $res->data->status == "ACCEPTED")
        {
            //on s'assure ici du montant payé
            if($res->data->amount != $commande->montant_total){
                return response()->json(['error'=>'montant invalide'], 403);
            }

            //On va vérifier si le paiement est déjà enregistré
            $check = Paiement::where('reference_paiement',$res->data->operator_id)->first();

            if(!$check){

                Paiement::create([
                    'commande_id' => $commande->id,
                    'customer_id' => $commande->customer_id,
                    'code_transaction' => $transaction_id,
                    'reference_paiement' => $res->data->operator_id,
                    'montant' => $res->data->amount,
                    'telephone' => $res->data->cel_phone_num ?? null,
                    'mode_paiement' => $res->data->payment_method,
                    'statut' => 'succes',
                    'date_paiement' => date('Y-m-d', strtotime($res->data->payment_date)),
                    'heure_paiement' => date('H:i:s', strtotime($res->data->payment_date)),
                ]);

            }

            //mise à jour du statut dans commande
            $commande->update([
                'statut' => 'payee'
            ]);

        }

        return response()->json(['message'=>'ok']);
    }

}
