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
    public function commun(Tred $tred)
    {
        return view('commun', [
            'communs' => $tred->load('communs')->communs,
            'tred' => $tred,
        ]);
    }

    public function addCommun(Tred $tred, Request $request)
    {
        $commun = new Commun($request->all());
        $commun->user()->associate(auth()->user());
        $commun->treds()->associate($tred);
        $commun->save();

        return redirect()->route('commun', [$tred->id]);

    }

    public function addCommunQuote(Tred $tred, Commun $commun, Request $request)
    {
        $this_commun = new Commun($request->all());
        $this_commun->commun_quote =$commun->commun_item;
        $this_commun->user()->associate(auth()->user());
        $this_commun->treds()->associate($tred);
        $this_commun->save();

        return redirect()->route('commun', [$tred->id]);
    }

    public function communQuote(Tred $tred, Commun $commun)
    {

        return view('quote', [
            'communId' => $commun->id,
            'tredId' => $tred->id
        ]);
    }
}
