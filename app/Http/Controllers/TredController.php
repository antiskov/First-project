<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreContent;
use App\Topic;
use App\Tred;

class TredController extends Controller
{
    public function tredsAction(Topic $topic)
    {
        return view('content.treds', [
            'treds' => $topic->load('treds')->treds,
            'topicId' => $topic->readId()
            //запа'ятовує айді топіка щоб потім відкрити написання треду
        ]);
    }

    public function newTred(Topic $topic)
    {
        return view('content.new_tred', ['topicId' => $topic->readId()]);
    }

    public function addTred(Topic $topic, Request $request)
    {
    	$tred = new Tred($request->all());
    	$tred->user()->associate(auth()->user());
    	$tred->topic()->associate($topic);
    	$tred->save();

    	return redirect()->back();
    }
}
