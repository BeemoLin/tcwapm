<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index() {

    	$posts = Auth::user()->posts()->get();

    	return response()->json(['data' => $posts], 200, [], JSON_NUMERIC_CHECK);
    }
}
