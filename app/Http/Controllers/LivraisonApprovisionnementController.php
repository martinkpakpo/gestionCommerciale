<?php

namespace App\Http\Controllers;

use App\LivraisonApprovisionnement;
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
use App\HistoriqueProduit;

class LivraisonApprovisionnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request,[
            'livreur'=> 'required',
            'contact_livreur'=> 'required',
        ]);
        $Approvisionnement=Approvisionnement::findOrFail($request->approvisionnement_id);

        if ($Approvisionnement->status!='VALIDE') {
            return redirect()->route('Approvisionnement.index')->with('error','Commande déjà traitée avec succes');
        } else {
            foreach ($Approvisionnement->ligneApprovisionnements as $Cart) {
                $Produit=Produit::findOrFail($Cart->produit_id);
                $Produit->quantite=$Produit->quantite+$Cart->quantite_init;
                $Produit->save();
                $HistoriqueProduit=new HistoriqueProduit;
                $HistoriqueProduit->entree=$Cart->quantite_init;
                $HistoriqueProduit->sortie=0;
                $HistoriqueProduit->code="ACHAT_MARCHANDISE";
                $HistoriqueProduit->produit_id=$Cart->produit_id;
                $HistoriqueProduit->date_creation=date('Y-m-d');
                $HistoriqueProduit->prix_unitaire=$Cart->prix_unitaire_achat;
                $HistoriqueProduit->prix_unitaire_totale=$Cart->prix_unitaire_achat*$Cart->quantite_init;
                $HistoriqueProduit->save();
            }
       
            $userID=Auth::user()->id;
            $Timeline = new TimelineApprovisionnement;
            $Timeline->titre="Livraison d'une commande";
            $Timeline->texte="Livraison de la commande N°00".$Approvisionnement->id." par ".Auth::user()->name;
            $Timeline->code='LIVRAISON';
            $Timeline->date_creation=date('Y-m-d');
            $Timeline->user_id=$userID;
            $Timeline->approvisionnement_id=$Approvisionnement->id;
            $Timeline->save();
            $livraisonApprovisionnement = new LivraisonApprovisionnement;
            $livraisonApprovisionnement->approvisionnement_id=$Approvisionnement->id;
            $livraisonApprovisionnement->date_livraison=date('Y-m-d');
            $livraisonApprovisionnement->recepteur_id=$userID;
            $livraisonApprovisionnement->livreur=$request->livreur;
            $livraisonApprovisionnement->contact_livreur=$request->contact_livreur;
            $livraisonApprovisionnement->save();
            $Approvisionnement->status='LIVRE';
            $Approvisionnement->save();
        return redirect()->route('Approvisionnement.index')->with('success','Commande traitée avec succes'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LivraisonApprovisionnement  $livraisonApprovisionnement
     * @return \Illuminate\Http\Response
     */
    public function show(LivraisonApprovisionnement $livraisonApprovisionnement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LivraisonApprovisionnement  $livraisonApprovisionnement
     * @return \Illuminate\Http\Response
     */
    public function edit(LivraisonApprovisionnement $livraisonApprovisionnement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LivraisonApprovisionnement  $livraisonApprovisionnement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LivraisonApprovisionnement $livraisonApprovisionnement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LivraisonApprovisionnement  $livraisonApprovisionnement
     * @return \Illuminate\Http\Response
     */
    public function destroy(LivraisonApprovisionnement $livraisonApprovisionnement)
    {
        //
    }
}
