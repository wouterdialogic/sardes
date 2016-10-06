@extends('layouts.default')
@section('content')

<?php
    $school['meta_score_leerlingen'] = $school['meta_score_leerlingen'] / 5;
    $school['meta_score_onderwijs'] = $school['meta_score_onderwijs'] / 5;
    $school['meta_score_voorzieningen']  = $school['meta_score_voorzieningen']  / 5;
    $school['meta_score_afspraken']  = $school['meta_score_afspraken']  / 5;
    $school['meta_score_samenwerken'] = $school['meta_score_samenwerken'] / 5;
    $school['brin'] = substr($school['brin'], 0, 4);
?>


<style>

 .col-md-12 {
 	//background-color: #F6DFDF
 }
 
 .col-md-5 {
 	background-color: #C6DFDF
 }  

 .col-md-7 {
 	background-color: #C6DFAF
 } 

 .col-md-6 {
 	//background-color: #C6AFDF
 } 

 .col-md-8 {
 	//background-color: #A6EFDF
 } 

 .col-md-4 {
 	//background-color: #C6AFDF
 }

.popover{
    max-width: 100%; /* Max Width of the popover (depending on the container!) */
}

</style>


	<div class="col-md-12">
	<h2>{{ $school['naam'] }} </h2>				<p>{{ $school['adres'] }}, {{ $school['postcode'] }} - {{ $school['plaatsnaam'] }}</p>
	</div>

	<div class="col-md-6">
	</form>

	@if(isset($school))
		<div class="school">
		<br>

		<div class="column row" >
			<div class="col-xs-5">
				<p>Website van de school</p>
			</div>
			<div class="col-xs-6">
				<a href="{{ $school['website'] }}"><p>Bezoek de website van de school</p></a>
			</div>
		</div>	
		<br>
		
		<div class="column row" >
			<div class="col-xs-5">
				<p>Schoolondersteuningsprofiel  </p>
			</div>
			<div class="col-xs-5">
				<!-- <a href="http://dialogiconderzoek.nl/wouter/sardes/AboeelChayr.pdf">Bekijk het rapport als pdf bestand</a> -->
				
				<a href="{{ URL::to('/rapporten/') }}/{{ $school['brin'] }}.pdf"><p>Bekijk het profiel als pdf bestand</p></a>
			</div>
		</div>	
		<br>

		<div class="column row" >
			<div class="col-xs-5">
				<p>Link naar de website van onderwijsinspectie</p>
			</div>
			<div class="col-xs-5">
				<a href="http://www.onderwijsinspectie.nl/zoek-en-vergelijk?zoekterm={{ $school['brin'] }}"><p>De onderwijsinspectie website</p></a>
			</div>
		</div>	
		<br>
	
		<hr><br>

		<div class="column row" >
			<div class="col-xs-5">
				<a align="left" class="example-body" data-trigger="hover" rel="popover" data-content='
1 - als het om leren gaat verschillen de kinderen heel weinig van elkaar <br>
2 - als het om leren gaat verschillen de kinderen weinig van elkaar <br>
3 - als het om leren gaat verschillen de kinderen niet zo veel van elkaar<br>
4 - als het om leren gaat verschillen de kinderen veel van elkaar <br>
5 - als het om leren gaat verschillen de kinderen heel veel van elkaar 
' data-original-title="Toelichting" ><p>Leerlingnen</p></a>
			</div>
			<div class="col-xs-6">
				<?php 
		      		for ($i = 0; $i<5; $i++) {
		      			if ( $school['meta_score_leerlingen'] > $i) {

		      				//echo '<img src="/img/icons/icoon leerlingen.svg" height="25" >';
		      				?>
		      				<img src="{{asset('/img/icons/icoon leerlingen.svg')}}" height="25" >
		      				<?php
		      			} else {
		      				?>
		      				<img src="{{asset('/img/icons/icoon leerlingen grijs.svg')}}" height="25" >
		      				<?php
		      				//echo '<img src="/img/icons/icoon leerlingen grijs.svg" height="25" >';
		      			}
		      		}
		      	?>
			</div>
		</div>	
		<br>

		<div class="column row" >
			<div class="col-xs-5">
				<a align="left" class="example-body" data-trigger="hover" rel="popover" data-content='
1 - De manier van lesgeven past niet bij elke leerling <br>
2 - De manier van lesgeven past niet bij elke leerling <br>
3 - De manier van lesgeven past bij de gemiddelde leerling <br>
4 - De manier van lesgeven past bij de meeste leerlingen <br>
5 - De manier van lesgeven past bij vrijwel iedere leerling
' data-original-title="Toelichting"><p>Onderwijs</p></a>
			</div>
			<div class="col-xs-6">
		      	<?php 
		      		for ($i = 0; $i<5; $i++) {
		      			if ( $school['meta_score_onderwijs'] > $i) {
		      				?>
		      				<img src="{{asset('/img/icons/icoon onderwijs.svg')}}" height="25" >
		      				<?php
		      				//echo '<img src="/img/icons/icoon onderwijs.svg" height="25" >';
		      			} else {
		      				?>
		      				<img src="{{asset('/img/icons/icoon onderwijs grijs.svg')}}" height="25" >
		      				<?php
		      				//echo '<img src="/img/icons/icoon onderwijs grijs.svg" height="25" >';
		      			}
		      		}
		      	?>
			</div>
		</div>	
		<br>

		<div class="column row" >
			<div class="col-xs-5">
				<a align="left" class="example-body" data-trigger="hover" rel="popover" data-content='
