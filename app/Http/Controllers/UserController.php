<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserData

class UserController extends Controller
{
    public function login($username)
	{   
		if($this->isLogin !== true){
			   return response()->view('user.login');
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
	
    $user = App\UserData::where('UserAccount', $params['username']);      

    if ($user) {
        if ($user->UserPassword = trim($params['password']))
		{
        session(['auth_' . $user['UserAccount'] => $user['UserAccount']]);
		return redirect()->route(route 'userLogin');
		View::share('username', $user->UserAccount);
		}
    } else {
		 return redirect()->route(route 'userLogin')
		 ->withErrors(['查無此帳號']);;
    }
    /* 記住我 功能
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
    public function register($username, RegisterPostRequest $request)
    {
        if ($this->isLogin !== true) {
            $params = $request->all();
			App\UserData::insert(  
                ['UserAccount' => trim($params['UserAccount'])],
                ['UserPassword' => trim($params['UserPassword'])],
                ['UserName' => trim($params['UserAccount'])],
            );

            if ($user) {
                return redirect()->route('userLogin', ['hotelDir' => $hotelDir])->with([
                    'message' => trans('controller/user.signUpSuccess'),
                    'register' => true
                ]);
            } else {
                if (\Language::get('locale') === 'zh-TW' && session()->has('registerMessage')) {
                    return redirect()->back()->withErrors([session('registerMessage')])->withInput();
                } else {
                    return redirect()->back()->withErrors([trans('controller/user.signUpFail')])->withInput();
                }
            }
        } else {
            return redirect()->route('index', ['hotelDir' => $hotelDir]);
        }
    }
}
