<?php

namespace App\Http\Controllers;

use App\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categorie['Categories']=Produit::all();
        return view('Produit.index',$Categorie);
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
        
        if ($request->id=="") {
            $this->validate($request,[
                'libelle'=> 'unique:produits|required|max:191',
                'categorie_id'=> 'required',
                'prix_achat'=> 'numeric|required|lt:'.$request->prix_vente,
                'prix_vente'=> 'required',
                'seuil'=> 'required',
            ]);
            $Categorie = new Produit;
            $Categorie->libelle= $request->libelle;
            $Categorie->type= $request->type;
            $Categorie->categorie_id= $request->categorie_id;
            $Categorie->prix_achat= $request->prix_achat;
            $Categorie->prix_vente= $request->prix_vente;
            $Categorie->quantite= 0;
            $Categorie->seuil= $request->seuil;    
            $Categorie->save();
            return redirect()->route('Produit.index')->with('success','Enregistrement effectué avec succès');
         } else {
            
            $this->validate($request,[
            ]);
            $Categorie = Produit::find($request->id);
            $this->validate($request,[
                'libelle'=> 'unique:produits,libelle,'.$request->id.'|required|max:191',
                'categorie_id'=> 'required',
                'prix_achat'=> 'numeric|required|lt:'.$request->prix_vente,
                'prix_vente'=> 'required',
                'seuil'=> 'required',
            ]);
            $Categorie->libelle= $request->libelle;
            $Categorie->type= $request->type;
            $Categorie->categorie_id= $request->categorie_id;
            $Categorie->prix_achat= $request->prix_achat;
            $Categorie->prix_vente= $request->prix_vente;
            $Categorie->seuil= $request->seuil;    
            $Categorie->save();

            
            return redirect()->route('Produit.index')->with('success','Modification effectuée avec succès');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        //
    }
}
