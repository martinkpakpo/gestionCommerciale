@php
    $module_id="";
    $message="";

    $module_name="Entreprise";
    $module_description="Insérez les données de votre entreprise";
    $title="Compte / ".$module_name;
    $modules = array( "Entreprise", "Site", "Taxe", "XYZ" );
@endphp
@extends('layouts.app')

@section('content')
@include('layouts.configuration.tier')

<div id="myTabContent1" class="tab-content padding-10">
    <div class="tab-pane fade in active" id="s1">
        <div class="row">
            <div class="col-md-6">
                        <form method="post" action="{{ route('Tier.store') }}" class="form-horizontal" enctype="multipart/form-data" id="form-insert">
                            @csrf
                            <fieldset>
                                <legend>Formulaire de saisie</legend>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Type de profil</label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="type" id="type">
                                            <option value="F">Fournisseur</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Libellé</label>
                                <div class="col-md-10">
                                    <input type="text" id="libelle" name="libelle" class="form-control">
                                    <input type="hidden" id="identifiant" name="id" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">No de tél.</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control telphone_with_code" data-mask="(+228) 99-99-99-99" id="numero" name="numero">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Adresse</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="adresse" name="adresse">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Email</label>
                                <div class="col-md-10">
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-2 control-label">Autre</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="autre" name="autre">
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
                            <th data-hide="phone,tablet">Adresse</th>
                            <th data-hide="phone,tablet">Numéro</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @foreach($Sites as $Site)
                <tr>
                  <td>{{$Site->id}}.</td>
                  <td>{{$Site->libelle}}</td>
                  <td>{{$Site->adresse}}</td>
                  <td>{{$Site->numero}}</td>
                  <td>@if ($Site->type=="C")
                      Client
                  @else
                      Fournisseur
                  @endif</td>

                  <td>
                    <button class='btn btn-xs tablebutton tablebuttonvlick' onclick='editTiers("{{$Site->id}}","{{$Site->libelle}}","{{$Site->numero}}","{{$Site->adresse}}","{{$Site->email}}","{{$Site->autre}}")'>Sélectionner <i class='fa fa-edit'></i></button>
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
$("#frsli").addClass("active");

    $(document).ready(function () {

        $(document).on('click', '#validation_button', function (e) {
            e.preventDefault();
            $(this).text('Validation..');
            $('#form-insert').submit();
            fetchentreprise();

        });
       
     
    });
    function editTiers(id,libelle,numero,adresse,email,autre) {
        document.getElementById("identifiant").value = id;
        document.getElementById("libelle").value = libelle;
        document.getElementById("numero").value = numero;
        document.getElementById("adresse").value = adresse;
        document.getElementById("email").value = email;
        document.getElementById("autre").value = autre;
    }
</script>
@endsection

