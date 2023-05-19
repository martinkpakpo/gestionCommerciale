<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Taxe;
use App\Devise;
use App\Demarque;
use App\HistoriqueProduit;
use App\User;
use App\TypeReglement;
use App\Categorie;
use App\Produit;
use App\Approvisionnement;
use App\LigneApprovisionnement;
use App\TimelineApprovisionnement;
use App\Notification;
use App\Tier;
use App\Vente;

use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/Entreprise', 'EntrepriseController')->middleware('auth');
Route::get('/fetchentreprise', 'EntrepriseController@fetchentreprise')->name('fetchentreprise');
Route::resource('/Taxe', 'TaxeController')->middleware('auth');
Route::resource('/Devise', 'DeviseController')->middleware('auth');
Route::resource('/TypeReglement', 'TypeReglementController')->middleware('auth');
Route::resource('/Parametre', 'ParametreController')->middleware('auth');
Route::resource('/Categorie', 'CategorieController')->middleware('auth');
Route::resource('/Produit', 'ProduitController')->middleware('auth');
Route::resource('/Tier', 'TierController')->middleware('auth');
Route::resource('/Approvisionnement', 'ApprovisionnementController')->middleware('auth');
Route::resource('/LigneApprovisionnement', 'LigneApprovisionnementController')->middleware('auth');
Route::resource('/LivraisonApprovisionnement', 'LivraisonApprovisionnementController')->middleware('auth');
Route::resource('/Demarque', 'DemarqueController')->middleware('auth');
Route::resource('/Vente', 'VenteController')->middleware('auth');
Route::resource('/LigneVente', 'LigneVenteController')->middleware('auth');

Route::get('/Categorie/Edit/{id}', function () {
    $Mesure=Categorie::findOrFail(request('id'));
    if ($Mesure->status=="A") {
       $Mesure->status="D";
    }else{
        $Mesure->status="A";
    }
    $Mesure->save();
    return redirect()->route('Categorie.index')->with('success','Modification effectuée avec succès');
})->middleware('App\Http\Middleware\Authenticate');



Route::get('/Taxe/Edit/{id}', function () {
    $Taxe=Taxe::findOrFail(request('id'));
    if ($Taxe->status=="A") {
       $Taxe->status="D";
    }else{
        $Taxe->status="A";
    }
    $Taxe->save();
    return redirect()->route('Taxe.index')->with('success','Modification effectuée avec succès');
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/User/Edit/{id}', function () {
    $Mesure=User::findOrFail(request('id'));
    if ($Mesure->status=="active") {
       $Mesure->status="disable";
    }else{
        $Mesure->status="active";
    }
    $Mesure->save();
    return redirect()->route('Parametre.index')->with('success','Modification effectuée avec succès');
})->middleware('App\Http\Middleware\Authenticate');


