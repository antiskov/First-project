<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoard;
use App\Topic;
use App\Tred;
use App\Board;

/**
 * Class BoardController
 * @package App\Http\Controllers
 */
class BoardController extends Controller
{
    /**
     * @param Tred $tred
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function board(Tred $tred)
    {

        return view('board', [
            'boards' => $tred->load('boards')->boards,
            'tred' => $tred,
        ]);
    }

    /**
     * @param Tred $tred
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function boardForAdmin(Tred $tred)
    {
        return view('admin.admin_boards', [
            'boards' => $tred->load('boards')->boards,
            'tred' => $tred,
        ]);
    }

    /**
     * @param Tred $tred
     * @param StoreBoard $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addBoard(Tred $tred, StoreBoard $request)
    {
        $board = new Board($request->all());
        $board->user()->associate(auth()->user());
        $board->tred()->associate($tred);
        $board->save();

        return redirect()->route('board', [$tred->id]);

    }

    /**
     * @param Tred $tred
     * @param Board $board
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function boardAnswer(Tred $tred, Board $board)
    {
        return view('quote', [
            'boardId' => $board->id,
            'tredId' => $tred->id
        ]);
    }

    /**
     * @param Tred $tred
     * @param Board $board
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteBoard(Tred $tred, Board $board)
    {
        $board->delete();

        return redirect()->route('board', [$tred->id]);
    }

    /**
     * @param Tred $tred
     * @param Board $board
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDeleteBoard(Tred $tred, Board $board)
    {
        $board->forceDelete();

        return redirect()->route('admin-board', [$tred->id]);
    }

    /**
     * @param $board
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function restoreBoard($board)
    {
        Board::withTrashed()->find($board)->restore();

        return view('admin.admin_softdeleted', [
            'topics' => Topic::onlyTrashed()->get(),
            'treds' => Tred::onlyTrashed()->get(),
            'boards' => Board::onlyTrashed()->get()
        ]);
    }
}
