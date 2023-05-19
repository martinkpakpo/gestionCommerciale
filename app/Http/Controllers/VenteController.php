<?php

namespace App\Http\Controllers;

use App\Vente;
use App\User;
use App\Produit;
use App\Taxe;
use App\Tier;
use App\Notification;
use Cart;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;
use App\LigneVente;
use App\LivraisonApprovisionnement;
use App\HistoriqueProduit;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Taxe['Taxes']=Taxe::where('status','A')->get();
        $Produit['Produits']=Produit::where('quantite','!=',0)->get();
        $userID =Auth::user()->id;
 
         #$Produit['Produits']=Produit::where('status','A')->get();
         $User['Users']=User::where('role','!=','GENERAL')->get();
         $Tier['Tiers']=Tier::where('type','C')->where('status','A')->get();
         $Cart['Carts'] = \Cart::session($userID)->getContent();
         return view('Vente.index',$User,$Tier)->with($Taxe)->with($Produit)->with($Cart) ;
 
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
            'tiers_id'=> 'required',
            'taxe_id'=> 'required',
            'type'=> 'required',
        ]);

        if (Cart::session($userID)->isEmpty()) {
            # code...
            return redirect()->route('Vente.index')->with('error','Impossible de créer une commande vide');

        }else{
        $Vente = new Vente;
        $Vente->date_creation=date('Y-m-d');
        $Vente->date_livraison_pre= date('Y-m-d');
        $Vente->emetteur_id= $userID;
        $Vente->tiers_id= $request->tiers_id;
        $Vente->status= 'ENABLE';
        $Vente->etat='NON-SOLDE';
        $Vente->type=$request->type;
        $valeur_hors_taxe=0;
        $valeur_taxe=0;
        $valeur_taux=0;
        $valeur_total=0;
        $valeur_ttc=0;
        $valeur_remise=0;
        $valeur_solde=0;
        foreach ($Carts as $key => $value) {
            $valeur_hors_taxe = $valeur_hors_taxe + ($value->price*$value->quantity);
        }
        $valeur_taux    =   $request->taxe_id/100;
        $valeur_taxe    =   $valeur_hors_taxe*$valeur_taux;
        $valeur_ttc     =   $valeur_hors_taxe+$valeur_taxe;
        $valeur_total   =   $valeur_ttc;
        $valeur_remise  =   0;
        $Vente->valeur_hors_taxe=$valeur_hors_taxe;
        $Vente->valeur_taxe=$valeur_taxe;
        $Vente->valeur_taux=$valeur_taux;
        $Vente->valeur_ttc=$valeur_ttc;
        $Vente->valeur_remise=$valeur_remise;
        $Vente->valeur_total=$valeur_total;
        $Vente->valeur_solde=0;
        $Vente->save();
        foreach ($Carts as $key => $value) {
            $Produit=Produit::findOrFail($value->id);
            if ($Produit->quantite-$value->quantity>=0) {
                $LigneVente = new LigneVente;
                $LigneVente->produit_id=$value->id;
                $LigneVente->prix_unitaire_achat=$value->price;
                $LigneVente->quantite_init=$value->quantity;
                $LigneVente->quantite_livre=0;
                $LigneVente->prix_ini=$value->quantity*$value->price;
                $LigneVente->prix_livre=0;
                $LigneVente->vente_id=$Vente->id;
                $LigneVente->save();
                $Produit->quantite=$Produit->quantite-$value->quantity;
                $Produit->save();
                $HistoriqueProduit=new HistoriqueProduit;
                $HistoriqueProduit->entree=0;
                $HistoriqueProduit->sortie=$value->quantity;
                $HistoriqueProduit->code="VENTE_MARCHANDISE";
                $HistoriqueProduit->produit_id=$value->id;
                $HistoriqueProduit->date_creation=date('Y-m-d');
                $HistoriqueProduit->prix_unitaire=$value->price;
                $HistoriqueProduit->prix_unitaire_totale=$value->price*$value->quantity;
                $HistoriqueProduit->save();
            } 
         }
        foreach ($Carts as $key => $value) {
            \Cart::session($userID)->remove($value->id);
        }
        return redirect()->route('Vente.index')->with('success','Vente créée avec succes');

    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function show(Vente $vente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function edit(Vente $vente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vente $vente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vente $vente)
    {
        //
    }
}
