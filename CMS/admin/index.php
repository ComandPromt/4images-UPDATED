<?php

include('../upload_images/cabecera.php');

comprobar_cookie('../');

poner_menu('../');

print '<div class="container" style="width:113%;margin-auto;padding-top:100px;">';

print '<nav>
    <ul>
            <li style="padding-top:20px;"><a href="categories.php"><img class="icono" src="../img/tag.png"/></a></li>
        <li style="padding-top:20px;"><a href="geo.php"><img class="icono" src="../img/geo.png"/></a></li>

		<br clear="all" />
    </ul>

</nav>
</div>';

restablecer_pass('../');

footer('../');

?>