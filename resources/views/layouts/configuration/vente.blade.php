<ul id="myTab1" class="nav nav-tabs bordered">
    <li class="dropdown" id="approvisionnementli" >
        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Vente <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li id="approvisionnementSAISIEli" >
                <a href="#" onclick='page_redirect("{{asset("/Vente_V1/liste")}}")' data-toggle="tab">Liste des ventes </a>
            </li>
            <li>
                <a href="" onclick='page_redirect("{{asset("/Vente_V1")}}")'  data-toggle="tab">Créer une vente</a>
            </li>
        </ul>
    </li>
    <li class="" id="demarqueli" onclick='page_redirect("{{asset("/Demarque")}}")'>
        <a href="#" data-toggle="tab">Retour de produit</a>
    </li>
</ul>


<script>
    $("#venteMenu").addClass("active");
</script>