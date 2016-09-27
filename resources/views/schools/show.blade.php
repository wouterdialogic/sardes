@extends('layouts.default')
@section('content')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<?php
    $school['meta_score_leerlingen'] = $school['meta_score_leerlingen'] / 5;
    $school['meta_score_onderwijs'] = $school['meta_score_onderwijs'] / 5;
    $school['meta_score_voorzieningen']  = $school['meta_score_voorzieningen']  / 5;
    $school['meta_score_afspraken']  = $school['meta_score_afspraken']  / 5;
    $school['meta_score_samenwerken'] = $school['meta_score_samenwerken'] / 5;
?>

<script>
	$(function () {

    $('#container').highcharts({

        chart: {
            polar: true,
            type: 'line'
        },

        title: {
            text: 'Overzicht van vijf categorieën',
            x: -80
        },

        pane: {
            size: '80%'
        },

        xAxis: {
            categories: ['De leerlingen', 'Het onderwijs', 'De voorzieningen',
                    'Beheren van afspraken', 'Samenwerken'],
            tickmarkPlacement: 'on',
            lineWidth: 0
        },

        yAxis: {
            gridLineInterpolation: 'polygon',
            lineWidth: 0,
            min: 0
        },

        tooltip: {
            shared: true,
            pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
        },

        legend: {
            align: 'right',
            verticalAlign: 'top',
            y: 70,
            layout: 'vertical'
        },

        series: [{
            name: "<?php echo $school['naam']; ?>",
            data: [13, 12, 22, 17, 11],
            pointPlacement: 'on'
        }, {
            name: 'Gemiddelde score',
            data: [<?php echo 
	            $school['meta_score_leerlingen'] . ', ' . 
	            $school['meta_score_onderwijs'] . ', ' .
	            $school['meta_score_voorzieningen'] . ', ' . 
	            $school['meta_score_afspraken'] . ', ' . 
	            $school['meta_score_samenwerken'] . ', '; ?>],
            pointPlacement: 'on'
        }]

    });
});
</script>
<style>

 .col-md-12 {
 	//background-color: #F6DFDF
 }
 
 .col-md-5 {
 	//background-color: #C6DFDF
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



	<div class="col-md-7">
	</form>

	@if(isset($school))
		<div class="school">
		
		<br>

		<!-- <div class="column row" > -->
			<!-- <div class="col-xs-9"> -->
				<!-- <p>Straat</p> -->
			<!-- </div> -->
		<!-- 	<div class="col-xs-5">
			</div> -->
		<!-- </div>	 -->

		<!-- <div class="column row" >
			<div class="col-xs-4">
				<p> </p>
				<p>Adres</p>
			</div>
			<div class="col-xs-5">
			</div>
		</div>	
		<br> -->

		<?php
			$school['brin'] = substr($school['brin'], 0, 4);
		?>

		

		<div class="column row" >
			<div class="col-xs-4">
				<p>Website van de school</p>
			</div>
			<div class="col-xs-5">
				<a href="{{ $school['website'] }}"><p>Bezoek de website van de school</p></a>
			</div>
		</div>	
		<br>
		
		<div class="column row" >
			<div class="col-xs-4">
				<p>Schoolondersteuningsprofiel  </p>
			</div>
			<div class="col-xs-5">
				<!-- <a href="http://dialogiconderzoek.nl/wouter/sardes/AboeelChayr.pdf">Bekijk het rapport als pdf bestand</a> -->
				<a href="/rapporten/{{ $school['brin'] }}.pdf"><p>Bekijk het profiel als pdf bestand</p></a>
			</div>
		</div>	
		<br>

		<div class="column row" >
			<div class="col-xs-4">
				<p>Link naar de website van onderwijsinspectie</p>
			</div>
			<div class="col-xs-5">
				<a href="http://www.onderwijsinspectie.nl/zoek-en-vergelijk?zoekterm={{ $school['brin'] }}"><p>De onderwijsinspectie website</p></a>
			</div>
		</div>	
		<br>
	
		<hr><br>

		<div class="column row" >
			<div class="col-xs-4">
				<a align="left" class="example-body" data-trigger="hover" rel="popover" data-content='
1 - als het om leren gaat verschillen de kinderen heel weinig van elkaar <br>
2 - als het om leren gaat verschillen de kinderen weinig van elkaar <br>
3 - als het om leren gaat verschillen de kinderen niet zo veel van elkaar<br>
4 - als het om leren gaat verschillen de kinderen veel van elkaar <br>
5 - als het om leren gaat verschillen de kinderen heel veel van elkaar 
' data-original-title="Toelichting" ><p>Leerlignen</p></a>
			</div>
			<div class="col-xs-5">
				<?php 
			      		for ($i = 0; $i<5; $i++) {
			      			if ( $school['meta_score_leerlingen'] > $i) {
			      				echo '<img src="/img/icons/icoon leerlingen.svg" height="25" >';
			      			} else {
			      				echo '<img src="/img/icons/icoon leerlingen grijs.svg" height="25" >';
			      			}
			      		}
			      	?>
			</div>
		</div>	
		<br>

		<div class="column row" >
			<div class="col-xs-4">
				<a align="left" class="example-body" data-trigger="hover" rel="popover" data-content='
1 - De manier van lesgeven past niet bij elke leerling <br>
2 - De manier van lesgeven past niet bij elke leerling <br>
3 - De manier van lesgeven past bij de gemiddelde leerling <br>
4 - De manier van lesgeven past bij de meeste leerlingen <br>
5 - De manier van lesgeven past bij vrijwel iedere leerling
' data-original-title="Toelichting"><p>Onderwijs</p></a>
			</div>
			<div class="col-xs-5">
			      	<?php 
			      		for ($i = 0; $i<5; $i++) {
			      			if ( $school['meta_score_onderwijs'] > $i) {
			      				echo '<img src="/img/icons/icoon onderwijs.svg" height="25" >';
			      			} else {
			      				echo '<img src="/img/icons/icoon onderwijs grijs.svg" height="25" >';
			      			}
			      		}
			      	?>
			</div>
		</div>	
		<br>

		<div class="column row" >
			<div class="col-xs-4">
				<a align="left" class="example-body" data-trigger="hover" rel="popover" data-content='
1 - als het om leren gaat verschillen de kinderen heel weinig van elkaar <br>
2 - als het om leren gaat verschillen de kinderen weinig van elkaar <br>
3 - als het om leren gaat verschillen de kinderen niet zo veel van elkaar<br>
4 - als het om leren gaat verschillen de kinderen veel van elkaar <br>
5 - als het om leren gaat verschillen de kinderen heel veel van elkaar 
' data-original-title="Toelichting"><p>Samenwerken</p></a>
			</div>
			<div class="col-xs-5">
			      	<?php 
			      		for ($i = 0; $i<5; $i++) {
			      			if ( $school['meta_score_samenwerken'] > $i) {
			      				echo '<img src="/img/icons/icoon samenwerken.svg" height="25" width="46">';
			      			} else {
			      				echo '<img src="/img/icons/icoon samenwerken grijs.svg" height="25" width="46">';
			      			}
			      		}
			      	?>
			</div>
		</div>	
		<br>

		<div class="column row" >
			<div class="col-xs-4">
				<a align="left" class="example-body" data-trigger="hover" rel="popover" data-content='
1 - als het om leren gaat verschillen de kinderen heel weinig van elkaar <br>
2 - als het om leren gaat verschillen de kinderen weinig van elkaar <br>
3 - als het om leren gaat verschillen de kinderen niet zo veel van elkaar<br>
4 - als het om leren gaat verschillen de kinderen veel van elkaar <br>
5 - als het om leren gaat verschillen de kinderen heel veel van elkaar 
' data-original-title="Toelichting"><p>Afspraken</p></a>
			</div>
			<div class="col-xs-5">
			      	<?php 
			      		for ($i = 0; $i<5; $i++) {
			      			if ( $school['meta_score_afspraken'] > $i) {
			      				echo '<img src="/img/icons/icoon afspraken.svg" height="25" >';
			      			} else {
			      				echo '<img src="/img/icons/icoon afspraken grijs.svg" height="25" >';
			      			}
			      		}
			      	?>
			</div>
		</div>	
		<br>

		<div class="column row" >
			<div class="col-xs-4">
				<a align="left" class="example-body" data-trigger="hover" rel="popover" data-content='
1 - De manier van lesgeven past niet bij elke leerling <br>
2 - De manier van lesgeven past niet bij elke leerling <br>
3 - De manier van lesgeven past bij de gemiddelde leerling <br>
4 - De manier van lesgeven past bij de meeste leerlingen <br>
5 - De manier van lesgeven past bij vrijwel iedere leerling
' data-original-title="Toelichting"><p>Voorzieningen</p></a>
			</div>
			<div class="col-xs-5">
			      	<?php 
			      		for ($i = 0; $i<5; $i++) {
			      			if ( $school['meta_score_voorzieningen'] > $i) {
			      				echo '<img src="/img/icons/icoon voorzieningen.png" height="25" >';
			      			} else {
			      				echo '<img src="/img/icons/icoon voorzieningen grijs.svg" height="25" >';
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

	<div class="col-md-5" align="right"><br>
	{{ Html::image("img/".$school['brin'].".jpg", 'alt', array( 'width' => 400, 'height' => 400 )) }}
	</div>


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


