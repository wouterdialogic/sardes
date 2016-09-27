<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
	public $fieldsToRetrieve = "";
	public $showColumns = ['naam', "postcode", "plaatsnaam", "bevoegd_gezag", "website"];
	public $allColumns = ['id', 'brin', 'naam', "postcode", "plaatsnaam", "bevoegd_gezag", "website"];
}
