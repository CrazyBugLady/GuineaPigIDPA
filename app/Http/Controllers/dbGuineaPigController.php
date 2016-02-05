<?php namespace App\Http\Controllers;

use App\Http\Controllers\SharedGuineaPigController as ControllerShared;
use Illuminate\Http\Request;
use View, Input, Redirect, Route, Validator;
use App\User;
use App\GuineaPig;
use App\Breeding;
use App\Weight;
use App\Litter;
use DB;
use DateTime;
use File;

class dbGuineaPigController extends ControllerShared {

	public static function create(){
		$guineapig = self::buildGuineaPig(new GuineaPig());
		$selected_breeding = Breeding::find(Route::input('id'));
		if($guineapig->getValidator()->fails()){
			return Redirect::to('/guineapigs-overview/' . $selected_breeding->ID)->withErrors($guineapig->getValidator());
		}
		
		if($guineapig->save()){
			return Redirect::to('/guineapigs-overview/' . $selected_breeding->ID)->with(array('title' => 'Meerschweinchen erfolgreich erstellt', 
																	'success' => 'Meerschweinchen konnte erstellt werden!'));
		}

	}
	
	public static function edit(){
		$selectedgp = Guineapig::find(Route::input("id"));
		$Color = Input::get("tbFarbformel");
		$Race = Input::get("tbRasseformel");
		
		$selectedgp->Color = $Color;
		$selectedgp->Race = $Race;
		
		if($selectedgp->getValidator()->fails()){
			return Redirect::to('/breeding-overview')->withErrors($selectedgp->getValidator());						
		}
		else{
			$update = DB::table('guinea pigs')->where('ID', $selectedgp->ID)->update(['Race' => $selectedgp->Race, 'Color' => $selectedgp->Color]);	 

			return Redirect::to('/guineapigs-overview/profile/'.$selectedgp->ID)->with(array('title' => 'Meerschweinchen erfolgreich editiert',
					'success' => "Meerschweinchen konnte editiert werden."));			
		}
	}
	
	public static function ImageUpload(){
		$guineapig = GuineaPig::find(Route::input("id"));
				
		  // Validate files
        if (Input::hasFile('imgGuineaPig')) {
            $imageExtension = Input::file('imgGuineaPig')->getMimeType();
            $isImageExtensionValid = $imageExtension == 'image/jpg' ||
                                     $imageExtension == 'image/jpeg' ||
                                     $imageExtension == 'image/png';
            if (!$isImageExtensionValid) {
                return Redirect::to('/guineapigs-overview/profile/' . Input::get("id"))->with(array('title' => 'Falsches Bildformat',
                  'error' => "Nur .jpg und .png Dateien sind erlaubt."));
            }
			else
			{
				$image = Input::file('imgGuineaPig');
				$imageending = $imageExtension == 'image/png' ? '.png' : '.jpg';
				$imageName = $guineapig->Name . $imageending;
							
				$image->move("public/images/guineapig_images", $imageName);
				
				$update = DB::table('guinea pigs')->where('ID', $guineapig->ID)->update(['Image' => $imageName]);	
				
				return Redirect::to('/guineapigs-overview/profile/' . Route::input("id"))->with(array('title' => 'Bild erfolgreich hochladen',
				'success' => "Du konntest erfolgreich ein Bild für " . $guineapig->Name . " hochladen."));
				
			}
        }
		else{
			return Redirect::to('/guineapigs-overview/profile/' . Route::input("id"))->with(array('title' => 'Kein Bild ausgewählt',
					'warning' => "Bitte ein Bild auswählen, das hochgeladen werden soll!"));				
		}
        		
	}
	
	public static function castrate(){
		$guineapig = GuineaPig::find(Route::input("id"));

		$CastrationDate = new DateTime();

		$update = DB::table('guinea pigs')->where('ID', $guineapig->ID)->update(['Sexe' => 2, 'DateOfCastration' => $CastrationDate->format("d.m.Y")]);	
		
		if($update){
			return Redirect::to('/guineapigs-overview/profile/' . Route::input("id"))->with(array('title' => 'Kastration erfolgreich eingetragen',
				'success' => "Kastration von " . $guineapig->Name . " erfolgreich eingetragen."));		
		}
		else
		{
			return Redirect::to('/guineapigs-overview/profile/' . Route::input("id"))->with(array('title' => 'Kastration nicht erfolgreich eingetragen',
				'warning' => "Kastration von " . $guineapig->Name . " konnte nicht eingetragen werden."));			
		}
		
	}
	
