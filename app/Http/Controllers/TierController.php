<?php

namespace App\Http\Controllers;

use App\Tier;
use Illuminate\Http\Request;

class TierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Site['Sites']=Tier::all();
        return view('Tier.index',$Site);
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
                'libelle'=> 'unique:tiers|required|max:191',
                'email'=> 'unique:tiers|required|max:191',
                'numero'=> 'unique:tiers|required|max:191',
                'adresse'=> 'required|max:191',
                'autre'=> 'required|max:191',
            ]);
            $Tier = new Tier;
            $Tier->libelle= $request->libelle;
            $Tier->numero= $request->numero;
            $Tier->adresse= $request->adresse;
            $Tier->email= $request->email;
            $Tier->entree= 0;
            $Tier->sortie= 0;
            $Tier->autre= $request->autre;
            $Tier->type = $request->type;
            $Tier->save();
            return redirect()->route('Tier.index')->with('success','Enregistrement effectué avec succès');
         } else {
            $this->validate($request,[
                'libelle'=> 'unique:tiers,libelle,'.$request->id.'|required|max:191',
                'email'=> 'unique:tiers,email,'.$request->id.'|required|max:191',
                'numero'=> 'unique:tiers,numero,'.$request->id.'|required|max:191',
                'adresse'=> 'required|max:191',
                'autre'=> 'required|max:191',
            ]);
            $Tier = Tier::find($request->id);
            $Tier->libelle= $request->libelle;
            $Tier->numero= $request->numero;
            $Tier->adresse= $request->adresse;
            $Tier->email= $request->email;
            $Tier->autre= $request->autre;
            $Tier->type = $request->type;
            $Tier->save();
            return redirect()->route('Tier.index')->with('success','Modification effectuée avec succès');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tier  $tier
     * @return \Illuminate\Http\Response
     */
    public function show(Tier $tier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tier  $tier
     * @return \Illuminate\Http\Response
     */
    public function edit(Tier $tier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tier  $tier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tier $tier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tier  $tier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tier $tier)
    {
        //
    }
}
