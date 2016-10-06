@extends('layouts.default')
@section('content')

<?php
$schools = '[]';
//$schoolsPHP[0]['init'] = 'init';
//$schools = json_encode($schools);
?>

<!-- http://seiyria.com/bootstrap-slider/ --> 

<link rel="stylesheet" href="{{ URL::to('/css/bootstrap-slider.css') }}">
<script src="{{ URL::to('/js/bootstrap-slider.js') }}"></script>
<script src="{{ URL::to('/js/vue.js') }}"></script>

<style type="text/css" media="screen">
	.control-label {
		font-weight: bold;
		color: #1C5F82;
	}

	.row {
		//background-color: #FBFAF1;
	}

	th {
		font-weight: normal;
		font-weight: none;
		text-decoration: none;
		text-decoration: normal;
	}

	a {
		text-decoration: none;
	}


	.oneSchool {
		//background-color: #CCDD22;
	}

	.popoverLeerlingen {
		text-decoration: none !important;
	}

	.popoverLeerlingen,p {
		text-decoration: none;
	}

	.oneSchoolHeader {
		background-color: #F4FAFB;
		//background-color: #94E1A8;
		padding: 15px;
	}
	.showResultsLabel  {
		font-size: 140%;
		//font-family: arial;
	}

	.test {
		background-color: #F5DAF3;
	}

	.form-group {
    	margin-bottom: 5px;
	}
</style>

<div id="app">
	<br>

	<!-- <p>Bepaal de locatie met postcode en straal.</p> -->
	<form class="form-horizontal">
		<div class="form-group">
			<label v-if="plaatsWarning" style="color:#8C1A1A;" for="plaats" class="col-sm-4 control-label">Deze postcode komt niet voor</label>
			<label v-else  for="plaats" class="col-sm-4 control-label">Mijn postcode is</label>
			<div class="col-sm-8">
				<input v-model="postcode" type="text" class="form-control" id="plaats" placeholder="Zoeken">
			</div>
		</div>

<!--   <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Radius (in meters)</label>
    <div class="checkbox">
    <div class="col-sm-8">
      <input v-model="radiusMeters" class="radiusSliderMeter" type="text" data-slider-min="100" data-slider-max="30000" data-slider-step="100" />
    </div>
    </div>
</div> -->

<div class="form-group">
	<label for="inputPassword3" class="col-sm-4 control-label">De afstand tussen huis en school mag zoveel kilometer zijn</label>
	<div class="checkbox">
		<div class="col-sm-8">
			<input v-model="radiusKm" debounce="500" class="radiusSlideKm" type="text" data-slider-min="100" data-slider-max="30000" data-slider-step="100" />
		</div>
	</div>
</div>

<div class="form-group bg-primary showResultsLabel" v-if="schoolsMoreThanZero" >
	<label for="inputPassword3" class="col-sm-4 control-label "></label>
	<div class="col-sm-8">
		<div class="checkbox">
			<label>			
				<p ><strong>@{{ selected.length }} scholen</strong></p>
			</label>
		</div>
	</div>
</div>  
<div class="form-group bg-warning showResultsLabel" v-if="!schoolsMoreThanZero">
	<label for="inputPassword3" class="col-sm-4 control-label "></label>
	<div class="col-sm-8">
		<div class="checkbox">
			<label>	
				<p ><strong>@{{ selected.length }} scholen</strong></p>
			</label>
		</div>
	</div>
</div>  

<div class="form-group">
	<label for="inputPassword3" class="col-sm-4 control-label">Mijn kind heeft meer dan de meeste kinderen nodig</label>
	<div class="col-sm-8">
		<div class="checkbox">
			<label>
				<input v-model="aanbod_2" type="checkbox">Ondersteuning bij het leren
			</label>
		</div>
	</div>
</div>    

<div class="form-group">
	<label for="inputPassword3" class="col-sm-4 control-label"></label>
	<div class="col-sm-8">
		<div class="checkbox">
			<label>
				<input v-model="aanbod_3" type="checkbox">Begeleiding bij gedrag
			</label>
		</div>
	</div>
</div>    

