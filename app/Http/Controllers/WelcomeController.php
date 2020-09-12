<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Tred;

class WelcomeController extends Controller
{
    //
    public function welcome()
    {
    	return view('welcome');
    }

    public function tredsAction(Topic $topic)
    {   

        #$treds = $treds->only($id);
        // $treds = Tred::where('content_id', $id)->get();
        #$treds = Tred::where('content_id', $id);
        #$treds = Tred::with('contents')->get();
        #$treds = \DB::table('treds')->where('content_id', $id)->get();
        #$treds = Tred::find(4);
        /*$treds = Tred::orderBy(Topic::select('id')
            ->whereColumn('contents.id', 'treds.content_id')
        );

        /*$treds = \DB::table('treds')
        ->whereln('content_id', $id)
        ->get();*/

        #$treds = $treds->intersect(Tred::whereln('content_id', $id))->get();

    	return view('content.treds', ['treds' => $topic->load('treds')->treds]);
    }

    public function newTred()
    {
        $topics = Topic::all();

    	return view('content.new_tred', ["topics"=>$topics]);
    }
}
