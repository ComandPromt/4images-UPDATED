
function redireciconar_accion(id,accion){
	location.href="action.php?image_id="+id+"&del="+accion;
}

function accion(img_id,id,pagina){
	
  $.ajax({      
      data: {img_id},
      url: pagina,
      type: 'get',
      dataType : "text",
      async: true,
      error: function(X){
            alert("Error");            
        },
      success: function(respuesta){ 
	  	  
      location.href="details.php?image_id="+id;
	  }
    });  

}

function emoji(emoji,nombre){

  var resultado= emoji.substr(1, emoji.length);
  
  resultado="&#"+resultado;

  document.getElementById(nombre).value +=resultado;

}

function limpiar_emoji(nombre){

  document.getElementById(nombre).value = '';

}

function mencionar(id){
	
	var texto="";
	
	var cerrar="";
	
	switch(id){
		
		case 1:
		texto='[user]'+document.getElementById('mention_users').value+'[/user]';
		cerrar='mencion';
		break;
		
		case 2:
		texto='[URL]'+document.getElementById('ctr_url').value+'[/URL]';
		cerrar='url';
		break;
	}
	
document.getElementById("mensaje").value+=' '+texto;

$("#"+cerrar).hide();

}

function muestra_oculta(id){
if (document.getElementById){ //se obtiene el id

var el = document.getElementById(id);
if(el!=null){
 //se define la variable "el" igual a nuestro div
el.style.display = (el.style.display == 'none') ? 'block' : 'none' ; //damos un atributo display:none que oculta el div
if(el.style.display =='none' ){
	document.getElementById('ver_comentario').src = "img/hide.png";
}
else{
	document.getElementById('ver_comentario').src = "img/view.png";
}
}

}
}
window.onload = function(){/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/
muestra_oculta('contenido');/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
}

function error(mensaje){
	alert(mensaje);
}

// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";

}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}

tag_prompt = "Introducir texto para formatearlo:";

link_text_prompt = "Introducir el texto que se muestra con el enlace (opcional)";
link_url_prompt = "Introducir la URL completa del enlace";
link_email_prompt = "Introducir el Email del enlace";

list_type_prompt = "¿Qué tipo de lista desea? Teclee '1' para una lista numerada, teclee 'a' para un listado alfabético, o déjelo en blanco para un listado con puntos.";
list_item_prompt = "Introcuzca una lista. Deje el campo en blanco o haga click en 'Cancel' para completar la lista.";

tags = new Array();

function getarraysize(thearray) {
  for (i = 0; i < thearray.length; i++) {
    if ((thearray[i] == "undefined") || (thearray[i] == "") || (thearray[i] == null)) {
      return i;
    }
  }
  return thearray.length;
}

function arraypush(thearray,value) {
  thearraysize = getarraysize(thearray);
  thearray[thearraysize] = value;
}

function arraypop(thearray) {
  thearraysize = getarraysize(thearray);
  retval = thearray[thearraysize - 1];
  delete thearray[thearraysize - 1];
  return retval;
}

function bbcode(theform,bbcode,prompttext) {
  inserttext = prompt(tag_prompt+"\n["+bbcode+"]xxx[/"+bbcode+"]",prompttext);
  if ((inserttext != null) && (inserttext != "")) {
    theform.comment_text.value += "["+bbcode+"]"+inserttext+"[/"+bbcode+"] ";
    theform.comment_text.focus();
  }
}

function namedlink(theform,thetype) {
  linktext = prompt(link_text_prompt,"");
  var prompttext;
  if (thetype == "URL") {
    prompt_text = link_url_prompt;
    prompt_contents = "http://";
  }
  else {
    prompt_text = link_email_prompt;
    prompt_contents = "";
  }
  linkurl = prompt(prompt_text,prompt_contents);
  if ((linkurl != null) && (linkurl != "")) {
    if ((linktext != null) && (linktext != "")) {
      theform.comment_text.value += "["+thetype+"="+linkurl+"]"+linktext+"[/"+thetype+"] ";
    }
    else {
      theform.comment_text.value += "["+thetype+"]"+linkurl+"[/"+thetype+"] ";
    }
  }
  theform.comment_text.focus();
}

