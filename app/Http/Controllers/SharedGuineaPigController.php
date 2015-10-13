<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use View, Input, Redirect, Route, Validator;
use App\User;
use App\GuineaPig;
use App\Breeding;
use DB;

abstract class SharedGuineaPigController extends Controller
{
		protected static function findDescription($type, $code){

			$combinations = DB::table('combinations')					
							->where('CombinationType', $type)
							->where('Description', $code);
	
			if($combinations->first() == null)
			{
				return self::findDescriptionForHeterozygoteCode($type, $code);
			}
		
			return $combinations->first()->Name;
		}
		
		protected static function findDescriptionForHeterozygoteCode($type, $code){
			$combinations = DB::table('combinations')					
							->where('CombinationType', $type)
							->get();			
							
			foreach($combinations as $combination){			
				if(strpos($combination->Description, "?") !== false) { // the code can be compared thus he has the possibility of being similar
					$CodeCompare = explode(" ", trim($combination->Description));
					$CodeToGet = explode(" ", trim($code));
					
					foreach($CodeCompare as $CCKey => $CCPart){
						$PartsCodeToCompare = self::getParts($combination->Description);
						$PartsCodeToGet = self::getParts($code);

						foreach($PartsCodeToCompare as $PartIndex => $Part){
							$PartToGet = $PartsCodeToGet[$PartIndex];
							if(($Part[0] == "?" and $Part[1] == "?") or ($Part[0] == $PartToGet[0] and $Part[1] == $PartToGet[1]) or ($Part[0] == "?" and $Part[1] == $PartToGet[1]) or ($Part[1] == "?" and $Part[0] == $PartToGet[0]))
							{
								if($PartIndex == count($PartsCodeToCompare) - 1) // there was no mistake up until now so this might be the right formula... yay
								{
									return $combination->Name;
								}
								continue; // this might be the right one, since there are some possibilities of adjusting the code
							}
							else
							{
								break; // this can't be the right one
							}
						}
					
						
					}
				}
			}
			
			return $code;
		}
		
	protected static function getParts($Parts){
		$Parts = explode(" ", $Parts);
		
		$Property = array();
		foreach($Parts as $P){
			$PartsNew = array();
			switch(strlen($P)){
				case 2:
					array_push($PartsNew, substr($P, 0, -1));
					array_push($PartsNew, substr($P, -1));
					break;
				case 3:
					if(preg_match("/^[A-Z]$/", substr($P, 0, 1)) == false){
						array_push($PartsNew, substr($P, 0, -1));
						array_push($PartsNew, substr($P, -1));
					}
					else // zweites und drittes Zeichen klein
					{
						if(strpos($P,"?") !== false){ // it contains one
							array_push($PartsNew, substr($P, 0, 2));
							array_push($PartsNew, substr($P, -1));
						}
						else
						{
							array_push($PartsNew, substr($P, 0, 1));
							array_push($PartsNew, substr($P, -2));
						}
						
					}
					break;
				case 4:
						array_push($PartsNew, substr($P, 0, 2));
						array_push($PartsNew, substr($P, -2));
					break;
			}
			array_push($Property, $PartsNew);
		}
		
		return $Property;
	}
			
}