<div class="form-group">
	<label for="inputPassword3" class="col-sm-4 control-label"></label>
	<div class="col-sm-8">
		<div class="checkbox">
			<label>
				<input v-model="aanbod_4" type="checkbox">Begeleiding vanwege een ziekte, lichamelijke beperking of aandoening
			</label>
		</div>
	</div>
</div>    

<!-- <div class="form-group">
	<label for="inputPassword3" class="col-sm-4 control-label"></label>
	<div class="col-sm-8">
		<div class="checkbox">
			<label>
				<input v-model="aanbod_5" type="checkbox">Begeleiding vanwege een ziekte, lichamelijke beperking of aandoening
			</label>
		</div>
	</div>
</div>   -->

<div class="form-group">
	<label for="aanbod1" class="col-sm-4 control-label"></label>
	<div class="col-sm-8">
		<div class="checkbox">
			<label>
				<input v-model="aanbod_1" type="checkbox">Ondersteuning vanwege een moeilijke thuissituatie 
			</label>
		</div>
	</div>
</div>  

<div class="form-group">
	<label for="aanbod1" class="col-sm-4 control-label">Zoek scholen waar meer dan gewoonlijk</label>
	<div class="col-sm-8">
		<div class="checkbox">
			<label>
				<input v-model="vraag_1" type="checkbox">Extra aandacht tijdens de les is
			</label>
		</div>
	</div>
</div>  

<div class="form-group">
	<label for="inputPassword3" class="col-sm-4 control-label"></label>
	<div class="col-sm-8">
		<div class="checkbox">
			<label>
				<input v-model="vraag_2" type="checkbox">Aangepaste lesmaterialen zijn
			</label>
		</div>
	</div>
</div>    

<div class="form-group">
	<label for="inputPassword3" class="col-sm-4 control-label"></label>
	<div class="col-sm-8">
		<div class="checkbox">
			<label>
				<input v-model="vraag_3" type="checkbox">Speciale voorzieningen in het schoolgebouw zijn
			</label>
		</div>
	</div>
</div>    

<div class="form-group">
	<label for="inputPassword3" class="col-sm-4 control-label"></label>
	<div class="col-sm-8">
		<div class="checkbox">
			<label>
				<input v-model="vraag_4" type="checkbox">Voor sommige problemen een specialist in het team zit
			</label>
		</div>
	</div>
</div>    

<div class="form-group">
	<label for="inputPassword3" class="col-sm-4 control-label"></label>
	<div class="col-sm-8">
		<div class="checkbox">
			<label>
				<input v-model="vraag_5" type="checkbox">Men samenwerkt met zorginstanties
			</label>
		</div>
	</div>
</div>  

</form>
<hr>

<div v-if="init"></div>
<div v-else>
	<div class="results" v-if="schools.length &gt; 0" >

		<div v-for="(key, school) in selected">
			<div class="col-md-6 oneSchool" id="@{{ school.id}}">
				<a class="schoolnaam" href="{{ URL::to('/schools/' ) }}/@{{ school.id}}"><h4>@{{ school.naam}}</h4></a>	
				<table class="table table-sm">
			  <thead>
			    <tr>
					<!-- <th>First Name</th>-->
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row""><a class="popoverLeerlingen" data-trigger="hover" rel="popover" data-content="
1 - als het om leren gaat verschillen de kinderen heel weinig van elkaar <br>
2 - als het om leren gaat verschillen de kinderen weinig van elkaar <br>
3 - als het om leren gaat verschillen de kinderen niet zo veel van elkaar<br>
4 - als het om leren gaat verschillen de kinderen veel van elkaar <br>
5 - als het om leren gaat verschillen de kinderen heel veel van elkaar" data-placement="bottom" data-original-title="Toelichting"><p>Leerlingen</p></a></th>
			      <td>
			      <img v-for="n in school.meta_score_leerlingen / 5" src="{{asset('/img/icons/icoon leerlingen.svg')}}" height="25" >
			      <img v-for="n in 5 - school.meta_score_leerlingen / 5" src="{{asset('/img/icons/icoon leerlingen grijs.svg')}}" height="25" >
			      </td>
			    </tr>

			    <tr>
			      <th scope="row"><a class="popoverLeerlingen" data-trigger="hover" rel="popover" data-content="