function dolist(theform) {
  listtype = prompt(list_type_prompt, "");
  if ((listtype == "a") || (listtype == "1")) {
    thelist = "[list="+listtype+"]\n";
    listend = "[/list="+listtype+"] ";
  }
  else {
    thelist = "[list]\n";
    listend = "[/list] ";
  }
  listentry = "initial";
  while ((listentry != "") && (listentry != null)) {
    listentry = prompt(list_item_prompt, "");
    if ((listentry != "") && (listentry != null)) {
      thelist = thelist+"[*]"+listentry+"[/*]\n";
    }
  }
  theform.comment_text.value += thelist+listend;
  theform.comment_text.focus();
}


var date=new Date();
			
function fullwin(id){
	
   window.open("showphoto.php?photo_id="+id, 'popup_name','height=' + screen.height + ',width=' + screen.width + ',resizable=yes,scrollbars=yes,toolbar=yes,menubar=yes,location=yes')
}

$(document).ready(function () {

	$("#idiomas").on('change', function () {  

		var idioma = $(this).val();

		if(idioma.lastIndexOf(".")==-1){

			var clave = obtenerCookie("idioma");

			if (clave!="") {
				document.cookie = "idioma="+idioma;
			}

			else{
				createCookie("idioma", idioma, "1");
			}
		
			location.reload();

		}

	});
	
});

function removeCookie(nombre) {
	document.cookie = nombre+"=; max-age=0";
}

function obtenerCookie(clave) {

	var name = clave + "=";
	
	var ca = document.cookie.split(';');
	
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
	}
	
    return "";
}

function createCookie(name, value, days) {

	 var expires; 

	 if (days) { 
		 var date = new Date(); date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		 expires = "; expires=" + date.toGMTString();
	} 

	else { 
		expires = ""; 
	} 

	document.cookie = escape(name) + "=" + escape(value) +"; max-age="+ expires + "; path=/"; 

} 

function startTime(){

	today=new Date();

	h=today.getHours();

	m=today.getMinutes();

	s=today.getSeconds();

	m=checkTime(m);

	
	
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
		accion="lightbox.php?action=eliminar";
	}

	$(document).ready(function(){

	accion+="&image_id="+id;

	var datos=$('#frmajax_img_'+id).serialize();
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

function ocultar_img(id){

	var icono=document.getElementById('IMG_'+id).src.substr(document.getElementById('IMG_'+id).src.lastIndexOf("/")+1,document.getElementById('IMG_'+id).src.lenght);

	var accion="acciones.php?action=ver";
	
	if(icono=='hide.png'){
		accion="acciones.php?action=ocultar";
	}

	$(document).ready(function(){

	accion+="&image_id="+id;

	var datos=$('#frm_img_'+id).serialize();
			$.ajax({
				type:"POST",
				url:accion,
				data:datos,
				success:function(r){
					icono=document.getElementById('IMG_'+id).src.substr(document.getElementById('IMG_'+id).src.lastIndexOf("/")+1,document.getElementById('IMG_'+id).src.lenght);

					if(r==1){
					
						if(icono=='hide.png'){
							document.getElementById('IMG_'+id).src= 'img/view.png';
						}
						
						
						else{
							document.getElementById('IMG_'+id).src='img/hide.png';
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

        var idIntervalo=function(){

            intervaloReloj()
        };
        
        function intervaloReloj(){
			
			if ( $("#reloj")[0] ) {
		        
		        
				
				var t=date.toLocaleTimeString('en-GB', {hour: '2-digit', minute: '2-digit'})
								
				document.getElementById("reloj").innerHTML=t;
		
			}

        }
