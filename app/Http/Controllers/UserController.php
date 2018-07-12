<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
	{
		if($this->isLogin !== true){
			   return response()->view('user.login', [
                'siteKey' => config('google.recaptcha_sitekey')
            ]);
        } else {
            return redirect()->route('/home', ['hotelDir' => $hotelDir]);
        }
    }
	
	public function auth(LoginPostRequest $request, UserModel $userModel)
	{
    $params = $request->all();

    if (!isset($params['g-recaptcha-response']) ||
        !$this->checkReCaptcha($params['g-recaptcha-response'], $request->ip())) {
        return redirect()->route('userLogin');
            //->withErrors([trans('controller/user.verifyError')]);
    }

    $user = $userModel->login(
        trim($params['username']),
        trim($params['password']),
        $request->header('User-Agent'),
        $request->ip()
        );

    if ($user) {
        $user->password = trim($params['password']);
        session(['auth_' . $hotelDir => $user]);
    } else {
        if (\Language::get('locale') === 'zh-TW' && session()->has('loginMessage')) {
            return redirect()->route('userLogin', ['hotelDir' => $hotelDir])
                ->withErrors([session()->get('loginMessage')]);
        } else {
             return redirect()->route('userLogin', ['hotelDir' => $hotelDir])
                ->withErrors([trans('controller/user.accountError')]);
         }
    }

    $response = redirect()->route('userCenter', ['hotelDir' => $hotelDir])
        ->with(['message' => trans('controller/user.loginSuccess')]);
    if (isset($params['remember']) && $params['remember'] === 'Y') {
        $response->withCookie(cookie(
            'auth_' . $this->hotelDir,
            ['username' => $params['username'], 'password' => $params['password']],
            10080
        ));
    }

    return $response;
    }
}
