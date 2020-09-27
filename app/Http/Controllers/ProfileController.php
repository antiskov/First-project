<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('profile');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileImage(Request $request)
    {
    	if($request->hasFile('image'))
    	{
    	    if(auth()->user()->avatar !== 'default-user-icon-4.jpg')
            {
                Storage::delete('/public/images/' . auth()->user()->avatar);
            }
    	    $filename = $request->file('image')->getClientOriginalName();
    		$request->file('image')->storeAs('images', $filename, 'public');
   			auth()->user()->update(['avatar' => $filename]);
    	}

    	return redirect()->back();
    }
}
