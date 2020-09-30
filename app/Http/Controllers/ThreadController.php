<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\StoreThread;
use App\Topic;
use App\Thread;

/**
 * Class ThreadController
 * @package App\Http\Controllers
 */
class ThreadController extends Controller
{
    /**
     * @param Topic $topic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tredsAction(Topic $topic)
    {
        return view('content.treds', [
            'threads' => $topic->load('threads')->threads,
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
     * @param StoreThread $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addTred(Topic $topic, StoreThread $request)
    {
        $thread = new Thread($request->all());
        $thread->user()->associate(auth()->user());
        $thread->topic()->associate($topic);
        $thread->save();

        return redirect()->route('treds', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @param Thread $tred
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteTred(Topic $topic, Thread $tred)
    {
        $tred->delete();

        return redirect()->route('treds', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @param Thread $tred
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteTredForAdmin(Topic $topic, Thread $tred)
    {
        $tred->delete();

        return redirect()->route('admin-treds', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @param Thread $tred
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDeleteTred(Topic $topic, Thread $tred)
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
        Thread::withTrashed()->find($tred)->restore();

        return view('admin.admin_softdeleted', [
            'topics' => Topic::onlyTrashed()->get(),
            'treds' => Thread::onlyTrashed()->get(),
            'boards' => Board::onlyTrashed()->get()
        ]);
    }
}
