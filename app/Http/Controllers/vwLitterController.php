<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use View, Input, Redirect, Route, Validator;
use App\User;
use App\GuineaPig;
use App\Breeding;

class vwLitterController extends Controller {
	public function index() {
		return View::make('litters.litter');
	}
	
	public function create(){
		$breeding = Breeding::find(Route::input('id'));
	
		if($breeding != null){
			$weibchen = $breeding->guineapigs(1);
			$maennchen = $breeding->guineapigs(0);
		
		return View::make('litters.create',
				array(
					'weibchen' => $weibchen,
					'maennchen' => $maennchen
				)
			);
		}
		
		return Redirect::intended('/breeding-overview')->with(array('title' => 'Keine Zucht ausgewählt', 
														'warning' => 'Es muss eine Zucht ausgewählt werden!'));
	}
	
	// TODO: Format => 50% Color
	// TODO: Format => 50% Race
	
	
	public function getCombinationParts($Parts_W, $Parts_M){
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
				if(preg_match('/[a-z]{2}[A-Z]{1}[a-z]{1}/', $Combination) and strlen($Combination) = 4){ // wir wollen keine Wiederholungen berücksichtigen, da diese das Ergebnis verunschönen
					$PartProperty[$CombinationKey] = substr($Combination, -2) . substr($Combination, 0, 2);
				}
				if(preg_match('/[a-z]{2}[A-Z]{1}/', $Combination)){ // wir wollen keine Wiederholungen berücksichtigen, da diese das Ergebnis verunschönen
					$PartProperty[$CombinationKey] = substr($Combination, -1) . substr($Combination, 0, 2);
				}
			}
			array_push($Combinations, $PartProperty);//array_count_values($PartProperty));

		}
		
		return $Combinations;
	}
	
	public function tryOutAllPossibilities($CombinationParts, $maxCombinations, $partsperCombination){
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
			$Combination["combination"] = trim($Combination["combination"]);
			
			//$Combination["combination"] = $CombinationParts[0][$part_A] . " " . $CombinationParts[1][$part_B] . " " . $CombinationParts[2][$part_C] . " " . $CombinationParts[3][$part_E] . " " . $CombinationParts[4][$part_P] . " " . $CombinationParts[5][$part_S] . " " . $CombinationParts[6][$part_Rn];
			$Combination["possibility"] = 100 / $maxCombinations . " %";
			
			if(!in_array($Combination, $generatedCombinations))
			{
				array_push($generatedCombinations, $Combination);
			}
		}
		
		return $generatedCombinations;
	}
	
	public function generatePossibleLitter(Request $request){
		$maennchen = GuineaPig::find(Input::get("idM"));
		$weibchen = GuineaPig::find(Input::get("idW"));
		$information = Input::get("information");

		if($information == "color")
		{
			$Colorparts_W = $weibchen->getColorParts();
			$Colorparts_M = $maennchen->getColorParts();
			$CombinationsColorParts = $this->getCombinationParts($Colorparts_W, $Colorparts_M);
			$CombinationsColorCount = 1;
		
			$CombinationsColor = array();
		
			foreach($CombinationsColorParts as $value)
			{
				$CombinationsColorCount = $CombinationsColorCount * count(array_count_values($value));
			}
			
			return json_encode($this->tryOutAllPossibilities($CombinationsColorParts, $CombinationsColorCount, 7));
		}
		else
		{
			$Raceparts_W = $weibchen->getRaceParts();
			$Raceparts_M = $maennchen->getRaceParts();
			$CombinationsRaceParts = $this->getCombinationParts($Raceparts_W, $Raceparts_M);
		
			$CombinationsRaceCount = 1;
		
			$CombinationsRace = array();
		
			foreach($CombinationsRaceParts as $value)
			{
				$CombinationsRaceCount = $CombinationsRaceCount * count(array_count_values($value));
			}
			
			return json_encode($this->tryOutAllPossibilities($CombinationsRaceParts, $CombinationsRaceCount, 9));
		}
		/*$Litter = array();
		$litter_count = rand(1,4); // soll die Anzahl der Möglichkeiten wiederspiegeln
			
		for($guineapigindex = 0; $guineapigindex < $litter_count; $guineapigindex++)
		{
			$Parts = array();
			$PartsTwo = array();

			for($x = 0; $x < 7; $x++){
				$pair = rand(0, (count($CombinationsColor[$x])-1)); // wie viele Kombinationen sind möglich?
				
				$Parts[$x] = $CombinationsColor[$x][$pair];
			}
			for($x = 0; $x < count($CombinationsRace); $x++){
				$pair = rand(0, (count($CombinationsRace[$x])-1)); // wie viele Kombinationen sind möglich?
				$PartsTwo[$x] = $CombinationsRace[$x][$pair];
			}
			
			$GuineaPig["color"] = $Parts[0] . " " . $Parts[1] . " " . $Parts[2] . " " . $Parts[3] . " " . $Parts[4] . " " . $Parts[5] . " " . $Parts[6];
			//$GuineaPig["race"] = $PartsTwo[0] . " " . $PartsTwo[1] . " " . $PartsTwo[2] . " " . $PartsTwo[3] . " " . $PartsTwo[4] . " " . $PartsTwo[5] . " " . $PartsTwo[6] . " " . $PartsTwo[7]. " " . $PartsTwo[8];
			
			array_push($Litter, $GuineaPig);
		}*/
				
		//return json_encode($Litter);
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