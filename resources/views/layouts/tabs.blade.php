
<ul class="nav nav-tabs  tabs" role="tablist" style="" >
    @php
    $stylelink="";
    $activelink="";
    for($i = 0, $size = count($modules); $i < $size; $i++) {
        if ($modules[$i]==$module_name) {
            $stylelink='';
            $activelink=" active";
        }else {
            $stylelink='';
            $activelink="";
        }
    echo '<li class="nav-item" style="border-style: solid; border-width: 0.5px; background-color: navajowhite">';
        echo '<a class="nav-link '.$activelink.'" href="'.asset(''.$modules[$i].'').'" role="tab">'.$modules[$i].'</a>';
    echo'</li>';
    } 
    @endphp
   
</ul>


