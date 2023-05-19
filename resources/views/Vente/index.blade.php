@php
    $module_id="";
    $message="";
    $modifypass="";
    $module_name="Vente";
    $module_description="Insérez les données de base de vottre gestion de stock";
    $title="Paramètre / ".$module_name;
    $modules = array( "Entreprise", "Site", "Taxe", "XYZ" );
@endphp
@extends('layouts.app')
@section('content')
@include('layouts.configuration.vente')
<div id="myTabContent1" class="tab-content padding-10">
    <div class="tab-pane fade in active" id="s1">
        <div class="row">
            <div class="col-md-12">
                <div id="messagedefilant">
                    <h1 class="text-center text-danger">En quittant cette page votre saisie sera annullée automatiquement, pensez à la sauvegardée</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="jarviswidget well" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
                            <div>
                                <form method="post" action="{{ route('LigneVente.store') }}" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <fieldset>
                                        <legend>Ajout des lignes la commande</legend>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Libellé</label>
                                            <div class="col-md-10">
                                                <select style="width:100%" class="select2" name="produit_id" id="produit_id">
                                                    <option value="">--Sélectionner un produit--</option>
                                                    @foreach($Produits as $Produit)
                                                        <option value="{{$Produit->id}}">{{$Produit->libelle}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Quantité</label>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" id="quantite" name="quantite" min="0">
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <div class="col-md-12">
                                                <button class="btn btn-danger" type="reset">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Ajouter</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="jarviswidget well" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
                            <div>
                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                </div>
                                <div class="widget-body">
                                    <div>
                                        <!-- widget edit box -->
                                        <div class="jarviswidget-editbox">
                                        </div>
                                        <div class="widget-body">
                                            <div>
                                                <form method="post" action="{{ route('Vente.store') }}" class="form-horizontal" enctype="multipart/form-data" id="form-insert">
                                                    @csrf
                                                    <fieldset>
                                                        <legend>Entete de la commande</legend>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Client</label>
                                                            <div class="col-md-10">
                                                                <select style="width:100%" class="select2" name="tiers_id" id="tiers_id" onchange="selectFournisseur();">
                                                                    <option value="">--Selectionner un client--</option>
                                                                    @foreach($Tiers as $Tier)
                                                                        <option value="{{$Tier->id}}">{{$Tier->libelle}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Taxe</label>
                                                            <div class="col-md-10">
                                                                <select style="width:100%" class="select2" name="taxe_id" id="taxe_id" onchange="selectTaxe();">
                                                                    <option value="">--Selectionner un Taxe--</option>
                                                                    @foreach($Taxes as $Taxe)
                                                                        <option value="{{$Taxe->taux}}">{{$Taxe->libelle}} ({{$Taxe->taux}})</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Type de paiement</label>
                                                            <div class="col-md-10">
                                                                <select style="width:100%" class="select2" name="type" id="type">
                                                                    <option value="UNE">UNE FOIS</option>
                                                                    <option value="PLUSIEUR">PLUSIEURS FOIS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="jarviswidget well" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
                            <div>
                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                </div>
                                <div class="widget-body">
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
												
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="2">Recapitulatif de la commande</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Client</td>
                                                                <td><label id="tiers_id_label"></label></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Taxe</td>
                                                                <td><label id="taxe_label"></label></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
												
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="5">Detail</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Produit</td>
                                                                <td>Quantite</td>
                                                                <td>Prix unitaire</td>
                                                                <td>Prix totale</td>
                                                                <td>Action</td>
                                                            </tr>             
                                                        @foreach($Carts as $Cart)
                                                        <tr>
                                                            <td>{{$Cart->name}}</td>
                                                            <td>{{$Cart->quantity}}</td>
                                                            <td>{{$Cart->price}}</td>
                                                            <td>{{$Cart->price*$Cart->quantity}}</td>
                                                            <td>
                                                                <button class='btn btn-xs tablebutton tablebuttonvlick' onclick='deleteFromCartVente("{{$Cart->id}}")'>Supprimer <i class='fa fa-trash-o'></i></button>
                                                            </td>

                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="table-responsive">
												
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="2">Detail</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Total HT</td>
                                                                <td><label id="total_ht_label">{{Cart::session(Auth::user()->id)->getTotal()}}</label></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total Taxe</td>
                                                                <td><label id="total_taxe_label"></label></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-footer">
                                    <div class="row">
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-warning" onclick="deleteCart()">Annuler ma commande</button>
                                            <button type="button" id="validation_button" class="btn btn-success">Valider ma commande</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
$("#approvisionnementSAISIEli").addClass("active");
$("#approvisionnementli").addClass("active");
function selectFournisseur(){
    var fournisseur_value=$( "#tiers_id" ).val();
  if (fournisseur_value==="") {
    $.alert.open({
         type: 'error',
         title: 'Saisie invalide',
         draggable: false,
         content: "Sélectionner un fournisseur"
     });
  } else {
    document.getElementById('tiers_id_label').innerHTML = $( "#tiers_id option:selected" ).text();

  }
}

function selectTaxe(){
    var taxe_value=$( "#taxe_id" ).val();
    var total_ht_label=document.getElementById('total_ht_label').innerHTML;
  if (taxe_value==="") {
    $.alert.open({
         type: 'error',
         title: 'Saisie invalide',
         draggable: false,
         content: "Sélectionner une taxe"
     });
  } else {
    var total_taxe_label=total_ht_label*taxe_value/100;
    document.getElementById('taxe_label').innerHTML = $( "#taxe_id option:selected" ).text();
    document.getElementById('total_taxe_label').innerHTML=total_taxe_label;
   // document.getElementById('total_label').innerHTML=total_ht_label+total_taxe_label;

  }
}


    $(document).ready(function () {

        $(document).on('click', '#validation_button', function (e) {
            $.alert.open(
                'Voulez-vous vraiment soumettre cette commande ?',
                {
                    A: 'Oui',
                    C: 'Non'
                },
                function(button) {
                    if (button=="A"){
                        e.preventDefault();
                        $(this).text('Traitement en cours...');
                        $('#form-insert').submit();
                    }else{
                        $.alert.open('Validation annulée');
                        $(this).text('Valider ma commande');
                    }
                    

                }
            );
        });
    });

    function editTypePiece(id,name) {
        document.getElementById("id").value = id;
        document.getElementById("libelle").value = name;
}

function deleteCart() {
    var url='{{asset("/Vente_V1")}}';
    $.alert.open(
    'Voulez-vous annuler la commande',
    {
        A: 'Oui',
        C: 'Non'
    },
    function(button) {
        if (button=="A")
            page_redirect(url);
        else
            $.alert.open('Suppression annulée');
    }
);
}


</script>
@endsection

