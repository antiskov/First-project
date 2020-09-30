<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoard;
use App\Topic;
use App\Thread;
use App\Board;

/**
 * Class BoardController
 * @package App\Http\Controllers
 */
class BoardController extends Controller
{
    /**
     * @param Thread $tred
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAll(Thread $thread)
    {

        return view('board', [
            'boards' => $thread->load('boards')->boards,
            'thread' => $thread,
        ]);
    }

    /**
     * @param Thread $tred
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllForAdmin(Thread $thread)
    {
        return view('admin.admin_boards', [
            'boards' => $thread->load('boards')->boards,
            'tred' => $thread,
        ]);
    }

    /**
     * @param Thread $tred
     * @param StoreBoard $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function set(Thread $thread, StoreBoard $request)
    {
        $board = new Board($request->all());
        $board->user()->associate(auth()->user());
        $board->thread()->associate($thread);
        $board->save();

        return redirect()->route('board', [$thread->id]);

    }

    /**
     * @param Thread $tred
     * @param Board $board
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Thread $thread, Board $board)
    {
        $board->delete();

        return redirect()->route('board', [$thread->id]);
    }

    /**
     * @param Thread $tred
     * @param Board $board
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete(Thread $thread, Board $board)
    {
        $board->forceDelete();

        return redirect()->route('admin-board', [$thread->id]);
    }

    /**
     * @param $board
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function restore($board)
    {
        Board::withTrashed()->find($board)->restore();

        return view('admin.admin_softdeleted', [
            'topics' => Topic::onlyTrashed()->get(),
            '$threads' => Thread::onlyTrashed()->get(),
            'boards' => Board::onlyTrashed()->get()
        ]);
    }
}
