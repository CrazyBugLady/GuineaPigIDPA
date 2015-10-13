<?php namespace App\Http\Controllers;

use App\Http\Controllers\SharedGuineaPigController as ControllerShared;
use Illuminate\Http\Request;
use View, Input, Redirect, Route, Validator;
use App\User;
use App\GuineaPig;
use App\Breeding;
use App\Weight;
use App\Litter;

class dbLitterController extends ControllerShared {

	public static function create(){
		$guineapig = self::buildGuineaPig(new GuineaPig());
		$selected_breeding = Breeding::find(Route::input('id'));
		
		if($guineapig->getValidator()->fails()){
			return Redirect::to('/guineapigs-overview')->withErrors($guineapig->getValidator())->with(array("id" => $selected_breeding->ID));
		}
		
		if($guineapig->save()){
			return Redirect::to('/guineapigs-overview')->with(array('title' => 'Meerschweinchen erfolgreich erstellt', 
																	'success' => 'Meerschweinchen konnte erstellt werden!'));
		}

	}
	
	public static function update(){
	
	}
	
	public static function delete(){
	
	}
	
	public static function buildWeighing($date, $weight, $id_guineapig){
		$weighing = new Weight();
		$weighing->Weight = $weight;
		$weighing->DateOfWeighing = $date;
		$weighing->id_guineapig = $id_guineapig;
		
		return $weighing;
	}
	
}

?>