<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Postcode;
use App\School;
use App\Postcode_locatie;

class Admin extends Controller
{
    //
    //gebruikt de tabel postcode_locatie om de tabel schools aan te vullen
    //rd_x
    //rd_y
    //wgs84_x
    //wgs84_y
    //worden gevuld
    //eerst wordt gezocht op wijkcode + lettercombinatie + huisnr.
    //geen resultaten? dan wijkcode + lettercombinatie
	public function provision() {
		$schools = School::all();
		$counter = 0;

		foreach ($schools as $key => $school ) {

    		//coordinaten berekenen.
			$school['postcode'] = strToUpper(str_replace(' ', '', $school['postcode']));
			$wijkcode = substr($school['postcode'], 0, 4);
			$lettercombinatie = substr($school['postcode'], 4, 2);
			$huisnummer = filter_var($school['adres'], FILTER_SANITIZE_NUMBER_INT);

			$matchOptionOne = ['wijkcode' => $wijkcode, 'lettercombinatie' => $lettercombinatie, 'huisnr' => $huisnummer];

			$postcode_locatie = Postcode_locatie::where($matchOptionOne)->first();

			if (!$postcode_locatie) {
				$matchOptionTwo = ['wijkcode' => $wijkcode, 'lettercombinatie' => $lettercombinatie];

				$postcode_locatie = Postcode_locatie::where($matchOptionTwo)->first();
			}

			if ($postcode_locatie) {

				$schools[$key]['rd_x'] = $postcode_locatie["rd_x"];
				$schools[$key]['rd_y'] = $postcode_locatie["rd_y"];
				$schools[$key]['wgs84_x'] = $postcode_locatie["lat"];
				$schools[$key]['wgs84_y'] = $postcode_locatie["long"];

				

				$counter++;
			}


    		//scores berekenen:
			//•	Ondersteuning nodig vanwege een moeilijke thuissituatie; scholen met  ‘Het onderwijs’ >15 punten en een 1 op ‘//Samenwerken met zorginstanties’ en ‘Vastleggen en omschrijven van afspraken’ >10
//
			//meta_score_onderwijs, vraag_5, meta_score_afspraken
//
			//•	Ondersteuning bij het leren; scholen met ‘Het onderwijs’ >10 en ‘Vastleggen en omschrijven van afspraken’ >10
			//•	Begeleiding bij gedrag; scholen met ‘Het onderwijs’ >15 en ‘Vastleggen en omschrijven van afspraken’ >10
			//•	Begeleiding vanwege een lichamelijke beperking; scholen met een 1 op ‘Samenwerken met zorginstanties en ‘Vastleggen //en omschrijven van afspraken’ > 10 en ‘Samenwerken’ >10
			//•	Begeleiding vanwege ziekte of een aandoening;   scholen met een 1 op ‘Samenwerken met zorginstanties en ‘Vastleggen //en omschrijven van afspraken’ > 10 en ‘Samenwerken’ >10

			//score_moeilijke_thuissituatie
			if (
				$schools[$key]['meta_score_onderwijs'] > 15 and 
				$schools[$key]['aanbod_5'] == 1 and 
				$schools[$key]['meta_score_afspraken'] > 10) 
			{
				$schools[$key]['vraag_1'] = 1;
			} else {
				$schools[$key]['vraag_1'] = 0;
			}

			//score_ondersteuning_leren
			if (
				$schools[$key]['meta_score_onderwijs'] > 10 and 
				$schools[$key]['meta_score_afspraken'] > 10 ) 
			{
				$schools[$key]['vraag_2'] = 1;
			} else {
				$schools[$key]['vraag_2'] = 0;
			}

			//score_begeleiding_gedrag
			if (
				$schools[$key]['meta_score_onderwijs'] > 15 and 
				$schools[$key]['meta_score_afspraken'] > 10 ) 
			{
				$schools[$key]['vraag_3'] = 1;
			} else {
				$schools[$key]['vraag_3'] = 0;
			}

			//score_begeleiding_lichamelijke_beperking
			if (
				$schools[$key]['meta_score_afspraken'] > 10 and 
				$schools[$key]['aanbod_5'] == 1 and 
				$schools[$key]['meta_score_samenwerken'] > 10 ) 
			{
				$schools[$key]['vraag_4'] = 1;
			} else {
				$schools[$key]['vraag_4'] = 0;
			}

			//score_begeleiding_ziekte
			if (
				$schools[$key]['meta_score_afspraken'] > 10 and 
				$schools[$key]['aanbod_5'] == 1 and 
				$schools[$key]['meta_score_samenwerken'] > 10 ) 
			{
				$schools[$key]['vraag_5'] = 1;
			} else {
				$schools[$key]['vraag_5'] = 0;
			}

			$schools[$key]->save();
			//$schools[$key]['meta_score_leerlingen']
			//$schools[$key]['meta_score_onderwijs']
			//$schools[$key]['meta_score_voorzieningen']
			//$schools[$key]['meta_score_afspraken']
			//$schools[$key]['meta_score_samenwerken']
//
			//$schools[$key]['score_moeilijke_thuissituatie']
			//$schools[$key]['score_ondersteuning_leren']
			//$schools[$key]['score_begeleiding_gedrag']
			//$schools[$key]['score_begeleiding_lichamelijke_beperking']
			//$schools[$key]['score_begeleiding_ziekte']
//
			//Extra hulp tijdens de les	
			//Aangepaste lesmaterialen	
			//Speciale voorzieningen	
			//Specialisme binnen het team	
			//Samenwerken met zorginstanties	
//
			//De leerlingen	
			//Het onderwijs	
			//Voorzieningen	
			//Vastleggen en omschrijven van afspraken	
			//Samenwerken

	



		}

		foreach ($schools as $school) {
			echo "<br><br><h3><strong>".$school['naam']."</strong></h3>";

			echo "1: ".$school['meta_score_leerlingen'];
			echo "<br>2: ".$school['meta_score_onderwijs'];
			echo "<br>3: ".$school['meta_score_samenwerken'];
			echo "<br>4: ".$school['meta_score_afspraken'];
			echo "<br>5: ".$school['meta_score_voorzieningen'];

			echo "<br><br>1: ".$school['aanbod_1'];
			echo "<br>2: ".$school['aanbod_2'];
			echo "<br>3: ".$school['aanbod_3'];
			echo "<br>4: ".$school['aanbod_4'];
			echo "<br>5: ".$school['aanbod_5'];

			echo "<br><br><strong>1 leerlingen: ".$school['vraag_1']."</strong>";
			echo "<br><strong>2 onderwijs: ".$school['vraag_2']."</strong>";
			echo "<br><strong>3 samenwerken: ".$school['vraag_3']."</strong>";
			echo "<br><strong>4 afspraken: ".$school['vraag_4']."</strong>";
			echo "<br><strong>5 voorzieningen: ".$school['vraag_5']."</strong>";
		}

		echo "<h3> $counter scholen zijn bevoorraad. </h3>";
	}
}
