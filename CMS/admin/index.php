<?php

include('../upload_images/cabecera.php');

comprobar_cookie('../');

poner_menu('../');

print '<div class="container" style="width:113%;margin-auto;padding-top:100px;">';

print '<nav>
    <ul>
        <li style="padding-top:20px;"><a title="'.ver_dato('add_cat',$GLOBALS['idioma']).'" href="categories.php"><img alt="'.ver_dato('add_cat',$GLOBALS['idioma']).'" class="icono" src="../img/tag.png"/></a></li>
        <li style="padding-top:20px;"><a title="'.ver_dato('geo',$GLOBALS['idioma']).'" href="geo.php"><img alt="'.ver_dato('geo',$GLOBALS['idioma']).'" class="icono" src="../img/geo.png"/></a></li>
		<br clear="all" />
    </ul>
</nav>
</div>';

restablecer_pass('../');

footer('../');

?>