<?php

namespace App\Http\Controllers;

use App\LigneVente;
use Illuminate\Http\Request;
use App\Produit;
use Cart;
use Illuminate\Support\Facades\Auth;
use DB;
class LigneVenteController extends Controller
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
       if ($produit->quantite<$request->quantite) {
        # code...
            return redirect()->route('Vente.index')->with('error','Quantité en stock insuffisant');
       }else {
            \Cart::session($userID)->add(array(
                'id' => $request->produit_id,
                'name' => $produit->libelle,
                'price' => $produit->prix_vente,
                'quantity' => $request->quantite
            ));
        return redirect()->route('Vente.index')->with('success','Enregistrement effectué avec succès');
        }
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LigneVente  $ligneVente
     * @return \Illuminate\Http\Response
     */
    public function show(LigneVente $ligneVente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LigneVente  $ligneVente
     * @return \Illuminate\Http\Response
     */
    public function edit(LigneVente $ligneVente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LigneVente  $ligneVente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LigneVente $ligneVente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LigneVente  $ligneVente
     * @return \Illuminate\Http\Response
     */
    public function destroy(LigneVente $ligneVente)
    {
        //
    }
}