1 - Deze school werkt nauwelijks samen met andere scholen<br>
2 - Deze school werkt weinig samen met andere scholen<br>
3 - Deze school werkt samen met andere scholen<br>
4 - Deze school werkt veel samen met andere scholen<br>
5 - Deze school werkt intensief samen met andere scholen
' data-original-title="Toelichting"><p>Samenwerken</p></a>
			</div>
			<div class="col-xs-6">
		      	<?php 
		      		for ($i = 0; $i<5; $i++) {
		      			if ( $school['meta_score_samenwerken'] > $i) {
		      				?>
		      				<img src="{{asset('/img/icons/icoon samenwerken.svg')}}" height="25" width="46" >
		      				<?php
		      				//echo '<img src="/img/icons/icoon samenwerken.svg" height="25" width="46">';
		      			} else {
		      				?>
		      				<img src="{{asset('/img/icons/icoon samenwerken grijs.svg')}}" height="25" width="46">
		      				<?php		      				
		      				//echo '<img src="/img/icons/icoon samenwerken grijs.svg" height="25" width="46">';
		      			}
		      		}
		      	?>
			</div>
		</div>	
		<br>

		<div class="column row" >
			<div class="col-xs-5">
				<a align="left" class="example-body" data-trigger="hover" rel="popover" data-content='
1 - Als leerlingen iets extra’s nodig hebben is nauwelijks iets vastgelegd<br>
2 - Als leerlingen iets extra’s nodig hebben is niet alles duidelijk vastgelegd<br>
3 - Als leerlingen iets extra’s nodig hebben zijn de belangrijkste zaken duidelijk vastgelegd<br>
4 - Als leerlingen iets extra’s nodig hebben is bijna alles duidelijk vastgelegd<br> 
5 - Als leerlingen iets extra’s nodig hebben is alles duidelijk vastgelegd 
' data-original-title="Toelichting"><p>Afspraken</p></a>
			</div>
			<div class="col-xs-6">
		      	<?php 
		      		for ($i = 0; $i<5; $i++) {
		      			if ( $school['meta_score_afspraken'] > $i) {
		      				?>
		      				<img src="{{asset('/img/icons/icoon afspraken.svg')}}" height="25" >
		      				<?php		      				
		      				//echo '<img src="/img/icons/icoon afspraken.svg" height="25" >';
		      			} else {
		      				?>
		      				<img src="{{asset('/img/icons/icoon afspraken grijs.svg')}}" height="25" >
		      				<?php			      				
		      				//echo '<img src="/img/icons/icoon afspraken grijs.svg" height="25" >';
		      			}
		      		}
		      	?>
			</div>
		</div>	
		<br>

		<div class="column row" >
			<div class="col-xs-5">
				<a align="left" class="example-body" data-trigger="hover" rel="popover" data-content='
1 - De school heeft heel weinig voorzieningen voor leerlingen die dat nodig hebben<br>
2 - De school heeft weinig voorzieningen voor leerlingen die dat nodig hebben<br>
3 - De school heeft het gebruikelijke aantal voorzieningen voor leerlingen die dat nodig hebben<br>
4 - De school heeft veel voorzieningen voor leerlingen die dat nodig hebben<br>
5 - De school heeft heel veel voorzieningen voor leerlingen die dat nodig hebben

' data-original-title="Toelichting"><p>Voorzieningen</p></a>
			</div>
			<div class="col-xs-6">
		      	<?php 
		      		for ($i = 0; $i<5; $i++) {
		      			if ( $school['meta_score_voorzieningen'] > $i) {
		  		      		?>
		      				<img src="{{asset('/img/icons/icoon voorzieningen.png')}}" height="25" >
		      				<?php
		      				//echo '<img src="/img/icons/icoon voorzieningen.png" height="25" >';
		      			} else {
		  		      		?>
		      				<img src="{{asset('/img/icons/icoon voorzieningen grijs.svg')}}" height="25" >
		      				<?php		      				
		      				//echo '<img src="/img/icons/icoon voorzieningen grijs.svg" height="25" >';
		      			}
		      		}
		      	?>
			</div>
		</div>	

			<div class="column row" >
				<div class="col-md-6">
					<!-- <div id="container" style='align:"left"; min-width: 650px; max-width: 650px; height: 400px; margin: 0 auto'></div> -->
				</div><div class="col-md-6"></div>
			</div>		
		</div>
	@endif

	</div>
{{-- 'class' => 'img-responsive' --}}
	<div class="col-md-6" align="right"><br>
	{{ Html::image("img/".$school['brin'].".jpg", 'alt', array( 'width' => '600', 'height' => '450', 'class' => 'img-responsive' )) }}
	</div>

	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>.
	<script type="text/javascript">
		$.fn.popover.Constructor.DEFAULTS.trigger = 'click';
		$.fn.popover.Constructor.DEFAULTS.placement = 'bottom';

		$(function () {
			$("#popoverLeerlingen").popover({
				html: true,
				placement: 'bottom'
		        //container: '.well' // Popover scrolls with div.well
		    });

			$(".example-body").popover({
		        //content: image, 
		        html: true,
		        placement: 'bottom',
		        container: 'body' // Popover scrolls with body
		    });
		});
	</script>

@stop


