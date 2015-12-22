<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use View, Input, Redirect, Route, Validator;
use App\User;
use App\Breeding;

class dbBreedingController extends Controller {
	public function index() {
		return View::make('breedings.create');

	}
	
	public static function create(){
		$breeding = self::buildBreeding(new Breeding());
	
		if($breeding->getValidator()->fails()){
			return Redirect::to('breeding-overview/create')->withErrors($breeding->getValidator());
		}
	
		if($breeding->save()){
			return Redirect::to('breeding-overview/create')->with(array('title' => 'Zucht erfolgreich angelegt', 'success' => 'Die Zucht ' . $breeding->name . ' konnte erfolgreich angelegt werden.'));
		}
		
		return Redirect::to('breeding-overview/create')->withErrors(array('title' => 'Fehler', 'errors' => 'Während des Erstellens ist ein Fehler aufgetreten.'));
	}

	public static function buildBreeding($breeding){
		$breeding->Name = Input::get('tbName');
        $breeding->BreedingAbbrDef = Input::get('tbKuerzel');
        $breeding->Description = Input::get('txtDescription');		
		$breeding->user_id = self::getLoggedInUser()->ID;
		
		return $breeding;
	}
}

?>