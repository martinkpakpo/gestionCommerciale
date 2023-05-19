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
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="jarviswidget well" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
                            <div>
                                <legend>Les commandes</legend>

                                <table id="dt_basic" class="table" width="100%">
                                    <thead>			                
                                        <tr class="thea-color">
                                            <th data-hide="phone">ID</th>
                                            <th>Fournisseur</th>
                                            <th>Date de création</th>
                                            <th>Total HT</th>
                                            <th>Taxe</th>
                                            <th>Total TTC</th>
                                            <th>Etat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Approvisionnements as $Approvisionnement)
                                             <tr>
                                                <td>
                                                    {{$Approvisionnement->id}}.
                                                </td>
                                                <td>{{$Approvisionnement->tier->libelle}}</td>
                                                <td>{{date('d/m/Y',strtotime($Approvisionnement->date_creation))}}</td>
                                                <td>
                                                    {{$Approvisionnement->valeur_hors_taxe}}
                                                </td><td>
                                                    {{$Approvisionnement->valeur_taxe}} ({{$Approvisionnement->valeur_taux*100}}%)
                                                </td><td>
                                                    {{$Approvisionnement->valeur_total}}
                                                </td>
                                                <td>
                                                    @if ($Approvisionnement->status=="ENABLE") A VALIDER @endif
                                                    @if ($Approvisionnement->status=="VALIDE") EN ATTENTE DE RECEPTION @endif
                                                    @if ($Approvisionnement->status=="DISABLE") ANNULEE @endif
                                                    @if ($Approvisionnement->status=="LIVRE") COMMANDE RECU @endif

                                                </td>
                                                <td>
                                                    <button class='btn btn-xs tablebutton tablebuttonvlick' onclick='selectAppro({{$Approvisionnement->id}})'>Voir <i class='fa fa-eye'></i></button>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>



<script>
$("#approvisionnementSAISIEli").addClass("active");
$("#approvisionnementli").addClass("active");





 

  

function selectAppro(id) {
    var url='{{asset("/Approvisionnement_V1/details/")}}/'+id;
    page_redirect(url);

}


</script>
@endsection

