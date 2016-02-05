<?php namespace App\Http\Controllers;

use App\Http\Controllers\SharedGuineaPigController as ControllerShared;
use Illuminate\Http\Request;
use View, Input, Redirect, Route, Validator;
use App\User;
use App\GuineaPig;
use App\Breeding;
use App\Weight;
use App\Litter;
use DateTime;
use DB;

class dbLitterController extends ControllerShared {

	public static function icc(){
		$mother = GuineaPig::find(Input::get("idW"));
		$father = GuineaPig::find(Input::get("idM"));
		
		$familytreeMother = $mother->familyTree();
		$familytreeFather = $father->familyTree();
		
		$icclist = array();		
		
		// wir wollen den Inzuchtkoeffizient nur für die beiden Elterntiere berechnen... Da alles andere momentan zu zeitaufwändig wäre
		
		$icclist["Vatertier"] = "0%";
		
		// Kommt Vatertier auch in Mutterstammbaum vor ? Ist es der Vater der Mutter oder der Grossvater väterlicherseits, respektive mütterlicherseits?
		if($familytreeMother["father_id"] == $father->ID){
			$icclist["Vatertier"] = pow(0.5, 1 + 2 - 1)* 100 . "%";
		}
		else if($familytreeMother["grandfather_f_id"] == $father->ID or $familytreeMother["grandfather_m_id"] == $father->ID){
			$icclist["Vatertier"] = pow(0.5, 1 + 3 - 1)* 100 . "%";		
		}
		
		// Kommt Muttertier auch im Vaterstammbaum vor? Ist es die Mutter des Vater, die Grossmutter väterlicherseits respektive mütterlicherseits?
		
		$icclist["Muttertier"] = "0%";
		
		if($familytreeFather["mother_id"] == $mother->ID){
			$icclist["Muttertier"] = pow(0.5, 1 + 2 - 1) * 100 . "%";
		}
		else if($familytreeFather["grandmother_f_id"] == $mother->ID or $familytreeFather["grandmother_m_id"] == $mother->ID){
			$icclist["Muttertier"] = pow(0.5, 1 + 3 - 1)* 100 . "%";		
		}
		
		return json_encode($icclist);
	}

	public static function create(){
		$litter = self::buildLitter(new Litter());
		$gp = "";
		
		if(Input::get('ddlWeibchen') != null and Input::get('ddlWeibchen') != 0 and Input::get('ddlWeibchen') != ""){
			$gp = GuineaPig::find(Input::get('ddlWeibchen'));
		}
		else if(Input::get('ddlMaennchen') != null and Input::get('ddlMaennchen') != 0 and Input::get('ddlMaennchen') != "")
		{
			$gp = GuineaPig::find(Input::get('ddlMaennchen'));
		}
		else
		{
			$gp = null;
		}
		
		if($litter->getValidator()->fails()){
			if($gp != null)
			{
				return Redirect::to('/litter-overview/create/' . $gp->id_breeding)->withErrors($litter->getValidator());
			}
			else
			{
				return Redirect::to('/guineapigs-overview/')->withErrors($litter->getValidator());
			}
		}
		
		if($litter->save()){
			return Redirect::to('/guineapigs-overview/' . $gp->id_breeding)->with(array('title' => 'Wurf erfolgreich erstellt', 
																	'success' => 'Wurf konnte erstellt werden!'));
		}

	}
	
	public static function update(){
		$newStatus = Input::get('newStatus');
		$idlitter = Input::get('id');
		$dt = new DateTime();

		$update = DB::table('litter')->where('ID', $idlitter)->update(['LitterStatus' => $newStatus, 'realLitterdate' => $dt->format('d.m.Y')]);		
			
		if($update){
			return Redirect::to('/litter-overview/')->with(array('title' => 'Wurf wurde erfolgreich gesetzt!', 
																	'success' => 'Wurf wurde erfolgreich gesetzt!'));			
		}
		else{
			return Redirect::to('/litter-overview/')->withErrors("Ein technischer Fehler ist aufgetreten!");		
		}
		
	}
	
	public static function delete(){
	
	}
	
	public static function buildLitter($litter){
		$litter->expectedLitterDate = Input::get('tbExpectedLitterdate');
		$litter->startdate = Input::get('tbStartdate');
		$litter->earliestLitterdate = Input::get('tbEarliestLitterdate');
		$litter->Title = Input::get('tbTitle');
		$litter->IDMotherGP = Input::get('ddlWeibchen');
		$litter->IDFatherGP = Input::get('ddlMaennchen');
		
		return $litter;
	}
	
}

?>