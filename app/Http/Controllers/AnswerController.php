<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Board;
use App\Http\Requests\StoreContent;
use App\Tred;

class AnswerController extends Controller
{
    public function answer(Tred $tred, Board $board)
    {
        return view('answer ', [
            'boardId' => $board->id,
            'tredId' => $tred->id
        ]);
    }

    public function addAnswer(Tred $tred, Board $board, StoreContent $request)
    {
        $answer = new Answer($request->all());
        $answer->user()->associate(auth()->user());
        $answer->board()->associate($board);
        $answer->save();

        return redirect()->route('board', [$tred->id]);
    }
}
