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
                        <form method="post" action="{{ route('Produit.store') }}" class="form-horizontal" enctype="multipart/form-data" id="form-insert">
                            @csrf
                            <fieldset>
                                <legend>Formulaire de saisie</legend>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Type.</label>
                                    <div class="col-md-10">
                                        <select name="type" id="type" class="form-control">
                                            <option value="">Sélectionner un élement</option>
                                            <option value="P">Produit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Libellé</label>
                                    <div class="col-md-10">
                                        <input type="text" id="libelle" name="libelle" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Catégorie.</label>
                                    <div class="col-md-10">
                                        <select style="width:100%" class="select2" name="categorie_id" id="categorie_id"></select>
                                    </div>
                                </div>
                    
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Prix unitaire d"achat</label>
                                <div class="col-md-10">
                                    <input type="number" min="0" id="prix_achat" name="prix_achat" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Prix unitaire de vente</label>
                                <div class="col-md-10">
                                    <input type="number" min="0" id="prix_vente" name="prix_vente" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Quantité minimum seuil</label>
                                <div class="col-md-10">
                                    <input type="number" min="0" id="seuil" name="seuil" class="form-control">
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
                            <th>Prix d'achat</th>
                            <th>Prix de vente</th>
                            <th>Quantite en stock</th>
                            <th data-hide="phone">Action</th>
                            <th data-hide="phone">Etat du stock</th>

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
                  <td>{{$Categorie->prix_achat}}</td>
                  <td>{{$Categorie->prix_vente}}</td>
                  <td>{{$Categorie->quantite}}</td>

                  <td>
                    <button class='btn btn-xs tablebutton tablebuttonvlick' onclick='editTypePiece("{{$Categorie->id}}","{{$Categorie->libelle}}","{{$Categorie->prix_achat}}","{{$Categorie->prix_vente}}","{{$Categorie->seuil}}")'>Modifier <i class='fa fa-edit'></i></button>
                    <button class='btn btn-xs tablebutton tablebuttonvlick' onclick="editUser({{$Categorie->id}})">  
                        
                    @if ($Categorie->status=="A")
                        supprimer
                    @else
                       Restaurer
                    @endif
                </button>

                </td>
<td>
    @if ($Categorie->quantite<=$Categorie->seuil)
    <span class="label label-danger">Stock épuisé</span>

@else
<span class="label label-success">Stock suffisant</span>

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
$("#Produitli").addClass("active");

    $(document).ready(function () {

        $(document).on('click', '#validation_button', function (e) {
            e.preventDefault();
            $(this).text('Validation..');
            $('#form-insert').submit();
        });
    });

    function editTypePiece(id,name,prix_achat,prix_vente,seuil) {
        document.getElementById("id").value = id;
        document.getElementById("libelle").value = name;
        document.getElementById("prix_achat").value = prix_achat;
        document.getElementById("prix_vente").value = prix_vente;
        document.getElementById("seuil").value = seuil;

}

function editUser(id) {
    var url='{{asset("/Produit/Edit")}}/'+id;
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

<script>
	$(document).ready(function() {
   $('#type').on('change', function() {
	   var getStId = $(this).val();
	   if(getStId) {
		   $.ajax({
			   url: '{{asset("/Categorie/Search")}}/'+getStId,
			   type: "GET",
			   data : {"_token":"{{ csrf_token() }}"},
			   dataType: "json",
			   success:function(data) {
				   //console.log(data);
				 if(data){
				   $('#categorie_id').empty();
				   $('#categorie_id').focus;
				   $('#categorie_id').append('<option value="">-- Selectionner la catégorie --</option>'); 
				   $.each(data, function(key, value){
				   $('select[name="categorie_id"]').append('<option value="'+ value.id +'">' + value.libelle+ '</option>');
			   });
			 }else{
			   $('#categorie_id').empty();
			 }
			 }
		   });
	   }else{
		 $('#categorie_id').empty();
	   }
   });
});
</script>
@endsection

