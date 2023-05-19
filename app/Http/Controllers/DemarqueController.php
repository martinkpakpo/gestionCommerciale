<?php

namespace App\Http\Controllers;

use App\Demarque;
use Illuminate\Http\Request;
use App\User;
use App\Produit;
use App\Taxe;
use App\Tier;
use App\Notification;
use App\TimelineApprovisionnement;
use Cart;
use Illuminate\Support\Facades\Auth;

class DemarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Produit['Produits']=Produit::where('status','A')->get();
        $User['Users']=User::where('role','!=','GENERAL')->get();
        $userID=Auth::user()->id;
        if (Auth::user()->role!="GENERAL") {
            $Demarque['Demarques']=Demarque::get();
        }else {
            $Demarque['Demarques']=Demarque::where('emetteur_id','=',$userID)->get();
        }
        return view('Demarque.index',$User,$Demarque)->with($Produit) ;

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
            'produit_id'=> 'required',
            'quantite'=> 'numeric|required|gt:0',
            'validateur_id'=> 'required',
            'code'=> 'required',

        ]);
        $Produit=Produit::findOrFail($request->produit_id);

        $Demarque = new Demarque;
        $Demarque->produit_id= $request->produit_id;
        $Demarque->prix_unitaire_achat= $Produit->prix_achat;
        $Demarque->prix_unitaire_vente= $Produit->prix_vente;
        $Demarque->quantite= $request->quantite;
        $Demarque->prix_total_vente= $Produit->prix_vente*$request->quantite;
        $Demarque->prix_total_achat= $Produit->prix_achat*$request->quantite;
        $Demarque->marge= ($Produit->prix_vente*$request->quantite)-($Produit->prix_achat*$request->quantite);
        $Demarque->code= $request->code;
        $Demarque->status= 'ENABLE';
        $Demarque->validateur_id= $request->validateur_id;
        $Demarque->emetteur_id= Auth::user()->id;
        $Demarque->date_creation=date('Y-m-d');
        $Demarque->save();

        $Notification = new Notification;
        $Notification->titre="Démande de validation de démarque";
        $Notification->texte="Vous avez reçu une demande de validation de démarque de ".Auth::user()->name;
        $Notification->code='DEMARQUE_A_VALIDER';
        $Notification->etat='UNREAD';
        $Notification->destinataire=$request->validateur_id;
        $Notification->save();
        return redirect()->route('Demarque.index')->with('success','Enregistrement effectué avec succès');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Demarque  $demarque
     * @return \Illuminate\Http\Response
     */
    public function show(Demarque $demarque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Demarque  $demarque
     * @return \Illuminate\Http\Response
     */
    public function edit(Demarque $demarque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Demarque  $demarque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demarque $demarque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Demarque  $demarque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demarque $demarque)
    {
        //
    }
}
