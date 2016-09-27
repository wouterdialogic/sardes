<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postcode;
use App\School;
use App\Postcode_locatie;

use App\Http\Requests;

class Postcodes extends Controller
{

    public function getCoordinatesOfPostcode($postcode) {
        $dbRecord = Postcode::find($postcode);

        $data['postcode']['postcode'] = $postcode;
        $data['postcode']['st_x'] = $dbRecord['st_x'];
        $data['postcode']['st_y'] = $dbRecord['st_y'];

        //echo "<pre>";
        //print_r($data);
        //echo "</pre>";

        return $data;
    }    

    //route = Route::get('api/getSchoolsOfPostcode/{postcode}', 'Postcodes@getSchoolsOfPostcode');
    public function getSchoolsOfPostcode($postcode) {

        session(['postcode' => $postcode]);

        $postcode = strToUpper(str_replace(' ', '', $postcode));
        $wijkcode = substr($postcode, 0, 4);
        $lettercombinatie = substr($postcode, 4, 2);

        $matchOptionTwo = ['wijkcode' => $wijkcode, 'lettercombinatie' => $lettercombinatie];
            
        $userPostcode = Postcode_locatie::where($matchOptionTwo)->first();

        //de postcode komt niet voor in onze database.
        if ( !isset($userPostcode) ) {
            return '[]';
        }

        $userRd_x = $userPostcode['rd_x'];
        $userRd_y = $userPostcode['rd_y'];

        $schools = School::all();

        //bereken afstand, uitkomst in km met 1 cijfer achter de komma
        foreach ( $schools as $key => $school) {
            if (isset($school["rd_x"])) {

                $x_afstand = abs($school["rd_x"] - $userRd_x);
                $y_afstand = abs($school["rd_y"] - $userRd_y);

                $school['afstand'] = sqrt ( pow( $x_afstand, 2 ) + pow( $y_afstand, 2 ) );

                $school['afstand'] = round($school['afstand'] / 1000, 1);
            
                //if ($school['afstand'] > 20) {
                //    unset($schools[$key]);
                //}

            }
        }



        //$schools = $schools->sortBy('afstand');
        $schools = json_encode($schools);
        
        //echo "<pre>";
        //print_r($schools);
        //echo "</pre>";
        
        return $schools;
        //return '['.$schools.']';
    }

    public function getSchoolsOfPostcode2($postcode) {

        session(['postcode' => $postcode]);

        $postcode = strToUpper(str_replace(' ', '', $postcode));
        $wijkcode = substr($postcode, 0, 4);
        $lettercombinatie = substr($postcode, 4, 2);

        $matchOptionTwo = ['wijkcode' => $wijkcode, 'lettercombinatie' => $lettercombinatie];
            
        $userPostcode = Postcode_locatie::where($matchOptionTwo)->first();

        echo 'UP: '.$userPostcode;

        if ( !isset($userPostcode) ) {
            return '[]';
        }

        $userRd_x = $userPostcode['rd_x'];
        $userRd_y = $userPostcode['rd_y'];

        $schools = School::all();

        //bereken afstand, uitkomst in km met 1 cijfer achter de komma
        foreach ( $schools as $key => $school) {
            if (isset($school["rd_x"])) {

                $x_afstand = abs($school["rd_x"] - $userRd_x);
                $y_afstand = abs($school["rd_y"] - $userRd_y);

                $school['afstand'] = sqrt ( pow( $x_afstand, 2 ) + pow( $y_afstand, 2 ) );

                $school['afstand'] = round($school['afstand'] / 1000, 1);
            
                //if ($school['afstand'] > 20) {
                //    unset($schools[$key]);
                //}
            }

             //$school['afstand'] = str_replace('.', ',',   $school['afstand'] );
        }
        $schools = $schools->sortBy('afstand');

        //$sorted = $collection->sortBy('price');

        $schools->values()->all();
        //$schools = json_encode($schools);
        
        echo "<h3>Postcode: $postcode</h3><hr>";
        foreach ( $schools as $key => $school) {
         echo "<br>Postcode: ".$school['postcode']. ' - afstand: '. $school['afstand'];
        }
        //return $schools;
    }

    public function getGoogleMapOfPostcode($postcode) {
        $dbRecord = Postcode::find($postcode);

        $data['postcode']['postcode'] = $postcode;
        $data['postcode']['st_x'] = $dbRecord['st_x'];
        $data['postcode']['st_y'] = $dbRecord['st_y'];     
        ?>
            <script type="text/javascript">
            //http://web.inter.nl.net/hcc/Ed.Stevenhagen/groeven/geo/rdx.htm
            //ook handig: http://www.gpscoordinaten.nl/converteer-rd-coordinaten.php
            function RDLatLong(x,y)
            {
                coordinates = [];

                x0  = 155000.000;
                y0  = 463000.000;

                f0 = 52.156160556;
                l0 =  5.387638889;

                 a01=3236.0331637 ; b10=5261.3028966;
                 a20= -32.5915821 ; b11= 105.9780241;
                 a02=  -0.2472814 ; b12=   2.4576469;
                 a21=  -0.8501341 ; b30=  -0.8192156;
                 a03=  -0.0655238 ; b31=  -0.0560092;
                 a22=  -0.0171137 ; b13=   0.0560089;
                 a40=   0.0052771 ; b32=  -0.0025614;
                 a23=  -0.0003859 ; b14=   0.0012770;
                 a41=   0.0003314 ; b50=   0.0002574;
                 a04=   0.0000371 ; b33=  -0.0000973;
                 a42=   0.0000143 ; b51=   0.0000293;
                 a24=  -0.0000090 ; b15=   0.0000291; 

                with(Math){ 
                dx=(x-x0)*pow(10,-5);
                dy=(y-y0)*pow(10,-5);

                df =a01*dy + a20*pow(dx,2) + a02*pow(dy,2) + a21*pow(dx,2)*dy + a03*pow(dy,3);
                df+=a40*pow(dx,4) + a22*pow(dx,2)*pow(dy,2) + a04*pow(dy,4) + a41*pow(dx,4)*dy;
                df+=a23*pow(dx,2)*pow(dy,3) + a42*pow(dx,4)*pow(dy,2) + a24*pow(dx,2)*pow(dy,4);
                 coordinates[0] = f0 + df/3600;

                dl =b10*dx +b11*dx*dy +b30*pow(dx,3) + b12*dx*pow(dy,2) + b31*pow(dx,3)*dy;
                dl+=b13*dx*pow(dy,3)+b50*pow(dx,5) + b32*pow(dx,3)*pow(dy,2) + b14*dx*pow(dy,4);
                dl+=b51*pow(dx,5)*dy +b33*pow(dx,3)*pow(dy,3) + b15*dx*pow(dy,5);
                 coordinates[1] = l0 + dl/3600}

                return coordinates;
            }

            result = RDLatLong(195684, 440270);

            console.log(result);
            </script>
        <?php
    }


    public function getGoogleMapOfAddress($id) {
        
        $dbRecord = School::find($id);

        $data['school']['naam'] = $dbRecord['naam'];
        $data['school']['adres'] = $dbRecord['adres'];
        $data['school']['postcode'] = $dbRecord['postcode'];
        $data['school']['plaatsnaam'] = $dbRecord['plaatsnaam'];
        
        return view('api.googleApi', $data);    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
