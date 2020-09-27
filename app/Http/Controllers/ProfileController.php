<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile');
    }

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
