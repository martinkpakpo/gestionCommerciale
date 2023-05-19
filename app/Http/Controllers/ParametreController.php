<?php

namespace App\Http\Controllers;

use App\Parametre;
use App\User;
use App\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ParametreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $User['Users']=User::all();
        $role=Auth::user()->role;
        if ($role=="ADMIN_SI") {
            return view("User.index")->with($User);
        }else{
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
        if ($request->id == "") {
            $this->validate($request,[
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role'=> 'required',
            ]);
            $User = new User;
            $User->name=$request->name;
            $User->email=$request->email;
            $User->password=Hash::make($request->password);
            $User->status="active";
            $User->role=$request->role;
            $User->save();
        return redirect()->route('Parametre.index')->with('success','Enregistrement effectué avec succès');

        }else{
            $this->validate($request,[
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users,email,'.$request->id.'',
                'password' => 'required|string|min:8|confirmed',
                'role'=> 'required',
            ]);
            $User = User::find($request->id);
            $User->name=$request->name;
            $User->email=$request->email;
            $User->password=Hash::make($request->password);
            $User->status="active";
            $User->role=$request->role;
            $User->save();
            return redirect()->route('Parametre.index')->with('success','Enregistrement effectué avec succès');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parametre  $parametre
     * @return \Illuminate\Http\Response
     */
    public function show(Parametre $parametre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Parametre  $parametre
     * @return \Illuminate\Http\Response
     */
    public function edit(Parametre $parametre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parametre  $parametre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parametre $parametre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parametre  $parametre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parametre $parametre)
    {
        //
    }
}
