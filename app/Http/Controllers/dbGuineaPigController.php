<?php namespace App\Http\Controllers;

use App\Http\Controllers\SharedGuineaPigController as ControllerShared;
use Illuminate\Http\Request;
use View, Input, Redirect, Route, Validator;
use App\User;
use App\GuineaPig;
use App\Breeding;
use App\Weight;

class dbGuineaPigController extends ControllerShared {

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
	
	public static function data(){
		$idGuineaPig = Route::Input('id');
		$Guineapig = GuineaPig::find($idGuineaPig);
		
		$Guineapig = self::buildJsonGP($Guineapig);
		
		//array_push($Guineapig, $GP);//$Guineapig->getGP());
	
		return json_encode(array($Guineapig));
	}
	
	private static function buildJsonGP($gp){
		$GP = array();
		$GP["race"] = self::findDescription("Race", $gp->Race);
		$GP["color"] = self::findDescription("Color", $gp->Color);
		$GP["age"] = $gp->getAge();
		
		return $GP;
	}
	
	public static function update(){
	
	}
	
	public static function delete(){
	
	}

	public static function createWeighings(){
		$weighings = array();
		
		$id_guineapig = Route::input('id');
		$date = Input::get('date');
		$weight = Input::get('weight');
		
		foreach($date as $dkey => $weightdate){
			$weighing = self::buildWeighing($weightdate, $weight[$dkey], $id_guineapig);
			array_push($weighings, $weighing);
		}
		
		foreach($weighings as $wkey => $weighing){
			if($weighing->getValidator()->fails()){
				return Redirect::to('/guineapigs-overview/profile/' . $id_guineapig)->withErrors($guineapig->getValidator());
			}
		
			if($weighing->save() == false){
				return Redirect::to('/guineapigs-overview/profile/' . $id_guineapig)->with(array("title" => "Speichern fehlgeschlagen!", 
																				"warning" => "Nicht alle Daten konnten gespeichert werden!", "id" => $id_guineapig));
			}
		}
		
		return Redirect::to('/guineapigs-overview/profile/' . $id_guineapig)->with(array('title' => 'Speichern erfolgreich', 
																		'success' => 'Gewichtsdaten konnten gespeichert werden!'));
	}
	
	public static function buildWeighing($date, $weight, $id_guineapig){
		$weighing = new Weight();
		$weighing->Weight = $weight;
		$weighing->DateOfWeighing = $date;
		$weighing->id_guineapig = $id_guineapig;
		
		return $weighing;
	}
	
	public static function buildGuineaPig($guineapig){
		$guineapig->name = Input::get('tbName');
		$guineapig->id_breeding = Input::get('ddlIdBreeding');
        $guineapig->birthdate = Input::get('tbAlter');
        $guineapig->breedingabbr = Input::get('tbKuerzel');
        $guineapig->race = Input::get('tbRasseformel');
		$guineapig->color = Input::get('tbFarbformel');
        $guineapig->sexe = Input::get('rgeschlecht');
        /*if (Input::hasFile('image')) {
            $event->image_path = self::generateImageFileName();
            $event->image_thumbnail_path = self::generateImageFileName();
        }*/
        
        return $guineapig;
	}
	
}

?>