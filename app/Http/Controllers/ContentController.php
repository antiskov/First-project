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
        //dd($topic->id);
        //запам'ятовує айді топіка
        //dd($topic->readId());
        return view('content.treds', [
            'treds' => $topic->load('treds')->treds,
            'topicId' => $topic->readId()
        ]);
    }

    public function newTred()
    {
        $topics = Topic::all();
        return view('content.new_tred', ["topics" => $topics]);
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

    public function addTred(Request $request)
    {
    	$tred = new Tred($request->all());
    	$tred->user()->associate(auth()->user());
    	$tred->topic()->associate($request->get('topic'));
    	$tred->save();
        //треба зробити запам'ятовування айді топіку

    	return redirect()->back();
    }

    public function commun()
    {
        return view('commun');
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
