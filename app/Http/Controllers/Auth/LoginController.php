<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Classes\ActivationService;
use App\UserActivation;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $activationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService)
    {
        $this->middleware('guest')->except('logout');
        $this->activationService = $activationService;
    }
    public function username(){
        return 'username';
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }

    public function authenticated(Request $request, $user){
        if (!$user->active) {
            $this->activationService->sendActivationMail($user);
            auth()->logout();
            return back()->with('status', 'Check your email to verify your account');
        }
        return redirect()->intended($this->redirectPath());
    }
}
