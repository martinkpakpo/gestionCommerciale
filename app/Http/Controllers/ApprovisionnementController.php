<?php

namespace App\Http\Controllers;

use App\Approvisionnement;
use App\User;
use App\Produit;
use App\Taxe;
use App\Tier;
use App\Notification;
use App\TimelineApprovisionnement;
use Cart;
use Illuminate\Support\Facades\Auth;
use DB;
use App\LigneApprovisionnement;

use Illuminate\Http\Request;

class ApprovisionnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Taxe['Taxes']=Taxe::where('status','A')->get();
       // $Produit['Produits']=Produit::where('quantite','!=',0)->get();
       $userID =Auth::user()->id;

        $Produit['Produits']=Produit::where('status','A')->get();
        $User['Users']=User::where('role','!=','GENERAL')->get();
        $Tier['Tiers']=Tier::where('type','F')->where('status','A')->get();
        $Cart['Carts'] = \Cart::session($userID)->getContent();
        return view('Approvisionnement.index',$User,$Tier)->with($Taxe)->with($Produit)->with($Cart) ;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userID =Auth::user()->id;
        $Carts = Cart::session($userID)->getContent();
        $this->validate($request,[
            'date_livraison_pre'=> 'required|after_or_equal:'.date('Y-m-d'),
            'tiers_id'=> 'required',
            'taxe_id'=> 'required',
            'validateur_id'=> 'required',
        ]);

        if (Cart::session($userID)->isEmpty()) {
            # code...
            return redirect()->route('Approvisionnement.index')->with('error','Impossible de créer une commande vide');

        }else{
        $Approvisionnement = new Approvisionnement;
        $Approvisionnement->date_creation=date('Y-m-d');
        $Approvisionnement->date_livraison_pre= $request->date_livraison_pre;
        $Approvisionnement->emetteur_id= $userID;
        $Approvisionnement->tiers_id= $request->tiers_id;
        $Approvisionnement->status= 'ENABLE';
        $Approvisionnement->etat='NON-SOLDE';
        $Approvisionnement->validateur_id= $request->validateur_id;
        $valeur_hors_taxe=0;
        $valeur_taxe=0;
        $valeur_taux=0;
        $valeur_total=0;
        $valeur_ttc=0;
        $valeur_remise=0;
        foreach ($Carts as $key => $value) {
            $valeur_hors_taxe = $valeur_hors_taxe + ($value->price*$value->quantity);
        }
        $valeur_taux    =   $request->taxe_id/100;
        $valeur_taxe    =   $valeur_hors_taxe*$valeur_taux;
        $valeur_ttc     =   $valeur_hors_taxe+$valeur_taxe;
        $valeur_total   =   $valeur_ttc;
        $valeur_remise  =   0;

        $Approvisionnement->valeur_hors_taxe=$valeur_hors_taxe;
        $Approvisionnement->valeur_taxe=$valeur_taxe;
        $Approvisionnement->valeur_taux=$valeur_taux;
        $Approvisionnement->valeur_ttc=$valeur_ttc;
        $Approvisionnement->valeur_remise=$valeur_remise;
        $Approvisionnement->valeur_total=$valeur_total;
        $Approvisionnement->save();

     foreach ($Carts as $key => $value) {
        $LigneApprovisionnement = new LigneApprovisionnement;
        $LigneApprovisionnement->produit_id=$value->id;
        $LigneApprovisionnement->prix_unitaire_achat=$value->price;
        $LigneApprovisionnement->quantite_init=$value->quantity;
        $LigneApprovisionnement->quantite_livre=0;
        $LigneApprovisionnement->prix_ini=$value->quantity*$value->price;
        $LigneApprovisionnement->prix_livre=0;
        $LigneApprovisionnement->approvisionnement_id=$Approvisionnement->id;
        $LigneApprovisionnement->save();
     }
     foreach ($Carts as $key => $value) {
        \Cart::session($userID)->remove($value->id);
    }
     $Notification = new Notification;
     $Notification->titre="Commande fournisseur";
     $Notification->texte="Vous avez reçu une demande de validation de commande de ".Auth::user()->name;
     $Notification->code='COMMANDE_A_VALIDER';
     $Notification->etat='UNREAD';
     $Notification->destinataire=$request->validateur_id;
     $Notification->save();

     $Timeline = new TimelineApprovisionnement;
     $Timeline->titre="Création d'une commande";
     $Timeline->texte="Création de la commande N°00".$Approvisionnement->id." par ".Auth::user()->name;
     $Timeline->code='CREATION';
     $Timeline->date_creation=date('Y-m-d');
     $Timeline->user_id=$userID;
     $Timeline->approvisionnement_id=$Approvisionnement->id;
     $Timeline->save();

     return redirect()->route('Approvisionnement.index')->with('success','Commande créée avec succes');
    }
       



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Approvisionnement  $approvisionnement
     * @return \Illuminate\Http\Response
     */
    public function show(Approvisionnement $approvisionnement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Approvisionnement  $approvisionnement
     * @return \Illuminate\Http\Response
     */
    public function edit(Approvisionnement $approvisionnement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Approvisionnement  $approvisionnement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Approvisionnement $approvisionnement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Approvisionnement  $approvisionnement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Approvisionnement $approvisionnement)
    {
        //
    }
}
