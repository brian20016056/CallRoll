<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	protected $isLogin;
	
	protected $username;
	
	protected $password;
	
	
	public function __construct()
	{
		if (session()->has('auth' . $this->username)){
			$this->$isLogin = true;
			View::share('isLogin', true);
			View::share('loginUser', session(key:'auth_' . $this->username);
		} else {
			$this->isLogin = false;
			View::share('isLogin', false);
		}
}
