<?php

namespace App\Http\Controllers;

use App\TypeReglement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeReglementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TypeReglement['TypeReglements']=TypeReglement::all();

        $role=Auth::user()->role;
        if ($role=="ADMIN_SI") {
            return view("TypeReglement.index",$TypeReglement);
        } else {
            return redirect()->route('home')->with('danger',"Vous n'avez pas les autorisations requises");

        }
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
            'libelle'=> 'unique:type_reglements|required|max:191',
        ]);

        $TypeReglement = new TypeReglement;
        $TypeReglement->libelle= $request->libelle;
        $TypeReglement->save();
        return redirect()->route('TypeReglement.index')->with('success','Enregistrement effectué avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeReglement  $typeReglement
     * @return \Illuminate\Http\Response
     */
    public function show(TypeReglement $typeReglement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeReglement  $typeReglement
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeReglement $typeReglement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeReglement  $typeReglement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeReglement $typeReglement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeReglement  $typeReglement
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeReglement $typeReglement)
    {
        //
    }
}