Route::get('/Devise/Edit/{id}', function () {
    $Devise=Devise::findOrFail(request('id'));
    if ($Devise->status=="A") {
       $Devise->status="D";
    }else{
        $Devise->status="A";
    }
    $Devise->save();
    return redirect()->route('Devise.index')->with('success','Modification effectuée avec succès');
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/TypeReglement/Edit/{id}', function () {
    $TypeReglement=TypeReglement::findOrFail(request('id'));
    if ($TypeReglement->status=="A") {
       $TypeReglement->status="D";
    }else{
        $TypeReglement->status="A";
    }
    $TypeReglement->save();
    return redirect()->route('TypeReglement.index')->with('success','Modification effectuée avec succès');
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Categorie/Search/{keyword}', function () {
    $name_city = Categorie::where('type',request('keyword'))->get();
    return response()->json($name_city);
})->middleware('App\Http\Middleware\Authenticate');
Route::get('/Produit/Edit/{id}', function () {
    $Mesure=Produit::findOrFail(request('id'));
    if ($Mesure->status=="A") {
       $Mesure->status="D";
    }else{
        $Mesure->status="A";
    }
    $Mesure->save();
    return redirect()->route('Produit.index')->with('success','Modification effectuée avec succès');
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Cart/delete/{id}', function () {
    $userID=Auth::user()->id;
    \Cart::session($userID)->remove(request('id'));
    return redirect()->route('Approvisionnement.index')->with('success','Modification effectuée avec succès');
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/DeleteCart/All', function () {
    $userID=Auth::user()->id;
    $Carts = Cart::session($userID)->getContent();
    foreach ($Carts as $key => $value) {
        \Cart::session($userID)->remove($value->id);
        //dd($value);
    }
    return redirect()->route('Approvisionnement.index')->with('success','Modification effectuée avec succès');
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Approvisionnement_V1/liste', function () {
    // $Produit['Produits']=Produit::where('quantite','!=',0)->get();

    $userID=Auth::user()->id;
    if (Auth::user()->role!="GENERAL") {
        $Approvisionnement['Approvisionnements']=Approvisionnement::get();
    }else {
        $Approvisionnement['Approvisionnements']=Approvisionnement::where('emetteur_id','=',$userID)->get();
    }
    return view('Approvisionnement.liste',$Approvisionnement) ;
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Approvisionnement_V1/details/{id}', function () {
    $Approvisionnement['Approvisionnements']=Approvisionnement::where('id',request('id'))->with('ligneApprovisionnements')->with('tier')->get();
    return view('Approvisionnement.detail',$Approvisionnement) ;
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Approvisionnement_V1/validation/{id}', function () {
    if (Auth::user()->role!="GENERAL") {
        $Approvisionnement=Approvisionnement::findOrFail(request('id'));
        if ($Approvisionnement->status!='ENABLE') {
            return redirect()->route('Approvisionnement.index')->with('error','Commande déjà traitée avec succes');
        } else {
        $Approvisionnement->status='VALIDE';
        $Approvisionnement->save();
        $Notification = new Notification;
        $Notification->titre="Commande fournisseur";
        $Notification->texte="La commande N°00".$Approvisionnement->id." a été approuvée par ".Auth::user()->name;
        $Notification->code='COMMANDE_VALIDER';
        $Notification->etat='UNREAD';
        $Notification->destinataire=$Approvisionnement->emetteur_id;
        $Notification->save();
        $userID=Auth::user()->id;
        $Timeline = new TimelineApprovisionnement;
        $Timeline->titre="Validation d'une commande";
        $Timeline->texte="Validation de la commande N°00".$Approvisionnement->id." par ".Auth::user()->name;
        $Timeline->code='VALIDATION';
        $Timeline->date_creation=date('Y-m-d');
        $Timeline->user_id=$userID;
        $Timeline->approvisionnement_id=$Approvisionnement->id;
        $Timeline->save();
        return redirect()->route('Approvisionnement.index')->with('success','Commande traitée avec succes');
        }
    }else {
        # code...
        return redirect()->route('Approvisionnement.index')->with('error',"Vous n'avez pas les droits neccessaire");

    }
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Approvisionnement_V1/unvalidation/{id}', function () {
    $Approvisionnement=Approvisionnement::findOrFail(request('id'));
    if (Auth::user()->role!="GENERAL") {
        if ($Approvisionnement->status!='ENABLE') {
            return redirect()->route('Approvisionnement.index')->with('error','Commande déjà traitée avec succes');
        } else {
            $Approvisionnement->status='DISABLE';
            $Approvisionnement->save();
            $Notification = new Notification;
            $Notification->titre="Commande fournisseur";
            $Notification->texte="La commande N°00".$Approvisionnement->id." a été refusée par ".Auth::user()->name;
            $Notification->code='COMMANDE_VALIDER';
            $Notification->etat='UNREAD';
            $Notification->destinataire=$Approvisionnement->emetteur_id;
            $Notification->save();
            $userID=Auth::user()->id;
            $Timeline = new TimelineApprovisionnement;
            $Timeline->titre="Traitement d'une commande";
            $Timeline->texte="Refus de la commande N°00".$Approvisionnement->id." par ".Auth::user()->name;
            $Timeline->code='VALIDATION';
            $Timeline->date_creation=date('Y-m-d');
            $Timeline->user_id=$userID;
            $Timeline->approvisionnement_id=$Approvisionnement->id;
            $Timeline->save();
            return redirect()->route('Approvisionnement.index')->with('success','Commande traitée avec succes');
        }
    }else {
        # code...
        return redirect()->route('Approvisionnement.index')->with('error',"Vous n'avez pas les droits neccessaire");

    }
    
    
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Approvisionnement_V1/bon/{id}', function () {
    $Approvisionnement['Approvisionnements']=Approvisionnement::where('id',request('id'))->with('ligneApprovisionnements')->with('tier')->get();
    $Entreprise['Entreprises']=DB::table('entreprises')->latest()->first();
    $Devise['Devises']=DB::table('devises')->latest()->first();
    return view('Approvisionnement.bon',$Approvisionnement,$Devise)->with($Entreprise) ;
})->middleware('App\Http\Middleware\Authenticate');


