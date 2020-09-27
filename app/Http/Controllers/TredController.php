<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\StoreTred;
use App\Topic;
use App\Tred;

/**
 * Class TredController
 * @package App\Http\Controllers
 */
class TredController extends Controller
{
    /**
     * @param Topic $topic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tredsAction(Topic $topic)
    {
        return view('content.treds', [
            'treds' => $topic->load('treds')->treds,
            'topicId' => $topic->id
        ]);
    }

    /**
     * @param Topic $topic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newTred(Topic $topic)
    {
        return view('content.new_tred', ['topicId' => $topic->id]);
    }

    /**
     * @param Topic $topic
     * @param StoreTred $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addTred(Topic $topic, StoreTred $request)
    {
        $tred = new Tred($request->all());
        $tred->user()->associate(auth()->user());
        $tred->topic()->associate($topic);
        $tred->save();

        return redirect()->route('treds', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @param Tred $tred
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteTred(Topic $topic, Tred $tred)
    {
        $tred->delete();

        return redirect()->route('treds', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @param Tred $tred
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteTredForAdmin(Topic $topic, Tred $tred)
    {
        $tred->delete();

        return redirect()->route('admin-treds', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @param Tred $tred
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDeleteTred(Topic $topic, Tred $tred)
    {
        $tred->forceDelete();

        return redirect()->route('admin-treds', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tredsActionForAdmin(Topic $topic)
    {
        return view('admin.admin_treds', [
            'treds' => $topic->load('treds')->treds,
            'topicId' => $topic->id
        ]);
    }

    /**
     * @param $tred
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function restoreTred($tred)
    {
        Tred::withTrashed()->find($tred)->restore();

        return view('admin.admin_softdeleted', [
            'topics' => Topic::onlyTrashed()->get(),
            'treds' => Tred::onlyTrashed()->get(),
            'boards' => Board::onlyTrashed()->get()
        ]);
    }
}
