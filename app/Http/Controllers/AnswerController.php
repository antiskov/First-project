<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Board;
use App\Http\Requests\StoreAnswer;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Thread;

/**
 * Class AnswerController
 * @package App\Http\Controllers
 */
class AnswerController extends Controller
{

    /**
     * @param Thread $thread
     * @param Board $board
     * @return ApplicationAlias|Factory|View
     */
    public function get(Thread $thread, Board $board)
    {
        return view('answer ', [
            'boardId' => $board->id,
            'threadId' => $thread->id
        ]);
    }
    /**
     * @param Thread $thread
     * @param Board $board
     * @param StoreAnswer $request
     * @return RedirectResponse
     */
    public function set(Thread $thread, Board $board, StoreAnswer $request)
    {
        $answer = new Answer($request->all());
        $answer->user()->associate(auth()->user());
        $answer->board()->associate($board);
        $answer->save();

        return redirect()->route('board', [$thread->id]);
    }

    /**
     * @param Thread $thread
     * @param Board $board
     * @param Answer $answer
     * @return ApplicationAlias|Factory|View
     */
    public function getOnAnswer(Thread $thread, Board $board, Answer $answer)
    {
        return view('answer_on_answer ', [
            'boardId' => $board->id,
            'threadId' => $thread->id,
            'answerId' => $answer->id
        ]);
    }

    /**
     * @param Thread $thread
     * @param Board $board
     * @param Answer $answer
     * @param StoreAnswer $request
     * @return RedirectResponse
     */
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
