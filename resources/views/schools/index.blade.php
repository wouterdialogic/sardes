@extends('layouts.default')
@section('content')
<br>
	
	@if(!isset($hide_search_window))
	<div class="col-md-12">
	<h2>Zoeken naar scholen</h2>
	<form>
		<div class="form-group">
			<input type="text" class="form-control" id="zoekScholen" placeholder="Typ hier de naam van de school, of de plaats van de school">
		</div>
	</form>
	@endif

	@if(isset($hide_search_window))
	<form hidden style="display: none;">
		<div class="form-group">
			<input type="text" class="form-control" id="zoekScholen" placeholder="Typ hier de naam van de school, of de plaats van de school" hidden style="display: none;">
		</div>
	</form>
	@endif

	@if(isset($schools))
	@foreach($schools as $val => $school)
	<div class="col-md-12">
	<div class="school" id="{{$school->id}}" hidden>

		<div class="col-md-3"><center>
			<br>
			{{ Html::image("img/Efrain Marks I.jpg", 'alt', array( 'width' => 160, 'height' => 120 )) }}</center>
			<?php $googleAdres = $school->adres.' '.$school->postcode.' '.$school->plaats; ?>
		</div>

		<div class="col-sm-6">
			<a class="schoolnaam" href="{{ URL::to('/schools/'.$school->id) }}"><h3>{{$school->naam}}</h3></a>	
			<p><a href="{{$school->website}}">Bezoek de website: {{$school->website}}</a></p>	
			<p>{{$school->adres}}</p>
			<p>{{$school->postcode}} - {{$school->plaatsnaam}}</p>	
		</div>

		<div class="col-sm-3">
			<a align="right" class="example-body" data-trigger="hover" rel="popover" data-content='<img width="550" src="http://maps.googleapis.com/maps/api/staticmap?center={{$school->naam}},+{{$school->adres}},+{{$school->plaatsnaam}}&zoom=13&scale=false&size=600x300&markers=color:blue%7Clabel:S%7C{{$googleAdres}}&maptype=roadmap&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7Clabel:1%7Cmerelstraat+46,+schagen&key=AIzaSyC0yC9C6prEDi81MgLvL_sLo-Fmu8nXdAA" alt="Google Map">' data-original-title="{{$school->naam}}, {{$school->postcode}}, {{$school->plaatsnaam}}" href="https://www.google.nl/maps/place/{{$school->adres}}+{{$school->postcode}}+{{$school->plaatsnaam}}"><h3>Toon op kaart</h3></a>
		</div>
				
		<div class="zoekWaarden" hidden><center>
			{{$school->naam}} {{$school->plaatsnaam}} {{$school->website}} {{$school->postcode}} {{$school->adres}} {{$school->brin}} {{$school->naam_alias}}</center>
		</div>

	</div>	
	</div>	
	@endforeach
	@endif

		<!-- Default bootstrap modal example -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Modal title</h4>
					</div>
					<div class="modal-body">
						...
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<!--  <button type="button" class="btn btn-primary">Save changes</button> -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
//hugeimage: http://www.spitzer.caltech.edu/uploaded_files/images/0006/3034/ssc2008-11a12_Huge.jpg
//var image = '<img width="550" src="http://maps.googleapis.com/maps/api/staticmap?center=Albany,+NY&zoom=13&scale=false&size=600x300&maptype=roadmap&format=png&visual_refresh=true&markers=size:small%7Ccolor:0x18467e%7Clabel:0%7CAlbany,+NY" alt="Google Map of Albany, NY"">';
//var image = '<img width="550" src="http://www.astray.com/static/earth-huge.png?random=453456" alt="Google Map of Albany, NY"">';

// Set our default popover options
$.fn.popover.Constructor.DEFAULTS.trigger = 'click';
$.fn.popover.Constructor.DEFAULTS.placement = 'bottom';

// Attach the event on jQuery DOM Ready
$(function () {
	$("#example-div").popover({
		content: image, 
		html: true,
		placement: 'bottom',
        container: '.well' // Popover scrolls with div.well
    });

	$(".example-body").popover({
        //content: image, 
        html: true,
        placement: 'bottom',
        container: 'body' // Popover scrolls with body
    });
});

//console.log($.fn.popover.Constructor.DEFAULTS);

/* ------------------------
 * -- Popover Properties --
 * ------------------------
 * animation: true
 * container: false
 * content: ""
 * delay: 0
 * html: false
 * placement: "bottom"*
 * selector: false
 * template: "<div class="popover">...</div>"
 * title: ""
 * trigger: "hover"
 */
</script>

