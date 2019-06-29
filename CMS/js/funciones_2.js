
function fullwin(id){
	
   window.open("showphoto.php?photo_id="+id, 'popup_name','height=' + screen.height + ',width=' + screen.width + ',resizable=yes,scrollbars=yes,toolbar=yes,menubar=yes,location=yes')
}

function startTime(){

	today=new Date();

	h=today.getHours();

	m=today.getMinutes();

	s=today.getSeconds();

	m=checkTime(m);

	s=checkTime(s);
	
	if(document.getElementById('reloj')!=null){
		document.getElementById('reloj').innerHTML=h+":"+m+":"+s;
	}
	
	t=setTimeout('startTime()',500);
}

function checkTime(i){
	if (i<10) {i="0" + i;}return i;
}

window.onload=function(){startTime();}

function favorito(id){

var icono=document.getElementById(id).src.substr(document.getElementById(id).src.lastIndexOf("/")+1,document.getElementById(id).src.lenght);

var accion="lightbox.php?action=guardar";

	if(icono=='fav_2.ico'){
		var accion="lightbox.php?action=eliminar";
	}

	$(document).ready(function(){

	accion+="&image_id="+id;

	var datos=$('#frmajax').serialize();
			$.ajax({
				type:"POST",
				url:accion,
				data:datos,
				success:function(r){
					icono=document.getElementById(id).src.substr(document.getElementById(id).src.lastIndexOf("/")+1,document.getElementById(id).src.lenght);
					
					if(r==1){
						
						if(icono=='fav_2.ico'){
						document.getElementById(id).src='img/fav.ico';
									}
						
						else{
						document.getElementById(id).src= 'img/fav_2.ico';
						}
					
				}
			
				}
			});

			return false;
		
	});
	}

function ocultar(id){

var icono=document.getElementById(id).src.substr(document.getElementById(id).src.lastIndexOf("/")+1,document.getElementById(id).src.lenght);

var accion="acciones.php?action=ocultar";

	if(icono=='fav_2.ico'){
		var accion="acciones.php?action=ver";
	}

	$(document).ready(function(){

	accion+="&image_id="+id;

	var datos=$('#frmajax').serialize();
			$.ajax({
				type:"POST",
				url:accion,
				data:datos,
				success:function(r){
					icono=document.getElementById(id).src.substr(document.getElementById(id).src.lastIndexOf("/")+1,document.getElementById(id).src.lenght);
					
					if(r==1){
						
						if(icono=='fav_2.ico'){
						document.getElementById(id).src='img/fav.ico';
									}
						
						else{
						document.getElementById(id).src= 'img/fav_2.ico';
						}
					
				}
			
				}
			});

			return false;
		
	});
	}
	
		function descarga(id){

var numero_descargas=parseInt(document.getElementById('descargas').innerHTML);

var accion="download.php?image_id="+id;


	$(document).ready(function(){

	var datos=$('#frmdownload').serialize();
			$.ajax({
				type:"POST",
				url:accion,
				data:datos,
				success:function(r){
						
					if(r==1){
						document.getElementById('descargas').innerHTML=++numero_descargas;
					
				}
			
				}
			});

			return false;
		
	});
	}
	

function mostrar() {
    document.getElementById("sidebar").style.width = "300px";
    document.getElementById("contenido").style.marginLeft = "300px";
    document.getElementById("abrir").style.display = "none";
    document.getElementById("cerrar").style.display = "inline";
}
function ocultar() {
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("contenido").style.marginLeft = "0";
    document.getElementById("abrir").style.display = "inline";
    document.getElementById("cerrar").style.display = "none";
}

                            jQuery(document).ready(function(){
                                jQuery('.scrollbar-vista').scrollbar({
                                    "showArrows": true,
                                    "scrollx": "advanced",
                                    "scrolly": "advanced"
                                });
                            });
							
									$(function() {
				$( '#dl-menu' ).dlmenu({
					animationClasses : { classin : 'dl-animate-in-2', classout : 'dl-animate-out-2' }
				});
			});

        var idIntervalo=setInterval(function(){
            intervaloReloj()
        },500);
        function intervaloReloj(){
			if ( $("#reloj")[0] ) {
		        var d=new Date();
				var t=d.toLocaleTimeString();
				document.getElementById("reloj").innerHTML=t;
			}

        }