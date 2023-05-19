<ul id="myTab1" class="nav nav-tabs bordered">
    <li class="" id="entli" onclick='page_redirect("{{asset("/Entreprise")}}")'>
        <a href="#" data-toggle="tab">Ma société</a>
    </li>
    <li class="" id="tauxli" onclick='page_redirect("{{asset("/Taxe")}}")'>
        <a href="#" data-toggle="tab">TVA</a>
    </li>
    <li class="" id="deviseli" onclick='page_redirect("{{asset("/Devise")}}")'>
        <a href="#" data-toggle="tab">Devise</a>
    </li>
    <li class="" id="TypeReglementli" onclick='page_redirect("{{asset("/TypeReglement")}}")'>
        <a href="#" data-toggle="tab">Mode de reglement</a>
    </li>
</ul>


<script>
    $("#configMenu").addClass("active");
</script>
