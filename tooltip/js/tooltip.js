<<<<<<< HEAD

function mostrarTooltip(elemento,mensaje){

    // Si no existe aun el tooltip se crea
    if (!document.getElementById(elemento.id+"tp") ){

        // Dimensiones del elemento al que se quiere añadir el tooltip
        anchoElemento = $('#'+elemento.id).width()+5;
        altoElemento = $('#'+elemento.id).height()-50;
        
        // Coordenadas del elemento al que se quiere añadir el tooltip
        coordenadaXElemento = $('#'+elemento.id).position().left;
       coordenadaYElemento = $('#'+elemento.id).position().top;

        // Coordenadas en las que se colocara el tooltip
        x = coordenadaXElemento + anchoElemento/2 + 20;
        y = coordenadaYElemento + altoElemento/2 + 10;

        // Crea el tooltip con sus atributos
        var tooltip = document.createElement('div');
        tooltip.id = elemento.id + "tp";
        tooltip.className = 'toolTip';
        tooltip.innerHTML = mensaje;
		tooltip.style.fontSize = "18px";
        tooltip.style.left = x + "px";
        tooltip.style.top = y + "px";

        // Añade el tooltip
        document.body.appendChild(tooltip); 
    }

    // Cambia la opacidad del tooltip y lo muestra o lo oculta (Si el raton esta encima del elemento se muestra el tooltip y sino se oculta)
    $('#'+elemento.id).hover(
        function(){
            tooltip.style.display = "block";
            $('#'+tooltip.id).animate({"opacity" : 1});

        },
        function(){
            $('#'+tooltip.id).animate({"opacity" : 0});
            setTimeout(
                function (){
                    tooltip.style.display = "none";
                }, 
                400
            );
            
        }
    );    
=======

function mostrarTooltip(elemento,mensaje){

    // Si no existe aun el tooltip se crea
    if (!document.getElementById(elemento.id+"tp") ){

        // Dimensiones del elemento al que se quiere añadir el tooltip
        anchoElemento = $('#'+elemento.id).width()+5;
        altoElemento = $('#'+elemento.id).height()-50;
        
        // Coordenadas del elemento al que se quiere añadir el tooltip
        coordenadaXElemento = $('#'+elemento.id).position().left;
       coordenadaYElemento = $('#'+elemento.id).position().top;

        // Coordenadas en las que se colocara el tooltip
        x = coordenadaXElemento + anchoElemento/2 + 20;
        y = coordenadaYElemento + altoElemento/2 + 10;

        // Crea el tooltip con sus atributos
        var tooltip = document.createElement('div');
        tooltip.id = elemento.id + "tp";
        tooltip.className = 'toolTip';
        tooltip.innerHTML = mensaje;
		tooltip.style.fontSize = "18px";
        tooltip.style.left = x + "px";
        tooltip.style.top = y + "px";

        // Añade el tooltip
        document.body.appendChild(tooltip); 
    }

    // Cambia la opacidad del tooltip y lo muestra o lo oculta (Si el raton esta encima del elemento se muestra el tooltip y sino se oculta)
    $('#'+elemento.id).hover(
        function(){
            tooltip.style.display = "block";
            $('#'+tooltip.id).animate({"opacity" : 1});

        },
        function(){
            $('#'+tooltip.id).animate({"opacity" : 0});
            setTimeout(
                function (){
                    tooltip.style.display = "none";
                }, 
                400
            );
            
        }
    );    
>>>>>>> 4c7aaae4c3e9eb975d37d59e1970209618233ebf
}