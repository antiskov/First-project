<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Board;
use App\Http\Requests\StoreAnswer;
use App\Tred;

/**
 * Class AnswerController
 * @package App\Http\Controllers
 */
class AnswerController extends Controller
{
    /**
     * @param Tred $tred
     * @param Board $board
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function answer(Tred $tred, Board $board)
    {
        return view('answer ', [
            'boardId' => $board->id,
            'tredId' => $tred->id
        ]);
    }

    /**
     * @param Tred $tred
     * @param Board $board
     * @param StoreAnswer $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addAnswer(Tred $tred, Board $board, StoreAnswer $request)
    {
        $answer = new Answer($request->all());
        $answer->user()->associate(auth()->user());
        $answer->board()->associate($board);
        $answer->save();

        return redirect()->route('board', [$tred->id]);
    }
}
