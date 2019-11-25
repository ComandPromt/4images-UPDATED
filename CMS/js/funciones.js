
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