<?php

namespace App\Http\Controllers;

use App\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$role=Auth::user()->role;

        $role=Auth::user()->role;
        if ($role=="ADMIN_SI") {
            return view("Entreprise.index");
        } else {
            return redirect()->route('home')->with('danger',"Vous n'avez pas les autorisations requises");

        }
    }

    public function fetchentreprise()
    {
        $entreprises=DB::table('entreprises')->latest()->first();
        return response()->json([
            'entreprises'=>$entreprises,
        ]);
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
        $role=Auth::user()->role;
        if ($role=="ADMIN_SI") {
            if ($request->id == "") {
                $this->validate($request,[
                    'libelle'=> 'unique:entreprises|required|max:191',
                    'numero'=> 'unique:entreprises|required|max:191',
                    'logo' => 'required|file|mimes:jpg,png,jpeg,gif,svg',
                    'adresse'=> 'required|max:191',
                    'email'=> 'unique:entreprises|required|email|max:191',
                    'autre'=> 'required|max:191',
                ]);
                if($request->file('logo')){
                    $file= $request->file('logo');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('logos'), $filename);
                }
                $Entreprise = new Entreprise;
                $Entreprise->libelle= $request->libelle;
                $Entreprise->numero= $request->numero;
                $Entreprise->logo= $filename;
                $Entreprise->adresse= $request->adresse;
                $Entreprise->email= $request->email;
                $Entreprise->autre= $request->autre;
                $Entreprise->save();
                return redirect()->route('Entreprise.index')->with('success','Enregistrement effectué avec succès');
            }else{
                $Verif = Entreprise::find($request->id);
               
                $this->validate($request,[
                    'libelle'=> 'unique:entreprises,libelle,'.$request->id.'|required|max:191',
                    'numero'=> 'unique:entreprises,numero,'.$request->id.'|required|max:191',
                    'logo' => 'required|file|mimes:jpg,png,jpeg,gif,svg',
                    'adresse'=> 'required|max:191',
                    'email'=> 'unique:entreprises,email,'.$request->id.'|required|email|max:191',
                    'autre'=> 'required|max:191',
                ]);
                if($request->file('logo')){
                    $file= $request->file('logo');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('logos'), $filename);
                }
                $Verif->libelle= $request->libelle;
                $Verif->numero= $request->numero;
                $Verif->logo= $filename;
                $Verif->adresse= $request->adresse;
                $Verif->email= $request->email;
                $Verif->autre= $request->autre;
                $Verif->save();
                return redirect()->route('Entreprise.index')->with('success','Modification effectué avec succès');
    
            }
        } else {
            return redirect()->route('home')->with('danger',"Vous n'avez pas les autorisations requises");

        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function show(Entreprise $entreprise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function edit(Entreprise $entreprise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entreprise $entreprise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entreprise $entreprise)
    {
        //
    }
}
