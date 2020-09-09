<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class WelcomeController extends Controller
{
    //
    public function welcome()
    {
    	return view('welcome');
    }

    public function treds()
    {
    	return view('content.treds');
    }

    public function newTred()
    {
        $topics = Topic::all();

    	return view('content.new_tred', ["topics"=>$topics]);
    }
}