1 - De manier van lesgeven past niet bij elke leerling <br>
2 - De manier van lesgeven past niet bij elke leerling <br>
3 - De manier van lesgeven past bij de gemiddelde leerling <br>
4 - De manier van lesgeven past bij de meeste leerlingen <br>
5 - De manier van lesgeven past bij vrijwel iedere leerling
" data-placement="bottom" data-original-title="Toelichting"><p>Onderwijs</p></a></th>
			      <td>
			      <img v-for="n in school.meta_score_onderwijs / 5" src="{{asset('/img/icons/icoon onderwijs.svg')}}" height="25" >
			      <img v-for="n in 5 - school.meta_score_onderwijs / 5" src="{{asset('/img/icons/icoon onderwijs grijs.svg')}}" height="25" >
			      </td>
			    </tr>

			    <tr>
			      <th scope="row"><a class="popoverLeerlingen" data-trigger="hover" rel="popover" data-content="
1 - Deze school werkt nauwelijks samen met andere scholen<br>
2 - Deze school werkt weinig samen met andere scholen<br>
3 - Deze school werkt samen met andere scholen<br>
4 - Deze school werkt veel samen met andere scholen<br>
5 - Deze school werkt intensief samen met andere scholen" data-placement="bottom" data-original-title="Toelichting"><p>Samenwerken</p></a></th>
			      <td>
			      <img v-for="n in school.meta_score_samenwerken / 5" src="{{asset('/img/icons/icoon samenwerken.svg')}}" height="25" width="46">
			      <img v-for="n in 5 - school.meta_score_samenwerken / 5" src="{{asset('/img/icons/icoon samenwerken grijs.svg')}}" height="25" width="46">
			      </td>
			    </tr>
			    <tr>

			      <th scope="row"><a class="popoverLeerlingen" data-trigger="hover" rel="popover" data-content="
1 - Als leerlingen iets extra’s nodig hebben is nauwelijks iets vastgelegd<br>
2 - Als leerlingen iets extra’s nodig hebben is niet alles duidelijk vastgelegd<br>
3 - Als leerlingen iets extra’s nodig hebben zijn de belangrijkste zaken duidelijk vastgelegd<br>
4 - Als leerlingen iets extra’s nodig hebben is bijna alles duidelijk vastgelegd<br> 
5 - Als leerlingen iets extra’s nodig hebben is alles duidelijk vastgelegd 
" data-placement="bottom" data-original-title="Toelichting"><p>Afspraken</p></a></th>
			      <td>
			      <img v-for="n in school.meta_score_afspraken / 5" src="{{asset('/img/icons/icoon afspraken.svg')}}" height="25" >
			      <img v-for="n in 5 - school.meta_score_afspraken / 5" src="{{asset('/img/icons/icoon afspraken grijs.svg')}}" height="25" >
			      </td>
			    </tr>

			    <tr>
			      <th scope="row"><a class="popoverLeerlingen" data-trigger="hover" rel="popover" data-content="
1 - De school heeft heel weinig voorzieningen voor leerlingen die dat nodig hebben<br>
2 - De school heeft weinig voorzieningen voor leerlingen die dat nodig hebben<br>
3 - De school heeft het gebruikelijke aantal voorzieningen voor leerlingen die dat nodig hebben<br>
4 - De school heeft veel voorzieningen voor leerlingen die dat nodig hebben<br>
5 - De school heeft heel veel voorzieningen voor leerlingen die dat nodig hebben" data-placement="bottom" data-original-title="Toelichting"><p>Voorzieningen</p></a></th>
			      <td>
			      <img v-for="n in school.meta_score_voorzieningen / 5" src="{{asset('/img/icons/icoon voorzieningen.png')}}" height="25" >
			      <img v-for="n in 5 - school.meta_score_voorzieningen / 5" src="{{asset('/img/icons/icoon voorzieningen grijs.svg')}}" height="25" >
			      </td>
			    </tr>
			  </tbody>
			</table>
	 		<hr>	
	 		</div>

			<!-- <div v-if="key % 2 == 1" class="clearfix visible-md-block"></div> -->

	 	</div>
	</div>
