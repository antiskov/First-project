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

class QuoteController extends Controller
{
    public function quote(Topic $topic, Tred $tred, Commun $commun)
    {
        return view('quote', [
            'topicId' => $topic->id,
            'tredId' => $tred->id,
            'communId' => $commun->id
        ]);
    }

    public function addQuote(Topic $topic, Tred $tred, Commun $commun, Request $request)
    {	
        $quote = new Quote($request->all());
        $quote->user()->associate(auth()->user());
        $quote->topic()->associate($topic);
        $quote->tred()->associate($tred);
        $quote->commun()->associate($commun);
        //dd(2);
        $quote->save();
        //dd(1);

        return redirect()->back();
    }
}
