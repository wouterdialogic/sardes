<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
   <script src="js/infobox.js" type="text/javascript"></script>
   <script src="test.js" type="text/javascript"></script>
   <script src="../inc/infobox.js"></script>
   
	<!--<script src="inc/infobox.js" type="text/javascript"></script>-->
	  <?php 
  echo "lol";
  //require_once("infobox.js");
  require_once("test.js");
  ?>
	
		
			</style>
  </head>
  <body>
  <a href=".">Link to this folder</a>
  <a href="infobox.js">Link to this folder</a>
    <div id="map"></div>
    <script>

		function isScriptAlreadyIncluded(src){
			var scripts = document.getElementsByTagName("script");
			for(var i = 0; i < scripts.length; i++) 
				console.log("script: ", scripts[i])
		if(scripts[i].getAttribute('src') == src) return true;
			return false;
		}
	//functionTest = isScriptAlreadyIncluded("infobox.js");
	//console.log(functionTest);
	//functionTest = isScriptAlreadyIncluded();
	//console.log(functionTest);
	
var map;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 51.94939,  lng: 5.97898},
    zoom: 8
  });
  
  
	var marker = new google.maps.Marker({
		map: map,
		draggable: true,
		position: new google.maps.LatLng(51.94939, 5.97898),
		visible: true
	});
	var boxText = document.createElement("div");
	boxText.style.cssText = "border: 1px solid black; margin-top: 8px; background: yellow; padding: 5px;";
	boxText.innerHTML = "City Hall, Sechelt<br>British Columbia<br>Canada";
	
	var myOptions = {
		content: boxText
		,disableAutoPan: false
		,maxWidth: 0
		,pixelOffset: new google.maps.Size(-140, 0)
		,zIndex: null
		,boxStyle: { 
			background: "url('tipbox.gif') no-repeat"
			,opacity: 0.75
			,width: "280px"
		}
		,closeBoxMargin: "10px 2px 2px 2px"
		,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
		,infoBoxClearance: new google.maps.Size(1, 1)
		,isHidden: false
		,pane: "floatPane"
		,enableEventPropagation: false
	};
	
	
	
	
}

		var ib = new InfoBox(myOptions);
		ib.open(map, marker);	
		
        
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0yC9C6prEDi81MgLvL_sLo-Fmu8nXdAA&callback=initMap"
        async defer></script>
  </body>
</html>