</div>

</div>
<br><br><br><br><br>
<script type="text/javascript">

var sourceOfTruth = {
    //postcode: null
    aanbod_1: false,
    aanbod_2: false,
    aanbod_3: false,
    aanbod_4: false,
    aanbod_5: false,
    vraag_1: false,
    vraag_2: false,
    vraag_3: false,
    vraag_4: false,
    vraag_5: false,

    plaatsWarning: false,

    init: true,

    schools: <?php echo $schools ?>
}

//sliders initalizen
$(".radiusSlideKm").slider({
	min: 0.1,
	max: 20,
	//scale: 'logarithmic',
	ticks_labels: ['0km ', ' - 10km ', ' - 20km'],
	ticks_snap_bounds: 15000,
	step: 0.1,
	value: 2
	//scale: 'logarithmic',
});

if (typeof localStorage.postcode != 'undefined' ) {
	sourceOfTruth.aanbod_1 = (localStorage.aanbod_1 === "true"); 
	sourceOfTruth.aanbod_2 = (localStorage.aanbod_2 === "true"); 
	sourceOfTruth.aanbod_3 = (localStorage.aanbod_3 === "true"); 
	sourceOfTruth.aanbod_4 = (localStorage.aanbod_4 === "true"); 
	sourceOfTruth.aanbod_5 = (localStorage.aanbod_5 === "true"); 

	sourceOfTruth.vraag_1 = (localStorage.vraag_1 === "true"); 
	sourceOfTruth.vraag_2 = (localStorage.vraag_2 === "true"); 
	sourceOfTruth.vraag_3 = (localStorage.vraag_3 === "true"); 
	sourceOfTruth.vraag_4 = (localStorage.vraag_4 === "true"); 
	sourceOfTruth.vraag_5 = (localStorage.vraag_5 === "true"); 

	sourceOfTruth.radiusKm = localStorage.radiusKm;
	sourceOfTruth.radiusKm2 = localStorage.radiusKm;
	sourceOfTruth.postcode = localStorage.postcode;
	
} 

Vue.filter('faanbod1', function(value, aanbod1) {
	return value.filter(function(item) {
		return item.aanbod1 == aanbod1;
	});
});

Vue.filter('faanbod2', function(value, aanbod2) {
	return value.filter(function(item) {
		return item.aanbod2 == aanbod2;
	});
});

var vm = new Vue({
	el: '#app',
	data: sourceOfTruth,
	computed: {
		selected: function() {
	    	/*
	    	var geselecteerdeScholen = [];

	    	for(var a=0; a<this.schools.length; a++) {
	    		var school = this.schools[a];

	    		if(this.aanbod1 && !school.aanbod1) continue;
	    		if(this.aanbod2 && !school.aanbod2) continue;

	    		geselecteerdeScholen.push(school);
	    	}

	    	return geselecteerdeScholen;*/

	    	var self = this;
	    	var attributes = ["aanbod_1", "aanbod_2", "aanbod_3", "aanbod_4", "aanbod_5", "vraag_1", "vraag_2", "vraag_3", "vraag_4", "vraag_5"];
	    	var meta_scores = ["meta_score_samenwerken", "meta_score_afspraken", "meta_score_leerlingen", "meta_score_onderwijs", "meta_score_voorzieningen"];

	    	return this.schools.filter(function(school) { //school = {vraag1:true, vraag2: false, vraag3: true}
	    		for(var a=0; a<attributes.length; a++) {
	    			var attribuutNaam = attributes[a]; // vraag1
	    			var filter = self[attribuutNaam]; // true
	    			if(filter) {
	    				if(!school[attribuutNaam]) { // 
	    					return false;
	    				}
	    			}
	    		}

				var filter = self["radiusKm"]; 
				if(filter) {
					if(school["afstand"] > filter) { 
						return false;
					}
				}

	    		return true;
	    		});
	    	},

	    schoolsMoreThanZero: function() { 
	    	var self = this;
			//console.log(this.selected.length);
			if (this.selected.length != 0) {
				return true;
			} 
	    }
	}
})

$("body").ajaxStop(function() {
  initializePopoverAfterAjax();
});

