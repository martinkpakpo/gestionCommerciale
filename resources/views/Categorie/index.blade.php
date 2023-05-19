@php
    $module_id="";
    $message="";
    $modifypass="";
    $module_name="Categorie";
    $module_description="Insérez les données de base de vottre gestion de stock";
    $title="Paramètre / ".$module_name;
    $modules = array( "Entreprise", "Site", "Taxe", "XYZ" );
@endphp
@extends('layouts.app')

@section('content')
@include('layouts.configuration.stock')

<div id="myTabContent1" class="tab-content padding-10">
    <div class="tab-pane fade in active" id="s1">
        <div class="row">
            <div class="col-md-6">
                        <form method="post" action="{{ route('Categorie.store') }}" class="form-horizontal" enctype="multipart/form-data" id="form-insert">
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
                                    <label class="col-md-2 control-label">Type.</label>
                                    <div class="col-md-10">
                                        <select name="type" id="type" class="form-control">
                                            <option value="P">Catégorie de produit</option>
                                        </select>
                                    </div>
                                </div>
                            <input type="hidden" name="id" id="id">
                           
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
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @foreach($Categories as $Categorie)
                <tr>
                    <td>
                    @if ($Categorie->status=="A")
                        <span class="label label-info">{{$Categorie->id}}.</span>
                    @else
                        <span class="label label-danger">{{$Categorie->id}}.</span>
                    @endif
                </td>
                  <td>{{$Categorie->libelle}}</td>
                  <td>
                    @if ($Categorie->type=="P")
                    Produit
                @else
                   Service
                @endif
                    </td>


                  <td>
                    <button class='btn btn-xs tablebutton tablebuttonvlick' onclick='editTypePiece("{{$Categorie->id}}","{{$Categorie->libelle}}")'>Modifier <i class='fa fa-edit'></i></button>
                    <button class='btn btn-xs tablebutton tablebuttonvlick' onclick="editUser({{$Categorie->id}})">  
                        
                    @if ($Categorie->status=="A")
                        supprimer
                    @else
                       Restaurer
                    @endif
                </button>

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
$("#Categorieli").addClass("active");

    $(document).ready(function () {

        $(document).on('click', '#validation_button', function (e) {
            e.preventDefault();
            $(this).text('Validation..');
            $('#form-insert').submit();
        });
    });

    function editTypePiece(id,name) {
        document.getElementById("id").value = id;
        document.getElementById("libelle").value = name;
}

function editUser(id) {
    var url='{{asset("/Categorie/Edit")}}/'+id;
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

