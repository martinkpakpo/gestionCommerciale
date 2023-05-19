@php
    $module_id="";
    $message="";

    $module_name="Entreprise";
    $module_description="Insérez les données de votre entreprise";
    $title="Administration / ".$module_name;
    $modules = array( "Entreprise", "Site", "Taxe", "XYZ" );
@endphp
@extends('layouts.app')

@section('content')
@include('layouts.configuration.administration')

<div id="myTabContent1" class="tab-content padding-10">
    <div class="tab-pane fade in active" id="s1">
        <div class="row">
            <div class="col-md-6">
                        <form method="post" action="{{ route('Entreprise.store') }}" class="form-horizontal" enctype="multipart/form-data" id="form-insert">
                            @csrf
                            <fieldset>
                                <legend>Formulaire de saisie</legend>
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
                                    <input type="text" class="form-control telphone_with_code" data-mask="(99) 9999-9999" id="numero" name="numero">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Logo</label>
                                <div class="col-md-10">
                                    <input type="file" name="logo" class="form-control" >
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
                <img src="{{ asset('invoice/logo.png') }}" id="img-logo" style="width: 20%" alt="SmartAdmin">
        
            </div>
        </div>
    </div>
</div>



<script>
$("#entli").addClass("active");
    $(document).ready(function () {
        fetchentreprise();
        function fetchentreprise() {
            $.ajax({
                type: "GET",
                url: "{{asset('fetchentreprise')}}",
                dataType: "json",
                success: function (response) {
                     if (response.entreprises!=null) {
                    document.getElementById('identifiant').value=response.entreprises.id;
                    document.getElementById('libelle').value=response.entreprises.libelle;
                    document.getElementById('numero').value=response.entreprises.numero;
                    document.getElementById('adresse').value=response.entreprises.adresse;
                    document.getElementById('email').value=response.entreprises.email;
                    document.getElementById('autre').value=response.entreprises.autre;
                    var logo_="{{ asset('logos') }}/"+response.entreprises.logo;
                    $("#img-logo").attr("src",logo_);
                     }
                }
            });
        }

        $(document).on('click', '#validation_button', function (e) {
            e.preventDefault();
            $(this).text('Validation..');
            $('#form-insert').submit();
            fetchentreprise();

        });
       

    });

</script>
@endsection

