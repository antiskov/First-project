<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreContent;
use App\Topic;
use App\Tred;
use App\Commun;
use App\Quote;
use User;

class CommunController extends Controller
{
    public function commun(Topic $topic, Tred $tred)
    {      

        $commun = new Commun();
        $quote = Quote::find(1);

        return view('commun', [
            'communs' => $tred->load('commun')->commun,
            'quotes'=> $commun->load('quote')->quote,
            //'quote' => $quote,
            'topicId' => $topic->id,
            'tredId' => $tred->id
        ]);
    }

    public function addCommun(Topic $topic, Tred $tred, Request $request)
    {
        $commun = new Commun($request->all());
        $commun->user()->associate(auth()->user());
        $commun->topic()->associate($topic);        
        $commun->tred()->associate($tred);        
        $commun->save();

        return redirect()->back();

    }
}
