<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreContent;
use App\Topic;
use User;

class ContentController extends Controller
{
    public function addTopic(StoreContent $request) {
    	$topic = new Topic($request->all());
    	auth()->user()->contents()->save($topic);

    	return redirect()->back();
    }
}
