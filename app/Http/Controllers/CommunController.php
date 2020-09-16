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

class CommunController extends Controller
{
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
