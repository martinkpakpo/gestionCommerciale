<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
            
            <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                <img src="{{ asset('HTML_version/img/avatars/sunny.png') }}" alt="me" class="online" /> 
                <span>
                    @if(Auth::user())
                      {{Auth::user()->name}}
                    @endif
                </span>
                <i class="fa fa-angle-down"></i>
            </a> 
            
        </span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive-->
    <nav>
        <ul>
            <li class="" id="dashboardMenu">
                <a href="#" onclick='page_redirect("{{asset("/Entreprise")}}")'><i class="fa fa-dashboard"></i> <span class="menu-item-parent">Accueil</span></a>
            </li>
            <li class="" id="configMenu">
                <a href="#" onclick='page_redirect("{{asset("/Entreprise")}}")'><i class="fa fa-shield"></i><span class="menu-item-parent">Administration</span></a>
            </li>
            <li class="" id="paramMenu">
                <a href="#" onclick='page_redirect("{{asset("/Parametre")}}")'><i class="fa fa-cog"></i><span class="menu-item-parent">Paramètre</span></a>
            </li>
            <li class="" id="dataMenu">
                <a href="#" onclick='page_redirect("{{asset("/Categorie")}}")'><i class="fa fa-clipboard"></i><span class="menu-item-parent">Stock</span></a>
            </li>
            <li class="" id="tierMenu">
                <a href="#" onclick='page_redirect("{{asset("/Tier")}}")'><i class="fa fa-users"></i><span class="menu-item-parent">Tiers</span>
                </a>
            </li>
            <li class="" id="venteMenu">
                <a href="#" onclick='page_redirect("{{asset("/Vente_V1")}}")'><i class="fa fa-inbox"></i><span class="menu-item-parent">Ventes</span></a>
            </li>
            <li class="" id="caisseMenu">
                <a href="navbar-light.htm"><i class="glyphicon glyphicon-briefcase"></i><span class="menu-item-parent">Caisse</span></a>
            </li>
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu"> 
        <i class="fa fa-arrow-circle-left hit"></i> 
    </span>

</aside>