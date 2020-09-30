<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Board;
use App\Http\Requests\StoreAnswer;
use App\Thread;

/**
 * Class AnswerController
 * @package App\Http\Controllers
 */
class AnswerController extends Controller
{
    /**
     * @param Thread $tred
     * @param Board $board
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get(Thread $thread, Board $board)
    {
        return view('answer ', [
            'boardId' => $board->id,
            'threadId' => $thread->id
        ]);
    }

    /**
     * @param Thread $tred
     * @param Board $board
     * @param StoreAnswer $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function set(Thread $thread, Board $board, StoreAnswer $request)
    {
        $answer = new Answer($request->all());
        $answer->user()->associate(auth()->user());
        $answer->board()->associate($board);
        $answer->save();

        return redirect()->route('board', [$thread->id]);
    }

    public function getOnAnswer(Thread $thread, Board $board, Answer $answer)
    {
        return view('answer_on_answer ', [
            'boardId' => $board->id,
            'threadId' => $thread->id,
            'answerId' => $answer->id
        ]);
    }

    public function setOnAnswer(Thread $thread, Board $board, Answer $answer, StoreAnswer $request)
    {
        $answerOnAnswer = new Answer($request->all());
        $answerOnAnswer->answer_on_answer = $answer->answer_item;
        $answerOnAnswer->user()->associate(auth()->user());
        $answerOnAnswer->board()->associate($board);
        $answerOnAnswer->save();

        return redirect()->route('board', [$thread->id]);
    }
}
