<?php

namespace App\Http\Controllers;

use App\Taxe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaxeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Taxe['Taxes']=Taxe::all();
        $role=Auth::user()->role;
        if ($role=="ADMIN_SI") {
            return view("Taxe.index",$Taxe);
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
            'libelle'=> 'unique:taxes|required|max:191',
            'taux'=> 'required|numeric|gte:0',
        ]);

        $Taxe = new Taxe;
        $Taxe->libelle= $request->libelle;
        $Taxe->taux= $request->taux;
        $Taxe->save();
        return redirect()->route('Taxe.index')->with('success','Enregistrement effectué avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taxe  $taxe
     * @return \Illuminate\Http\Response
     */
    public function show(Taxe $taxe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taxe  $taxe
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxe $taxe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taxe  $taxe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taxe $taxe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Taxe  $taxe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taxe $taxe)
    {
        //
    }
}
