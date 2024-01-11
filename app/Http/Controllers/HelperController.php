<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\His\TrxMedical;

class HelperController extends Controller
{
    function printAntrianPoli($id ="") {
        return view('helper.print-antrian-poli');
    }
}
