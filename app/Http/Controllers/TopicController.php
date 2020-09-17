<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreContent;
use App\Topic;

class TopicController extends Controller
{
	public function allTopics()
    {
        return view('welcome', ['data' => Topic::all()]);
    }

    public function newTopic()
    {
        return view('content.topic');
    }

    public function addTopic(StoreContent $request) 
    {
    	$topic = new Topic($request->all());
    	auth()->user()->contents()->save($topic);

    	return redirect()->route('topics');
    }
}
