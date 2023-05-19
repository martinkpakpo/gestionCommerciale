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
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="jarviswidget well" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
                            <div>
                                							<!-- Timeline Content -->
							<div class="smart-timeline">
								<ul class="smart-timeline-list">
									@foreach ($Approvisionnements[0]->timeline as $item)
                                    <li>
										<div class="smart-timeline-icon">
                                            @if ($item->code=="CREATION")
                                                <i class="fa fa-pencil"></i>                                          
                                            @endif
                                            @if ($item->code=="VALIDATION")
                                                <i class="fa fa-check"></i>                                          
                                            @endif
                                            @if ($item->code=="LIVRAISON")
                                            <i class="fa fa-file-text"></i>                                          
                                        @endif
										</div>
										<div class="smart-timeline-time">
											<small>{{date('d/m/Y',strtotime($item->date_creation))}}</small>
										</div>
										<div class="smart-timeline-content">
											<p>
												<a href="javascript:void(0);"><strong>{{$item->titre}}</strong></a>
											</p>
											<p>{{$item->texte}}</p>
											
										</div>
									</li>
                                    @endforeach
								</ul>
							</div>
							<!-- END Timeline Content -->
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                @if ($Approvisionnements[0]->status=='VALIDE')
                <div class="row">
                    <div class="col-md-12">
                        <div class="jarviswidget well" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
                            <div>
                                <form method="post" action="{{ route('LivraisonApprovisionnement.store') }}" class="form-horizontal" enctype="multipart/form-data" id="form-insert">
                                    @csrf
                                    <fieldset>
                                        <legend>Réception de la commande</legend>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Livreur</label>
                                            <div class="col-md-8">
                                                <input type="text" id="livreur" name="livreur" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Contact du livreur</label>
                                            <div class="col-md-8">
                                                <input type="text" id="contact_livreur" name="contact_livreur" class="form-control">
                                            </div>
                                        </div>
                                        <input type="hidden" name="approvisionnement_id" id="approvisionnement_id" value="{{$Approvisionnements[0]->id}}">
                                        <div class="form-group text-center">
                                            <div class="col-md-12">
                                                <button class="btn btn-danger" type="reset">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Valider</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
               
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12">
                        <div class="jarviswidget well" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
                            <div>
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
                                                                <td>Fournisseur</td>
                                                                <td>{{$Approvisionnements[0]->tier->libelle}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Date de création</td>
                                                                <td>{{date('d/m/Y',strtotime($Approvisionnements[0]->date_creation))}}</td>
                                                            </tr>  
                                                            <tr>
                                                                <td>Opérateur de saisie</td>
                                                                <td>{{$Approvisionnements[0]->operateur->name}}</td>
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
                                                            </tr>             
                                                        @foreach($Approvisionnements[0]->ligneApprovisionnements as $Cart)
                                                        <tr>
                                                            <td>{{$Cart->produit->libelle}}</td>
                                                            <td>{{$Cart->quantite_init}}</td>
                                                            <td>{{$Cart->prix_unitaire_achat}}</td>
                                                            <td>{{$Cart->prix_ini}}</td>
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
                                                                <td>{{$Approvisionnements[0]->valeur_hors_taxe}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total Taxe ({{$Approvisionnements[0]->valeur_taux*100}}%)</td>
                                                                <td>{{$Approvisionnements[0]->valeur_taxe}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total TTC</td>
                                                                <td>{{$Approvisionnements[0]->valeur_total}}</td>
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
                                        <div class="col-md-2">
                                            <div>
                                                <button type="button"  class="btn btn-danger" onclick='page_redirect("{{asset("/Approvisionnement_V1/liste")}}")'>Retour à la liste des commandes</button>
                                            </div>
                                        </div>
                                        <div class="col-md-10" >
                                            <div @if ($Approvisionnements[0]->status!='ENABLE')style="display: none"@endif>
                                                <button class="btn btn-warning" @if ($Approvisionnements[0]->validateur_id!=Auth::user()->id)
                                                    disabled
                                                @endif  onclick='unvalider({{$Approvisionnements[0]->id}})'>Annuler ma commande</button>
                                                <button @if ($Approvisionnements[0]->validateur_id!=Auth::user()->id)
                                                    disabled
                                                @endif type="button" id="validation_button" class="btn btn-success" onclick='valider({{$Approvisionnements[0]->id}})'>Valider ma commande</button>
                                            </div>
                                            @if (($Approvisionnements[0]->status =='VALIDE') ||($Approvisionnements[0]->status =='LIVRE') )
                                            <div>
                                                <button type="button"  class="btn btn-success" onclick='printbon({{$Approvisionnements[0]->id}})'>Imprimer le bon</button>
                                            </div>
                                            @endif
                                           
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
function printbon(id) { 
    var url='{{asset("/Approvisionnement_V1/bon")}}/'+id;
    NewTab(url);

 }

function unvalider(id) {
    var url='{{asset("/Approvisionnement_V1/unvalidation")}}/'+id;
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

function valider(id) {
    var url='{{asset("/Approvisionnement_V1/validation")}}/'+id;
    $.alert.open(
    'Voulez-vous approuvé la commande',
    {
        A: 'Oui',
        C: 'Non'
    },
    function(button) {
        if (button=="A")
            page_redirect(url);
        else
            $.alert.open('Validation annulée');
    }
);
}

</script>
@endsection