//$.ajax( .. ).always(function(data) {
//    console.log(JSON.stringify(data));
//});

$(document).ready(function smoothScroll() {
	//tooltip activeren:
	$('[data-toggle="popover"]').popover(); 
	$(".showResultsLabel").hide();
	
	postcode = checkPostcode(localStorage.postcode);
	if (postcode) {
		getWijkprofiel(postcode);
		$(".showResultsLabel").show();
	}

	$(window).bind('beforeunload', function(){
		beforeUnloadSaveLocalStorage();
		//return 'Are you sure you want to leave?';
	});

	//verschillende zoekveld events	
	document.getElementById("plaats").onkeyup = logEvent;
	document.getElementById("plaats").onpaste = logEvent;

	function checkPostcode(postcode) {
		//console.log("postcode: "+postcode);
		if (!postcode) {
			sourceOfTruth.postcode = '';
			return false;
		}
		postcode = postcode.replace(/\s/g, '');
		if ( postcode.match(/^[1-9][0-9]{3}[A-Z]{2}$/i) ) {
			return postcode;
		}
		return false;
	}

	//dit is de functie voor het zoeken:
	function logEvent(e) {

		if (userInput = checkPostcode(this.value)) {
			getWijkprofiel(userInput);
			$(".results").show();
			$(".showResultsLabel").show();

		}

		else {
			sourceOfTruth.plaatsWarning = false;
			sourceOfTruth.schools = [];
			$(".results").hide();
			$(".showResultsLabel").hide();
		}

	}

	function initializePopoverAfterAjax() {
		console.log("CLASS INITIALIZE POPOVER");
		setTimeout(function(){
    		console.log("THIS IS");
			$(".popoverLeerlingen").popover({
				html: true
			});
		}, 0);

		//$(".popoverLeerlingen").popover({ trigger: "hover" });
		//$(".popoverOnderwijs").popover({ trigger: "hover" });
		//$(".popoverSamenwerken").popover({ trigger: "hover" });
		//$(".popoverAfspraken").popover({ trigger: "hover" });
		//$(".popoverVoorzieningen").popover({ trigger: "hover" });
	}

	function beforeUnloadSaveLocalStorage(){
		localStorage.postcode = vm._data.postcode;
	 	localStorage.radiusKm = vm._data.radiusKm;
	 	localStorage.aanbod_1 = vm._data.aanbod_1;
	 	localStorage.aanbod_2 = vm._data.aanbod_2;
	 	localStorage.aanbod_3 = vm._data.aanbod_3;
	 	localStorage.aanbod_4 = vm._data.aanbod_4;
	 	localStorage.aanbod_5 = vm._data.aanbod_5;
	 	localStorage.vraag_1 = vm._data.vraag_1;
	 	localStorage.vraag_2 = vm._data.vraag_2;
	 	localStorage.vraag_3 = vm._data.vraag_3;
	 	localStorage.vraag_4 = vm._data.vraag_4;
	 	localStorage.vraag_5 = vm._data.vraag_5;
	}

	//ajax aanroepen om in te laden:
	function getWijkprofiel(str) {

		console.log("ajax: GO!");

		if (str == "") {
			//document.getElementById("ajaxResults").innerHTML = "";
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
					//vm._data.schools = JSON.parse(xmlhttp.responseText);	
					//console.log(xmlhttp.responseText);
					if (xmlhttp.responseText == '[]') {
					  
					  sourceOfTruth.plaatsWarning = true;
					  $(".results").show();

					} else {
						sourceOfTruth.schools = JSON.parse(xmlhttp.responseText);
						sourceOfTruth.init = false;
					}
					initializePopoverAfterAjax();	
					
				}


			}
			//http://localhost:9999/api/getSchoolsOfPostcode/1742gb
			
			xmlhttp.open("GET","{{ URL::to('/api/getSchoolsOfPostcode/') }}"+"/"+str,true);
			xmlhttp.send();
			//initializePopoverAfterAjax();	
		}
	}
}); //einde document ready
</script>
<script src="{{ URL::to('https://intercoolerreleases-leaddynocom.netdna-ssl.com/intercooler-0.9.7.min.js') }}"></script>
@stop

