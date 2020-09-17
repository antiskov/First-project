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
    public function commun(Topic $topic, Tred $tred)
    {      

        $commun = new Commun();

        return view('commun', [
            'communs' => $tred->load('commun')->commun,
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

    public function addCommunQuote(Topic $topic, Tred $tred, Commun $commun, Request $request)
    {
        $this_commun = new Commun($request->all());
        $this_commun->commun_quote =$commun->commun_item;
        $this_commun->user()->associate(auth()->user());
        $this_commun->topic()->associate($topic);        
        $this_commun->tred()->associate($tred); 
        $this_commun->save();

        return redirect()->back();
    }

    public function communQuote(Topic $topic, Tred $tred, Commun $commun)
    {

        return view('quote', [
            'communId' => $commun->id,
            'topicId' => $topic->id,
            'tredId' => $tred->id
        ]);
    }
}
