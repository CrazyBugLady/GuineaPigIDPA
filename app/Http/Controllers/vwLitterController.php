<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\SharedGuineaPigController as ControllerShared;
use Illuminate\Http\Request;
use View, Input, Redirect, Route, Validator;
use App\User;
use App\GuineaPig;
use App\Breeding;
use DB;

class vwLitterController extends ControllerShared {
	public static function index() {
		return View::make('litters.litter');
	}
	
	public static function create(){	
		$breeding = Breeding::find(Route::input('id'));
		//$User = $this->getLoggedInUser();

		if($breeding != null) {//and $breeding->user_id == $User->ID){
			$weibchen = $breeding->guineapigs(1);
			$maennchen = $breeding->guineapigs(0);
			
			return View::make('litters.create',
				array(
					'weibchen' => $weibchen,
					'maennchen' => $maennchen
				)
			);
		}
		/*else
		{
			if($breeding->user_id == $User->ID){
				return Redirect::intended('/breeding-overview')->with(array('title' => 'Keine Berechtigung', 
														'warning' => 'Diese Zucht gehört dir nicht!'));
			}
		}*/
		return Redirect::intended('/breeding-overview')->with(array('title' => 'Keine Zucht ausgewählt', 
														'warning' => 'Es muss eine Zucht ausgewählt werden!'));
	}
	
	// TODO: Format => 50% Color
	// TODO: Format => 50% Race

	public static function generatePossibleLitter(Request $request){
		$maennchen = GuineaPig::find(Input::get("idM"));
		$weibchen = GuineaPig::find(Input::get("idW"));
		$information = Input::get("information");

		if($information == "color")
		{
			$Colorparts_W = self::getParts($weibchen->Color);
			$Colorparts_M = self::getParts($maennchen->Color);
			$CombinationsColorParts = self::getCombinationParts($Colorparts_W, $Colorparts_M);
			$CombinationsColorCount = 1;
		
			$CombinationsColor = array();
		
			foreach($CombinationsColorParts as $value)
			{
				$CombinationsColorCount = $CombinationsColorCount * count(array_count_values($value));
			}
			
			return json_encode(self::tryOutAllPossibilities($CombinationsColorParts, $CombinationsColorCount, 7, "Color"));
		}
		else
		{
			$Raceparts_W = self::getParts($weibchen->Race);
			$Raceparts_M = self::getParts($maennchen->Race);
			$CombinationsRaceParts = self::getCombinationParts($Raceparts_W, $Raceparts_M);
		
			$CombinationsRaceCount = 1;
		
			$CombinationsRace = array();
		
			foreach($CombinationsRaceParts as $value)
			{
				$CombinationsRaceCount = $CombinationsRaceCount * count(array_count_values($value));
			}
			
			return json_encode(self::tryOutAllPossibilities($CombinationsRaceParts, $CombinationsRaceCount, 9, "Race"));
		}
	}
	
	private static function getCombinationParts($Parts_W, $Parts_M){
		$Combinations = array();
		
		for($partindex = 0; $partindex < count($Parts_W); $partindex++){ // combine Colorparts together
			$PartProperty = array();
			$CombinationOne = $Parts_W[$partindex][0] . $Parts_M[$partindex][0];
			
			$CombinationTwo = $Parts_W[$partindex][1] . $Parts_M[$partindex][1];
			
			$CombinationThree = $Parts_W[$partindex][0] . $Parts_M[$partindex][1];
			
			$CombinationFour = $Parts_W[$partindex][1] . $Parts_M[$partindex][0];
			
			array_push($PartProperty, $CombinationOne);
			array_push($PartProperty, $CombinationTwo);
			array_push($PartProperty, $CombinationThree);
			array_push($PartProperty, $CombinationFour);
			
			foreach($PartProperty as $CombinationKey => $Combination){
				if((preg_match('/[A-Z][a-z]/', $Combination) or preg_match('/[a-z][A-Z]/', $Combination)) and strlen($Combination) < 3){
					$PartProperty[$CombinationKey] = strtoupper($Combination);
				}				
				if(preg_match('/[a-z]{2}[A-Z]{1}[a-z]{1}/', $Combination) and strlen($Combination) == 4 and ctype_upper(substr($Combination, 0, 1)) == false){ // wir wollen keine Wiederholungen berücksichtigen, da diese das Ergebnis verunschönen
					if($Combination == "rnRn")
					{
						$PartProperty[$CombinationKey] = substr($Combination, -2) . substr($Combination, 0, 2);
					}
					else
					{
						$PartProperty[$CombinationKey] = substr($Combination, -2) . substr($Combination, -2); //substr($Combination, 0, 2);
					}
				}
				
				if(strlen($Combination) == 4 and ctype_upper(substr($Combination, 0, 1)) == true){
					$PartProperty[$CombinationKey] = substr($Combination, 0, 2) . substr($Combination, 0, 2);
				}
				
				if(preg_match('/[a-z]{2}[A-Z]{1}/', $Combination) and strlen($Combination) == 3){ // wir wollen keine Wiederholungen berücksichtigen, da diese das Ergebnis verunschönen
					$PartProperty[$CombinationKey] = substr($Combination, -1) . substr($Combination, -1);//. substr($Combination, 0, 2);
				}
				if(preg_match('/[A-Z]{1}[a-z]{2}/', $Combination) and strlen($Combination) == 3){ // wir wollen keine Wiederholungen berücksichtigen, da diese das Ergebnis verunschönen
					$PartProperty[$CombinationKey] = substr($Combination, 0, 1) . substr($Combination, 0, 1);//. substr($Combination, 0, 2);
				}
			}
			array_push($Combinations, $PartProperty);//array_count_values($PartProperty));

		}
		
		return $Combinations;
	}

	private static function tryOutAllPossibilities($CombinationParts, $maxCombinations, $partsperCombination, $type = "Race"){
		$generatedCombinations = array();
		
		while(count($generatedCombinations) < $maxCombinations){
			$Parts = array();
			$Combination["combination"] = "";
			$Combination["possibility"] = "";
			for($i = 0; $i < $partsperCombination; $i++)
			{
				$r_part = rand(0,3); 
				$Combination["combination"] .= $CombinationParts[$i][$r_part] . " ";
			}
			
			$combinationName = self::findDescription($type, trim($Combination["combination"]));
			
			$Combination["combination"] = $combinationName;
			
			//$Combination["combination"] = $CombinationParts[0][$part_A] . " " . $CombinationParts[1][$part_B] . " " . $CombinationParts[2][$part_C] . " " . $CombinationParts[3][$part_E] . " " . $CombinationParts[4][$part_P] . " " . $CombinationParts[5][$part_S] . " " . $CombinationParts[6][$part_Rn];
			$Combination["possibility"] = 100 / $maxCombinations . " %";
			
			if(!in_array($Combination, $generatedCombinations))
			{
				array_push($generatedCombinations, $Combination);
			}
			
		}
		
		return $generatedCombinations;
	}

	
}
?>

