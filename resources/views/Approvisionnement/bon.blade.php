@php
    $livraison=$Approvisionnements[0]->livraison;
@endphp
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bon de commande-{{date('Y')}}</title>
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('invoice/style.css') }}">
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        @if ($Entreprises->logo=='')
            <img src="{{ asset('invoice/logo.png') }}">
        @else
            <img src="{{ asset('logos') }}/{{$Entreprises->logo}}">
        @endif
      </div>
      <h1>Bon de commande N°00{{$Approvisionnements[0]->id}}/{{date('m/Y',strtotime($Approvisionnements[0]->date_creation))}}</h1>
      <div id="company" class="clearfix">
        <div>{{$Entreprises->libelle}}</div>
        <div>{{$Entreprises->adresse}}</div>
        <div>{{$Entreprises->numero}}</div>
        <div><a href="#">{{$Entreprises->email}}</a></div>
      </div>
      <div id="project">
        <div><span>Achat de Marchandise</span></div>
        <div><span>Fournisseur</span> {{$Approvisionnements[0]->tier->libelle}}</div>
        <div><span>Adresse</span> {{$Approvisionnements[0]->tier->adresse}}</div>
        <div><span>Email</span> <a href="#">{{$Approvisionnements[0]->tier->email}}</a></div>
        <div><span>Date</span> {{date('d/m/Y',strtotime($Approvisionnements[0]->date_creation))}}</div>
<br>
        @if ($Approvisionnements[0]->status=="LIVRE")
            <div><span>Date de livr.</span> {{date('d/m/Y',strtotime($livraison[0]->date_livraison))}}</div>
            <div><span>Livreur</span> {{$livraison[0]->livreur}}</div>
            <div><span>Contact livreur</span> {{$livraison[0]->contact_livreur}}</div>
        @endif
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="desc">PRODUIT</th>
            <th>PU</th>
            <th>QTE</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
            @foreach($Approvisionnements[0]->ligneApprovisionnements as $ligneApprovisionnement)
 
          <tr>
            <td class="desc">{{$ligneApprovisionnement->produit->libelle}}</td>
            <td class="unit">{{$ligneApprovisionnement->prix_unitaire_achat}} {{$Devises->sigle}}</td>
            <td class="qty">{{$ligneApprovisionnement->quantite_init}}</td>
            <td class="total">{{$ligneApprovisionnement->prix_ini}} {{$Devises->sigle}}</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="3">Total *HT</td>
            <td class="total">{{$Approvisionnements[0]->valeur_hors_taxe}} {{$Devises->sigle}}</td>
          </tr>
          <tr>
            <td colspan="3">TVA {{$Approvisionnements[0]->valeur_taux*100}}%</td>
            <td class="total">{{$Approvisionnements[0]->valeur_taxe}} {{$Devises->sigle}}</td>
          </tr>
          <tr>
            <td colspan="3" class="grand total">Total *TTC</td>
            <td class="grand total">{{$Approvisionnements[0]->valeur_total}} {{$Devises->sigle}}</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice"><i>HT: Hors taxe, TTC: Toute Taxe Comprise</i></div>
      </div>
    </main>
    <footer>
      Ce document a été généré automatiquement
    </footer>
    <script type="text/javascript">
        <!--
        window.print();
        //-->
        </script>
  </body>
</html>