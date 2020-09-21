<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
    		$filename = $request->image->getClientOriginalName();
    		$request->image->storeAs('images', $filename, 'public');
   			auth()->user()->update(['avatar' => $filename]);
    	}

    	return redirect()->back();
    }
}
