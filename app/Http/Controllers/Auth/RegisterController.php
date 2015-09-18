<?php
namespace App\Http\Controllers\Auth;

use App\Http\Requests;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use View, Input, Redirect, Route, Validator;
use App\User;

class RegisterController extends Controller
{	
	public function index(){
		return View::make("auth/register");
	}
	
	public function create(){
		$User = Input::all();
	
		if($this->validator($User)->fails()) {
			return Redirect::to('register')->withErrors($this->validator($User));
		}
		
		$this->createUser($User);
		
		return Redirect::to('register')->with(array('title' => 'Account erstellt',
          'success' => "Du konntest deinen Account erfolgreich erstellen."));
		
	}
	
	protected function validator(array $data)
    {
        return Validator::make(array(
				'firstname' => $data["tbFirstname"],
				'lastname' => $data["tbLastname"],
				'birthdate' => $data["tbBirthdate"],
				'email' => $data["tbEmail"],
				'password' => $data["tbPassword"],
				'password_confirmation' => $data["tbPassword_confirmation"]
			), 
			[
				'firstname' => 'required|max:45',
				'lastname' => 'required|max:45',
				'birthdate' => array('required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{2,4}$/'),
				'email' => 'required|email|max:255|unique:users',
				'password' => 'required|confirmed|min:6',
			]);
    }
	
	protected function createUser(array $data){
		return User::create([
            'firstname' => $data['tbFirstname'],
			'lastname' => $data['tbLastname'],
			'birthdate' => $data['tbBirthdate'],
            'email' => $data['tbEmail'],
            'password' => bcrypt($data['tbPassword']),
        ]);
	}
}
