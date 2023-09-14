<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    function login_social(Request $req) {
        return view('login_social');
    }
    protected function registerOrLoginUser($data){
        $user = User::where('email',$data->email)->first();
        if(!$user){
           $user = new User();
           $user->name = $data->name;
           $user->email = $data->email;
           $user->provider_id = $data->id;
           $user->avatar = $data->avatar;
           $user->save();
        }
        Auth::login($user);
    }
    //Google Login
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->user();
        $this->_registerorLoginUser($user);
        return redirect()->route('dashboard');
    }

    //Facebook Login
    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback(){

       $user = Socialite::driver('facebook')->user();
       $this->_registerorLoginUser($user);
       return redirect()->route('dashboard');
    }

    //Github Login
    public function redirectToGithub(){
        return Socialite::driver('github')->redirect();
    }
    public function handleGithubCallback(){
        $user = Socialite::driver('github')->user();
        $this->_registerorLoginUser($user);
        return redirect()->route('dashboard');
    }

}
