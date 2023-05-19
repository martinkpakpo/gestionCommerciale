@php
    $module_id="";
    $message="";
    $modifypass="";
    $module_name="Produit";
    $module_description="Insérez les données de base de vottre gestion de stock";
    $title="Administration / ".$module_name;
    $modules = array( "Entreprise", "Site", "Taxe", "XYZ" );
@endphp
@extends('layouts.app')
@section('content')
@include('layouts.configuration.stock')
<div id="myTabContent1" class="tab-content padding-10">
    <div class="tab-pane fade in active" id="s1">
        <div class="row">
            <div class="col-md-6">
                        <form method="post" action="{{ route('Demarque.store') }}" class="form-horizontal" enctype="multipart/form-data" id="form-insert">
                            @csrf
                            <fieldset>
                                <legend>Formulaire de saisie</legend>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Motif</label>
                                    <div class="col-md-10">
                                        <select name="code" id="code" class="form-control">
                                            <option value="">Sélectionner un élement</option>
                                            <option value="VOL">Vol</option>
                                            <option value="CASSE">Casse</option>
                                            <option value="PEREMPTION">Peremption</option>
                                            <option value="DON">Don</option>
                                            <option value="AUTRE-DEMARQUE">Inconnus</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Produit</label>
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
                                        <input type="number" id="quantite" name="quantite" class="form-control" min="0">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Validateur</label>
                                    <div class="col-md-10">
                                        <select style="width:100%" class="select2" name="validateur_id" id="validateur_id">
                                            <option value="">--Selectionner un Validateur--</option>
                                            @foreach($Users as $User)
                                                <option value="{{$User->id}}">{{$User->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            <div class="form-group text-center">
                                <div class="col-md-12">
                                    <button class="btn btn-danger" type="reset">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                            </div>
                </fieldset>
            </form>
            </div>
            <div class="col-md-6">
                <table id="dt_basic" class="table" width="100%">
                    <thead>			                
                        <tr class="thea-color">
                            <th data-hide="phone">ID</th>
                            <th>Libellé</th>
                            <th>Quantité</th>
                            <th>Motif</th>
                            <th data-hide="phone">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @foreach($Demarques as $Categorie)
                <tr>
                    <td>{{$Categorie->id}}</td>
                    <td>{{$Categorie->produit->libelle}}</td>
                    <td>{{$Categorie->quantite}}</td>
                    <td>{{$Categorie->code}}</td>
                    <td>
                        @if (($Categorie->validateur_id==Auth::user()->id) && $Categorie->status=="ENABLE")
                        <button class='btn btn-xs tablebutton tablebuttonvlick' onclick="editDemarque({{$Categorie->id}})"> Valider</button>
                        @endif
                        @if ($Categorie->status!="ENABLE")
                            <span class="label label-danger">Déjà traitée</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
$("#demarqueli").addClass("active");

    $(document).ready(function () {

        $(document).on('click', '#validation_button', function (e) {
            e.preventDefault();
            $(this).text('Validation..');
            $('#form-insert').submit();
        });
    });


function editDemarque(id) {
    var url='{{asset("/Demarque_V1/validation")}}/'+id;
    $.alert.open(
    'Voulez-vous valider cette ligne',
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

