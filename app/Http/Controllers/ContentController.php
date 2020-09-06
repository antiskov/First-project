<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Topic;
use User;

class ContentController extends Controller
{
    public function addTopic(Request $request) {
    	$rules = ['topic_text' => 'required|string|min:3|max:400'];
    }
}
