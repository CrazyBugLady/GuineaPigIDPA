<?php
namespace App\Http\Controllers\Auth;

use App\Http\Requests;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Auth, View, Input, Redirect, Route, Validator, Session;
use App\User;

class LoginController extends Controller
{	
	public function index(){
		return View::make("auth/login");
	}
	
	public function logIn(){
		$email = Input::get('tbEmail');
		$password = Input::get('tbPassword');
		$remember = Input::get('cbRemember');
		
		if(Auth::attempt(array('email' => $email, 'password' => $password), $remember)){

			$user = Auth::user();
			
			if(Auth::login($user)){
				return Redirect::intended('/auth/login')->withErrors(array("Nicht erfolgreich"));
			}
			
			Session::put('user', serialize($user));
			Session::save();
			
			return Redirect::intended('/welcome')->with(array('title' => 'Login erfolgreich', 'success' => 'Du konntest erfolgreich eingeloggt werden.'));
		}
		
		return Redirect::intended('/auth/login')->with(array('title' => 'Falsche Daten', 'warning' => "Die Mailadresse oder das Passwort sind nicht korrekt."));
	}
	
	public function logout(){
		Session::forget('user');

		return Redirect::intended('/welcome')->with(array('title' => 'Logout erfolgreich', 'success' => 'Du konntest erfolgreich ausgeloggt werden.'));
	}

}
