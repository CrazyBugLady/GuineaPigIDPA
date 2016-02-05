<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Auth, View, Session;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
	
	public function __construct(){
		
		$user = self::getLoggedInUser();
		$breedings = null;
		
		if($user != null){
			$breedings = $user->breedings()->get();
		}
		
		View::share("user", $user);
		View::share("breedings", $breedings);	
	}
	
	public static function getLoggedInUser(){
		$user = Auth::user();
		
		if(Session::has('user')){
			$user = unserialize(Session::get('user'));
		}
		
		return $user;
	}
	
}
