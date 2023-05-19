<ul id="myTab1" class="nav nav-tabs bordered">
    <li class="" id="Categorieli" onclick='page_redirect("{{asset("/Categorie")}}")'>
        <a href="#" data-toggle="tab">Catégorie de produit</a>
    </li>
    <li class="" id="Produitli" onclick='page_redirect("{{asset("/Produit")}}")'>
        <a href="#" data-toggle="tab">Produit</a>
    </li>
    <li class="dropdown" id="approvisionnementli" >
        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Approvisionnement <span class="badge inbox-badge bg-color-greenLight">{{App\Approvisionnement::where('status','ENABLE')->where('validateur_id',Auth::user()->id)->count()}} commandes à valider</span> <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li id="approvisionnementSAISIEli" >
                <a href="#" onclick='page_redirect("{{asset("/Approvisionnement_V1/liste")}}")' data-toggle="tab">Liste des commandes </a>
            </li>
            <li>
                <a href="" onclick='page_redirect("{{asset("/Approvisionnement_V1/Create")}}")'  data-toggle="tab">Créer une commandes</a>
            </li>
        </ul>
    </li>
    <li class="" id="demarqueli" onclick='page_redirect("{{asset("/Demarque")}}")'>
        <a href="#" data-toggle="tab">Démarque</a>
    </li>
</ul>


<script>
    $("#dataMenu").addClass("active");
</script>