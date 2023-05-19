@php
    $module_id="";
    $message="";

    $module_name="Devise";
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
                        <form method="post" action="{{ route('Devise.store') }}" class="form-horizontal" enctype="multipart/form-data" id="form-insert">
                            @csrf
                            <fieldset>
                                <legend>Formulaire de saisie</legend>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Libellé</label>
                                <div class="col-md-10">
                                    <input type="text" id="libelle" name="libelle" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Sigle</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="sigle" name="sigle">
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
                <table id="dt_basic" class="table table-striped" width="100%">
                    <thead>			                
                        <tr class="thea-color">
                            <th data-hide="phone">ID</th>
                            <th>Libellé</th>
                            <th data-hide="phone,tablet">Sigle</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @foreach($Devises as $Devise)
                <tr>
                    <td>
                        @if ($Devise->status=="A")
                            <span class="label label-info">{{$Devise->id}}.</span>
                        @else
                            <span class="label label-danger">{{$Devise->id}}.</span>
                        @endif
                    </td>
                  <td>{{$Devise->libelle}}</td>
                  <td>{{$Devise->sigle}}</td>
                  <td>
                    <button class='btn btn-xs tablebutton tablebuttonvlick' onclick="editDevise({{$Devise->id}})">Modifier <i class='fa fa-edit'></i></button>
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
$("#deviseli").addClass("active");

    $(document).ready(function () {

        $(document).on('click', '#validation_button', function (e) {
            e.preventDefault();
            $(this).text('Validation..');
            $('#form-insert').submit();
        });
    });



function editDevise(id) {
    var url='{{asset("/Devise/Edit")}}/'+id;
    $.alert.open(
    'Voulez-vous supprimez cette ligne',
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