<script>
//om case insensitive te kunnen zoeken:
$.extend($.expr[":"], {
	"containsNC": function(elem, i, match, array) {
		return (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
	}
});

// Fill modal with content from link href
$("#myModal").on("show.bs.modal", function(e) {
	console.log('my modal');
	var link = $(e.relatedTarget);
	$(this).find(".modal-body").load(link.attr("href"));
});

$(document).ready(function smoothScroll() {

	//verschillende zoekveld events	
	document.getElementById("zoekScholen").onkeyup = logEvent;
	document.getElementById("zoekScholen").onpaste = logEvent;
	document.getElementById("zoekScholen").onchange  = logEvent;
	
	$(window).bind('beforeunload', function(){
		beforeUnloadSaveLocalStorage();
		//return 'Are you sure you want to leave?';
	});	


	if (typeof(localStorage.zoekwoord) != "undefined" && localStorage.zoekwoord !== null) {
		zoekwoord = localStorage.zoekwoord
		document.getElementById("zoekScholen").value = localStorage.zoekwoord;

		if (document.getElementById("zoekScholen").value.length > 2) {
			console.log("greater than 3");

			$(".school").hide();

		//zoekwaarde komt niet voor? verbergen
		$(".zoekWaarden:not(:containsNC('"+zoekwoord+"'))").parent("div").hide();
		
		//zoekwaarde komt voor? showen
		$(".zoekWaarden:containsNC('"+zoekwoord+"')").parent("div").show();
		} else {
			$(".school").hide();
		}
	}

	function beforeUnloadSaveLocalStorage(){
		localStorage.zoekwoord = document.getElementById("zoekScholen").value;
	}

	//tooltip activeren:
	$('[data-toggle="popover"]').popover(); 
	
	//bij het laden van een ajax pagina moeten er opnieuw listeners worden geactiveerd voor de tooltips.
	//als ik dit doe gelijk na het laden werkt de knop af en toe niet. volgens mij komt dit doordat de pagina niet volledig
	//daarom deze functie: een soort failsafe methode
	//is geladen, maar de event listeners wel worden toegevoegd (aan niet bestaande elements)
	$( ".giefproject" ).on( "click", "#giefproject", function() {
		$('[data-toggle="popover"]').popover(); 
	});


	
	//dit is de functie voor het zoeken:
	function logEvent(e) {
		//nooit alle resultaten weergeven
		if (this.value.length > 2) {
			console.log("greater than 3");

			$(".school").hide();

		//zoekwaarde komt niet voor? verbergen
		$(".zoekWaarden:not(:containsNC('"+this.value+"'))").parent("div").hide();
		
		//zoekwaarde komt voor? showen
		$(".zoekWaarden:containsNC('"+this.value+"')").parent("div").show();
		} else {
			$(".school").hide();
		}
			//altijd de top row weergeven met de kolomnamen
			//$("#list").show();
	}
	
	function findRightWijkprofiel(currentArray, currentId, operator) {
		
		currentIdInt = Number(currentId);
		
		//om te kunnen bepalen of we bij het einde zijn:
		arrayLength = currentArray.length;
		
		//zoek het huidige ID in de array en sla de index op.
		arrayIndex = currentArray.indexOf(currentIdInt);
		
		//ga naar de volgende / vorige. als operator prev or next meegeven
		if (operator == "next") {
			arrayIndex++;
			//het einde voorbij? naar het begin
			if (arrayIndex >= arrayLength ) {
				arrayIndex = 0;
			}
		}

		if (operator == "prev") {
			arrayIndex--;
			//zijn we bij -1? naar het einde.
			if (arrayIndex == -1 ) {
				arrayIndex = arrayLength-1;
			}
		}	

		//we hebben nu de juiste index bepaald, 
		return currentArray[arrayIndex];		
	}
	
	//bij het laden alle meso projectinformatie op hide zetten
	//$(".school").hide();
	
	//bij een klik in de table, eerst alle projectinformatie hiden (reset) daarna geklikte projectinformatie tonen
	$('.button').click(function(){
		//alle artikelen hiden:
		$(".song").hide();
		//geselecteerde artikel opslaan als var en tonen:
		var plxShow = $("#song"+this.id);
		plxShow.show();
	})
	
	//project weergeven en automatisch scrollen bij een klik
	$('.showoneprojectbutton').click(function(){
		str = this.id;
		$(".eenproject").hide();
		
		//ajax aanroepen om in te laden:
		getWijkprofiel(str);					
		
	})
	
	//klein script om navbar elementen na een klik te highlighten.
	//uitgezet om de opmaak te verbeteren:
	$('.navbar li').click(function(e) {
		//console.log('geklikt op: ', $(this));
		//var $this = $(this);
		//als het NIET actief is
		//if (!$this.hasClass('active')) {
			//bij alle classes de class active verwijderen:
			//$('.navbar li').removeClass('active');
			//alleen waarop geklikt is actief maken:
			//$this.addClass('active');
		//}
	});
	
	//ajax aanroepen om in te laden:
	function getWijkprofiel(str) {
		
		if (str == "") {
			document.getElementById("giefproject").innerHTML = "";
			return;
		} else { 
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("giefproject").innerHTML = xmlhttp.responseText;
					
					//tooltip activeren:
					$('[data-toggle="popover"]').popover(); 
					
					//naar het geladen element scrollen: de eerste keer niet!
					if (scrollToProject == "false") {
						scrollToProject = "true";
					} else {
						var target = $(".headerone");
						$('html,body').animate({
							scrollTop: target.offset().top
						}, 100);
					}						
				}
			}
			xmlhttp.open("GET","ajaxRequestWijkprofiel2.php?inputid="+str,true);
			xmlhttp.send();
		}
	}

	//om te kunnen navigeren met het keyboard. 1tm4 voor tabbladen navigatie
	//up down links rechts voor 
	// $(window).keyup(function (e) {
	// 	if($(".form-control").is(":focus") == true) {
	// 		//$(".headerone").text("Zoeken...");
	// 	}
		
	// 	else {
	// 		if (e.keyCode == 49) { // 1        and 27 = Escape
	// 			$('.nav a[href="#Projectinformatie"]').tab('show'); 
	// 		}
	// 		if (e.keyCode == 50) { // 2        
	// 			$('.nav a[href="#Verloop"]').tab('show'); 
	// 		}
	// 		if (e.keyCode == 51) { // 3        
	// 			$('.nav a[href="#Methode"]').tab('show'); 
	// 		}
	// 		if (e.keyCode == 52) { // 4        
	// 			$('.nav a[href="#Bronnen"]').tab('show'); 
	// 		}
	// 	} //einde else
	// }); //einde window keyup function		
}); //einde document ready
</script>

@stop

