<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use View, Input, Redirect, Route, Validator;
use App\User;
use App\GuineaPig;
use App\Breeding;

class dbGuineaPigController extends Controller {

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
		$GP = array();
		array_push($GP, $Guineapig->getGP());
	
		return json_encode($GP);
	}
	
	public static function update(){
	
	}
	
	public static function delete(){
	
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