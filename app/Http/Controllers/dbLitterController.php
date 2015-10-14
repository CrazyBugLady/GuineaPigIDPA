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