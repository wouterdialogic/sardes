<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    public $showColumns = ['postcode', 'st_x', 'st_y'];
}
