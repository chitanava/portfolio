<?php

namespace App\Http\Controllers;

use App\Models\Biography;
use Illuminate\Http\Request;

class BiographyController extends Controller
{
    public function index()
    {
        $biography = Biography::firstOrFail();

        return view('site.biography', ['biography' => $biography]);
    }
}