	public static function Death(){
		$guineapig = GuineaPig::find(Route::input("id"));

		$DateOfDeath = new DateTime();

		$update = DB::table('guinea pigs')->where('ID', $guineapig->ID)->update(['DateOfDeath' => $DateOfDeath->format("d.m.Y")]);	
		
		if($update){
			return Redirect::to('/guineapigs-overview/profile/' . Route::input("id"))->with(array('title' => 'Sterbedatum erfolgreich eingetragen',
				'success' => "Todesdatum von " . $guineapig->Name . " erfolgreich eingetragen."));		
		}
		else{
			return Redirect::to('/guineapigs-overview/profile/' . Route::input("id"))->with(array('title' => 'Sterbedatum nicht erfolgreich eingetragen',
				'warning' => "Todesdatum von " . $guineapig->Name . " konnte nicht eingetragen werden."));
		}
	}
	
	public static function createFromLitter(){
		$male = Input::get('tbMale');
		$female = Input::get('tbFemale');
		$dead = Input::get('tbDead');
		$litterdate = Input::get('tbLitterdate');
		$id = Route::input('id');
		$litter = Litter::find($id);
		$mother = $litter->MotherGuineaPig()->first();
		$breeding = $mother->breeding()->first();
		$names = Input::get('name');
		$sex = Input::get('sex');
		$color = Input::get('color');
		$race = Input::get('race');
		
		$successfullySaved = true;
		
		
		foreach($names as $gpkey => $name){
			$guineapig = new GuineaPig();
				
			$guineapig->Name = $name;
			$guineapig->id_breeding = $breeding->ID;
			$guineapig->BreedingAbbr = $breeding->BreedingAbbrDef;
			$guineapig->BirthDate = Input::get('tbLitterdate');
			$guineapig->idLitter = $litter->ID;
			$guineapig->Race = self::findCodeForName($race[$gpkey]);
			$guineapig->Color = self::findCodeForName($color[$gpkey]);
			$guineapig->Sexe = $sex[$gpkey] == 'männlich' ? 0 : 1;
			
			if($guineapig->getValidator()->fails()){
				return Redirect::to('/litter-overview')->withErrors($guineapig->getValidator());
			}
			else
			{
				if($guineapig->save() == false){
					$successfullySaved = false; 
					break;
				}
			}
		}
		
		$update = DB::table('litter')->where('ID', $id)->update(['LitterStatus' => 'normal', 'Litterresult' => $male . "." . $female . "." . $dead, 'realLitterdate' => $litterdate]);		
		
		
		if($successfullySaved){
			return Redirect::to('/litter-overview/')->with(array('title' => 'Wurf erfolgreich erstellt', 
																	'success' => 'Meerschweinchen aus dem Wurf konnten erfolgreich erstellt werden!'));		
		}
		else
		{
			return Redirect::to('/litter-overview/')->with(array('title' => 'Wurf konnte nicht erstellt werden', 
																	'warning' => 'Meerschweinchen aus Wurf konnten nicht erstellt werden!'));					
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
				return Redirect::to('/guineapigs-overview/profile/' . $id_guineapig)->withErrors($weighing->getValidator());
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
		$dateFormatted = new DateTime($date);
		$weighing->DateOfWeighing = $dateFormatted->format('d.m.Y');
		$weighing->id_guineapig = $id_guineapig;
		
		return $weighing;
	}
	
	public static function buildGuineaPig($guineapig){
		$guineapig->Name = Input::get('tbName');
		$guineapig->id_breeding = Route::input('id');
        $guineapig->BirthDate = Input::get('tbAlter');
        $guineapig->breedingabbr = Input::get('tbKuerzel');
        $guineapig->Race = Input::get('tbRasseformel');
		$guineapig->Color = Input::get('tbFarbformel');
        $guineapig->Sexe = Input::get('rgeschlecht');

        
        return $guineapig;
	}
	
}

?>