Route::get('/Demarque_V1/validation/{id}', function () {
    if (Auth::user()->role!="GENERAL") {
        $Demarque=Demarque::findOrFail(request('id'));
        if ($Demarque->status!='ENABLE') {
            return redirect()->route('Demarque.index')->with('error','Demarque déjà traitée avec succes');
        } else { 
        $Produit = Produit::findOrFail($Demarque->produit_id);
            if (($Produit->quantite-$Demarque->quantite)>=0) {
                $Demarque->status='VALIDE';
                $Demarque->save();
                $Produit->quantite=$Produit->quantite-$Demarque->quantite;
                $HistoriqueProduit=new HistoriqueProduit;
                $HistoriqueProduit->entree=0;
                $HistoriqueProduit->sortie=$Demarque->quantite;
                $HistoriqueProduit->code=$Demarque->code;
                $HistoriqueProduit->produit_id=$Demarque->produit_id;
                $HistoriqueProduit->date_creation=date('Y-m-d');
                $HistoriqueProduit->prix_unitaire=$Produit->prix_vente;
                $HistoriqueProduit->prix_unitaire_totale=$Produit->prix_vente*$Demarque->quantite;
                $HistoriqueProduit->save();
                $Produit->save();
                return redirect()->route('Demarque.index')->with('success','Démarque traitée avec succes');

            } else {
                $Demarque->status='DISABLE';
                $Demarque->save();
                return redirect()->route('Demarque.index')->with('error','Quantité en stock très faible');
            }

        }
    }else {
        # code...
        return redirect()->route('Approvisionnement.index')->with('error',"Vous n'avez pas les droits neccessaires");

    }
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Approvisionnement_V1/unvalidation/{id}', function () {
    $Approvisionnement=Approvisionnement::findOrFail(request('id'));
    if (Auth::user()->role!="GENERAL") {
        if ($Approvisionnement->status!='ENABLE') {
            return redirect()->route('Approvisionnement.index')->with('error','Commande déjà traitée avec succes');
        } else {
            $Approvisionnement->status='DISABLE';
            $Approvisionnement->save();
            $Notification = new Notification;
            $Notification->titre="Commande fournisseur";
            $Notification->texte="La commande N°00".$Approvisionnement->id." a été refusée par ".Auth::user()->name;
            $Notification->code='COMMANDE_VALIDER';
            $Notification->etat='UNREAD';
            $Notification->destinataire=$Approvisionnement->emetteur_id;
            $Notification->save();
            $userID=Auth::user()->id;
            $Timeline = new TimelineApprovisionnement;
            $Timeline->titre="Traitement d'une commande";
            $Timeline->texte="Refus de la commande N°00".$Approvisionnement->id." par ".Auth::user()->name;
            $Timeline->code='VALIDATION';
            $Timeline->date_creation=date('Y-m-d');
            $Timeline->user_id=$userID;
            $Timeline->approvisionnement_id=$Approvisionnement->id;
            $Timeline->save();
            return redirect()->route('Approvisionnement.index')->with('success','Commande traitée avec succes');
        }
    }else {
        # code...
        return redirect()->route('Approvisionnement.index')->with('error',"Vous n'avez pas les droits neccessaire");

    }
    
    
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Client/All', function () {
    $Site['Sites']=Tier::where('type','C')->get();
    return view('Tier.client',$Site);
})->middleware('App\Http\Middleware\Authenticate');


Route::get('/Fournisseur/All', function () {
    $Site['Sites']=Tier::where('type','F')->get();
    return view('Tier.fournisseur',$Site);
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Approvisionnement_V1/Create', function () {
    $userID=Auth::user()->id;
    $Carts = Cart::session($userID)->getContent();
    foreach ($Carts as $key => $value) {
        \Cart::session($userID)->remove($value->id);
        //dd($value);
    }
    return redirect()->route('Approvisionnement.index');
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Vente_V1', function () {
    $userID=Auth::user()->id;
    $Carts = Cart::session($userID)->getContent();
    foreach ($Carts as $key => $value) {
        \Cart::session($userID)->remove($value->id);
        //dd($value);
    }
    return redirect()->route('Vente.index');
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Cart/vente/delete/{id}', function () {
    $userID=Auth::user()->id;
    \Cart::session($userID)->remove(request('id'));
    return redirect()->route('Vente.index')->with('success','Modification effectuée avec succès');
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Vente_V1/liste', function () {
    // $Produit['Produits']=Produit::where('quantite','!=',0)->get();
    $userID=Auth::user()->id;
    if (Auth::user()->role!="GENERAL") {
        $Vente['Ventes']=Vente::get();
    }else {
        $Vente['Ventes']=Vente::where('emetteur_id','=',$userID)->get();
    }
    return view('Vente.liste',$Vente) ;
})->middleware('App\Http\Middleware\Authenticate');

Route::get('/Vente_V1/details/{id}', function () {
    $Vente['Ventes']=Vente::where('id',request('id'))->with('ligneVentes')->with('tier')->get();
    return view('Vente.detail',$Vente) ;
})->middleware('App\Http\Middleware\Authenticate');