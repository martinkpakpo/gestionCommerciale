<?php

namespace App\Http\Controllers;

use App\LigneApprovisionnement;
use App\Produit;

use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
use DB;
class LigneApprovisionnementController extends Controller
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
            'produit_id'=> 'required',
            'quantite'=> 'numeric|required|gt:0',
        ]);
        $produit =  Produit::findOrFail($request->produit_id);
        $userID =Auth::user()->id;
       
            \Cart::session($userID)->add(array(
                'id' => $request->produit_id,
                'name' => $produit->libelle,
                'price' => $produit->prix_achat,
                'quantity' => $request->quantite
            ));
        return redirect()->route('Approvisionnement.index')->with('success','Enregistrement effectué avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LigneApprovisionnement  $ligneApprovisionnement
     * @return \Illuminate\Http\Response
     */
    public function show(LigneApprovisionnement $ligneApprovisionnement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LigneApprovisionnement  $ligneApprovisionnement
     * @return \Illuminate\Http\Response
     */
    public function edit(LigneApprovisionnement $ligneApprovisionnement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LigneApprovisionnement  $ligneApprovisionnement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LigneApprovisionnement $ligneApprovisionnement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LigneApprovisionnement  $ligneApprovisionnement
     * @return \Illuminate\Http\Response
     */
    public function destroy(LigneApprovisionnement $ligneApprovisionnement)
    {
        //
    }
}
