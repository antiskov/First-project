<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreContent;
use App\Topic;
use App\Tred;
use User;

class ContentController extends Controller
{
    public function addTopic(StoreContent $request) 
    {
    	$topic = new Topic($request->all());
    	auth()->user()->contents()->save($topic);

    	return redirect()->back();
    }

    public function allTopics()
    {
    	return view('welcome', ['data' => Topic::all()]);
    }

    public function addTred(Request $request)
    {
    	$tred = new Tred($request->all());
    	$tred->user()->associate(auth()->user());
    	$tred->topic()->associate($request->get('topic'));
    	$tred->save();

    	return redirect()->back();
    }
}
