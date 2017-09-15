<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;
use App\Http\Controllers\Controller;
use Laravel\Passport\Client;


class RegisterController extends Controller
{
	use IssueTokenTrait;

	private $client;

	public function __construct() {
		$this->client = Client::where('name', 'tcwapm Password Grant Client')->first();
	}

    public function register(Request $request) {

    	$this->validate($request, [
    		'name' => 'required',
    		'phone' => 'numeric|nullable',
    		'email' => 'required|email|unique:users,email',
    		'password' => 'required|min:6'
    	]);

    	$user = User::create([
    		'name' => request('name'),
    		'phone' => request('phone'),
    		'email' => request('email'),
    		'password' => bcrypt('password')
    	]);

    	return $this->issueToken($request, 'password');

    }
}
