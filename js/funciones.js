
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