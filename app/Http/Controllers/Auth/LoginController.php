<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function login_social(Request $req) {
        return view('login_social');
    }
    protected function registerOrLoginUser($data){

    }
    //Google Login
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->user();
        $this->_registerorLoginUser($user);
        return redirect()->route('home');
    }

    //Facebook Login
    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback(){

       $user = Socialite::driver('facebook')->user();
       $this->_registerorLoginUser($user);
       return redirect()->route('home');
    }

    //Github Login
    public function redirectToGithub(){
        return Socialite::driver('github')->redirect();
    }
    public function handleGithubCallback(){
        $user = Socialite::driver('github')->user();
        $this->_registerorLoginUser($user);
        return redirect()->route('home');
    }

}
