<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KalenderController extends Controller
{
    public function showKalender()
    {
        return view('user.kalender'); // Pastikan file blade bernama kalender.blade.php
    }
}
