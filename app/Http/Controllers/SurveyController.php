<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index () 
    {
        return view('survey.index');
    }

    public function edit () 
    {
        return view('survey.edit');
    }
}
