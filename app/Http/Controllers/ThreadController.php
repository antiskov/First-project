<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\StoreThread;
use App\Topic;
use App\Thread;
use Illuminate\Http\RedirectResponse;

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
    public function getAll(Topic $topic)
    {
        return view('thread', [
            'threads' => $topic->load('threads')->threads,
            'topicId' => $topic->id
        ]);
    }

    /**
     * @param Topic $topic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setNew(Topic $topic)
    {
        return view('set_thread', ['topicId' => $topic->id]);
    }

    /**
     * @param Topic $topic
     * @param StoreThread $request
     * @return RedirectResponse
     */
    public function set(Topic $topic, StoreThread $request)
    {
        $thread = new Thread($request->all());
        $thread->user()->associate(auth()->user());
        $thread->topic()->associate($topic);
        $thread->save();

        return redirect()->route('threads', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @param Thread $tred
     * @return RedirectResponse
     * @throws \Exception
     */
    public function delete(Topic $topic, Thread $thread)
    {
        $thread->delete();

        return redirect()->route('threads', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @param Thread $tred
     * @return RedirectResponse
     * @throws \Exception
     */
    public function deleteForAdmin(Topic $topic, Thread $tred)
    {
        $tred->delete();

        return redirect()->route('admin-treds', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @param Thread $tred
     * @return RedirectResponse
     */
    public function forceDelete(Topic $topic, Thread $tred)
    {
        $tred->forceDelete();

        return redirect()->route('admin-treds', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllForAdmin(Topic $topic)
    {
        return view('admin.admin_threads', [
            'threads' => $topic->load('threads')->threads,
            'topicId' => $topic->id
        ]);
    }

    /**
     * @param $thread
     * @return RedirectResponse
     */
    public function restore($thread)
    {
        Thread::withTrashed()->find($thread)->restore();

        return redirect()->route('soft-deleted', [
            'topics' => Topic::onlyTrashed()->get(),
            'threads' => Thread::onlyTrashed()->get(),
            'boards' => Board::onlyTrashed()->get()
        ]);
    }
}