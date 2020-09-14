<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreContent;
use App\Topic;
use App\Tred;
use App\Commun;
use User;

class ContentController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function allTopics()
    {
        return view('welcome', ['data' => Topic::all()]);
    }

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

    public function newTopic()
    {
        return view('content.topic');
    }

    public function addTopic(StoreContent $request) 
    {
    	$topic = new Topic($request->all());
    	auth()->user()->contents()->save($topic);

    	return redirect()->back();
    }

    public function addTred(Topic $topic, Request $request)
    {
    	$tred = new Tred($request->all());
    	$tred->user()->associate(auth()->user());
    	$tred->topic()->associate($topic);
    	$tred->save();

    	return redirect()->back();
    }

    /*public function commun(Topic $topic, Tred $tred)
    {
        return view('commun', [
            'topicId' => $topic->readId(),
            'tredId' => $tred->readId()
        ]);
        //dd($tred->readId());
    }*/
    
    public function commun(Topic $topic)
    {
        return view('commun', ['topicId' => $topic->readId()]);
    }

    public function addCommun(Request $request)
    {
        $commun = new Commun($request->all());
        $commun->user()->associate(auth()->user());
        //це не працює бо в у вьюшкі не має згадки topic як це працює в у вьюшкі добавлення треду в опшинах
        //$commun->topic()->associate($request->get('topic'));        
        //$commun->tred()->associate($request->get('treds'));

        
        $commun->save();
        return redirect()->back();
    }
}
