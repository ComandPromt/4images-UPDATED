
var num=0;

var host = './';

var estrellas=0;

function calificar(){
	
	if(num!=estrellas){
	
		fetch(host+'/rater.php?&id='+num).catch(function(error) {
			//
		})
			
		.then(function(str) {
			return str.text();
		})
		
		.then(function(result) {
			document.getElementById("rate-string").textContent = '';
		})
		
		document.getElementById('calificacion').textContent= num;
	
	}
	
}

function pintar(numero){
	
	if(numero>0){
	
		for(var i=1;i<=numero;i++){
	
		document.getElementsByClassName('r'+i)[0].classList.add("fullstar");
	
		}
	
	}
	
}

function limpiar_estrellas(){
	
	estrellas=parseInt(document.getElementById("calificacion").textContent);
	
	document.getElementById("rate-string").textContent='';

	for(var i =1;i<=5;i++){
		document.getElementsByClassName('r'+i)[0].classList.remove("fullstar");
	}

	if(estrellas>0){

		pintar(estrellas);
	
	}
	
}

(function () {
	
	'use strict';
  
	var scripts = document.getElementsByTagName('script');
	
	var scriptName = scripts[scripts.length-1];

	var rWrap = document.getElementById(scriptName.getAttribute('data-id'));
	
	var ratings = {
		1: 'Nicht gut',
		2: 'Naja',
		3: 'Ok',
		4: 'Cool',
		5: 'Wohooo!'
	};

	var stars = document.getElementsByClassName('star');

	function fillStars(mynode) {
	  
		// Is it a node or already a rating?
        
		if(Number.isInteger(mynode)) {
			num = mynode;
		}
    
		else {
		
			if(mynode!=undefined){
				num = mynode.className.match(/\d+/)[0];
			}

		}

		emptyStars().then(function() {
		
			for(var i = 1; i <= num; i++) {
				document.getElementsByClassName('r'+i)[0].classList.add("fullstar");
			}

			if(document.getElementById("rate-string").textContent!=null && document.getElementById("rate-string").textContent!=undefined){
	
				estrellas=parseInt(document.getElementById("rate-string").textContent);

				if(estrellas>0){
					
					pintar(estrellas);
					
				}
			
				document.getElementById("rate-string").textContent = '';
	
			} 
       
		})

	}

	function sendRating(mynode) {
		
		if(num!=estrellas){
		
			var num = mynode.className.match(/\d+/)[0];
		
			fetch(host+'/rater.php?&id='+num).catch(function(error) {
			//
			})
			
			.then(function(str) {
			return str.text();
			})
			
			.then(function(result) {
			document.getElementById("rate-string").textContent = '';
			})
			
			document.getElementById('calificacion').textContent= num;
			
		}
	}

	function getRating(id) {
	
		fetch(host+'/rater.php?id='+id).then(function(result) {
		
		result.json().then(function(data) {
		
			return new Promise(function(resolve, reject) {
				fillStars(data.rating);
	
			})
	
		});
		
		});
		
	}
	
	function emptyStar(mynode) {
		
		if(mynode!=undefined){
			
			var num = mynode.className.match(/\d+/)[0];
			
			document.getElementsByClassName('r'+num)[0].classList.remove("fullstar");
		
		}
		
	}
	
	function emptyStars() {
		
		return new Promise(function(resolve, reject) {
		
		for(var i = 0; i < stars.length; i++) {
		
			stars[i].classList.remove("fullstar");
		
		}
	
		resolve(true);
		
		});
	
	}

	for(var i = 0; i < stars.length; i++) {
	
		stars[i].addEventListener('mouseover', fillStars.bind(this, stars[i]));
	
		stars[i].addEventListener('click', sendRating.bind(this, stars[i]));
	
	}
	
	if(rWrap!=undefined){
		getRating(rWrap.id);
	}
	
})();
