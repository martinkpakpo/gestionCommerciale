<ul id="myTab1" class="nav nav-tabs bordered">
    <li class="" id="entli" onclick='page_redirect("{{asset("/Tier")}}")'>
        <a href="#" data-toggle="tab">Compte tiers</a>
    </li>
    <li class="" id="cltli" onclick='page_redirect("{{asset("/Client/All")}}")'>
        <a href="#" data-toggle="tab">Client</a>
    </li>
    <li class="" id="frsli" onclick='page_redirect("{{asset("/Fournisseur/All")}}")'>
        <a href="#" data-toggle="tab">Fournisseur</a>
    </li>
</ul>

<script>
    $("#tierMenu").addClass("active");
</script>