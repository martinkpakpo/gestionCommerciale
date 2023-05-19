<?php

namespace App\Http\Controllers;

use App\Devise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Devise['Devises']=Devise::all();
        $role=Auth::user()->role;
        if ($role=="ADMIN_SI") {
            return view("Devise.index",$Devise);
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
        $count=Devise::count();
        if ($count==0) {
            # code...
            $this->validate($request,[
                'libelle'=> 'unique:devises|required|max:191',
                'sigle'=> 'required',
            ]);
    
            $Devise = new Devise;
            $Devise->libelle= $request->libelle;
            $Devise->sigle= $request->sigle;
            $Devise->save();
            return redirect()->route('Devise.index')->with('success','Enregistrement effectué avec succès');
        } else {
            # code...
            return redirect()->route('Devise.index')->with('error','Enregistrement impossible');

        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Devise  $devise
     * @return \Illuminate\Http\Response
     */
    public function show(Devise $devise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Devise  $devise
     * @return \Illuminate\Http\Response
     */
    public function edit(Devise $devise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Devise  $devise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devise $devise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Devise  $devise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devise $devise)
    {
        //
    }
}
