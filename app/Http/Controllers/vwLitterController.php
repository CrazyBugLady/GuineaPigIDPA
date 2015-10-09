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
	
	public function generatePossibleLitter(Request $request){
		$maennchen = GuineaPig::find(Input::get("idM"));
		$weibchen = GuineaPig::find(Input::get("idW"));

		$CombinationsLitter_color = array();
		
		$Colorparts_W = $weibchen->getColorParts();
		$ColorParts_M = $maennchen->getColorParts();

		for($cpartindex = 0; $cpartindex < count($Colorparts_W); $cpartindex++){ // combine Colorparts together
			$CPartLitter = array();
			
			array_push($CPartLitter, $Colorparts_W[$cpartindex][0] . $ColorParts_M[$cpartindex][0]);
			array_push($CPartLitter, $Colorparts_W[$cpartindex][1] . $ColorParts_M[$cpartindex][1]);
			array_push($CPartLitter, $Colorparts_W[$cpartindex][0] . $ColorParts_M[$cpartindex][1]);
			array_push($CPartLitter, $Colorparts_W[$cpartindex][1] . $ColorParts_M[$cpartindex][0]);
			
			array_push($CombinationsLitter_color, $CPartLitter);
		}
		
		$Litter = array();
		$litter_count = rand(1,4);
				
		/*$count_f = 0; // wie viele Weibchen
		$count_m = 0; // wie viele Männchen*/
		
		for($guineapigindex = 0; $guineapigindex < $litter_count; $guineapigindex++)
		{
			$Parts = array();
				/*$sexe = rand(1,2); // fifty-fifty chance
				
				if($sexe == 1)
				{
					$count_f++;
				}
				else
				{
					$count_m++;
				}*/
				
			for($x = 0; $x < 7; $x++){
				$pair = rand(0, (count($CombinationsLitter_color[$x])-1)); // wie viele Kombinationen sind möglich?
				
				$Parts[$x] = $CombinationsLitter_color[$x][$pair];
			
			}
			$GuineaPig["color"] = $Parts[0] . " " . $Parts[1] . " " . $Parts[2] . " " . $Parts[3] . " " . $Parts[4] . " " . $Parts[5] . " " . $Parts[6];
			$GuineaPig["race"] = "Test";
			
			array_push($Litter, $GuineaPig);
		}
		return json_encode($Litter);
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