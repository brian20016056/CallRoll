<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserData

class UserController extends Controller
{
    public function login()
	{   
        if (session()->has('auth_' . $this->username)) {
            $this->isLogin = true;
             View::share('isLogin', true);
             View::share('loginUser', session('auth_' . $this->username));
        } else {
            $this->isLogin = false;
                View::share('isLogin', false);
            }
		if($this->isLogin !== true){
			   return response()->view('user.login', [
                'siteKey' => config('google.recaptcha_sitekey')
            ])
        } else {
            return redirect()->route('/home');
        }
    }
	
	public function logout($username)
    {
        session()->forget('auth_' . $username);
        cookie()->queue(cookie()->forget('auth_' . $username));

        return redirect()->route('userLogin')
            ->with(['message' => '成功登出!']);
    }
	
	public function auth(LoginPostRequest $request)
	{
    $params = $request->all();

	/* google 我不是機器人功能
    if (!isset($params['g-recaptcha-response']) ||
        !$this->checkReCaptcha($params['g-recaptcha-response'], $request->ip())) {
        return redirect()->route('userLogin');
            ->withErrors([trans('controller/user.verifyError')]);
    }
    */
	
    $user = App\UserData::where('UserAccount', $params['username'])->get();      

    if ($user) {
        if ($user->password = trim($params['password']))
		{
        session(['auth_' . $user['username'] => $user['username']]);
		}
    } else {
		/*
        if (\Language::get('locale') === 'zh-TW' && session()->has('loginMessage')) {
            return redirect()->route('userLogin', ['hotelDir' => $hotelDir]);
                ->withErrors([session()->get('loginMessage')]);
        } else {
             return redirect()->route('userLogin', ['hotelDir' => $hotelDir]);
                ->withErrors([trans('controller/user.accountError')]);
         }
		 */
		 return redirect()->route(route 'userLogin')
		 ->withErrors(['帳號或密碼錯誤']);;
    }
    /*
    protected $response = redirect()->route('/home')
        ->with(['message' => trans('controller/user.loginSuccess')]);
    if (isset($params['remember']) && $params['remember'] === 'Y') {
        $response->withCookie(cookie(
            'auth_' . $this->userAccount,
            ['username' => $params['username'], 'password' => $params['password']],
            10080
        ));
    }

    return $response;
	*/
    }
	
	    public function signup()
    {
        if ($this->isLogin !== true) {
            $customerSet = CustomerSet::create();
            return response()->view('user.signup', [
                'customerSet' => $customerSet
            ])->withCookie(cookie($this->hotelDir . '-hotelId', $this->hotelId, 1440));
        } else {
            return redirect()->route('index', ['hotelDir' => $hotelDir]);
        }
    }
}
