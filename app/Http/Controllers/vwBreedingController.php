<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use View, Input, Redirect, Route, Validator;
use App\User;
use App\Breeding;

class vwBreedingController extends Controller {
	public function index() {
		$breedings = self::getLoggedInUser()->breedings()->get();
	
		return View::make('breedings')->with(array("breedings" => $breedings));

	}
	
	public function create(){
		return View::make('breedings.create');
	}
	
	public function delete(){
		return View::make('guineapigs.delete');
	}
	
	public function update(){
		return View::make('guineapigs.update');
	}
	
	public function watchProfile(){
		return View::make('guineapigs.showProfile');
	}
}

?>