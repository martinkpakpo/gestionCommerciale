<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categorie['Categories']=Categorie::all();
        return view('Categorie.index',$Categorie);
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
                'libelle'=> 'unique:categories|required|max:191',
            ]);
            $Categorie = new Categorie;
            $Categorie->libelle= $request->libelle;
            $Categorie->type= $request->type;      
            $Categorie->save();
            return redirect()->route('Categorie.index')->with('success','Enregistrement effectué avec succès');
         } else {
            
            $this->validate($request,[
                'libelle'=> 'unique:categories,libelle,'.$request->id.'|required|max:191',
            ]);
            $Categorie = Categorie::find($request->id);
            $Categorie->libelle= $request->libelle;
            $Categorie->type= $request->type;      
            $Categorie->save();
            return redirect()->route('Categorie.index')->with('success','Modification effectuée avec succès');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        //
    }
}
