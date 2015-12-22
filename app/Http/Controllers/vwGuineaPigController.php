<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\SharedGuineaPigController as SharedController;
use Illuminate\Http\Request;
use View, Input, Redirect, Route, Validator;
use App\User;
use App\GuineaPig;
use App\Breeding;
use DB;

class vwGuineaPigController extends SharedController {
	public function index() {
		$id = Route::input('id');
		$breeding = Breeding::find($id);
		
		if($breeding != null){
			$weibchen = $breeding->guineapigs(1);

			$maennchen = $breeding->guineapigs(0);
			
			$kastraten = $breeding->guineapigs(2);
			
			$verstorbene = $breeding->guineapigs(3);
			
			/*if($maennchen != null and $kastraten != null){
				$maennchen->merge($kastraten);
			}*/
			
		return View::make('guineapigs',
				array(
					'id_breeding' => $id,
					'weibchen' => $weibchen,
					'maennchen' => $maennchen,
					'kastraten' => $kastraten,
					'verstorbene' => $verstorbene
				)
			);
		}
		else
		{
			return Redirect::to('/breeding-overview')->with(array('title' => 'Keine Zucht ausgewählt',
					'warning' => "Du hast keine gültige Zucht ausgewählt."));				
		}
	}
	
	public function create(){
		$short_hair = DB::table('combinations')					
						->where('CombinationGroup', "Kurzhaar")
						->get();
						
		$long_hair = DB::table('combinations')					
						->where('CombinationGroup', "Langhaar")
						->get();
						
		$agouti = DB::table('combinations')					
						->where('CombinationGroup', "Agouti")
						->get();
						
		$solidagouti = DB::table('combinations')					
						->where('CombinationGroup', "Solidagouti")
						->get();
		
		$multicolored = DB::table('combinations')					
						->where('CombinationGroup', "Zeichnungen")
						->get();
						
		$unicolor = DB::table('combinations')					
						->where('CombinationGroup', "einfarbig")
						->get();
		
		$selected_breeding = Breeding::find(Route::input('id'));
		$weibchen = array();
		$maennchen = array();
		
		if($selected_breeding != null){
			$weibchen = $selected_breeding->guineapigs(1);

			$maennchen = $selected_breeding->guineapigs(0);
		}
		
		$breedings = self::getLoggedInUser()->breedings()->get();
		
		return View::make('guineapigs.create', array('unicolor' => $unicolor, 'multicolored' => $multicolored, 'solidagouti' => $solidagouti, 'agouti' => $agouti, 'short_hair' => $short_hair, 'long_hair' => $long_hair, 'female' => $weibchen, 'male' => $maennchen, 'selected_breeding' => $selected_breeding, 'breedings' => $breedings));
	}
	
	public function delete(){
		return View::make('guineapigs.delete');
	}
	
	public function edit(){
		$selectedgp = Guineapig::find(Route::input("id"));
		
		$short_hair = DB::table('combinations')					
						->where('CombinationGroup', "Kurzhaar")
						->get();
						
		$long_hair = DB::table('combinations')					
						->where('CombinationGroup', "Langhaar")
						->get();
						
		$agouti = DB::table('combinations')					
						->where('CombinationGroup', "Agouti")
						->get();
						
		$solidagouti = DB::table('combinations')					
						->where('CombinationGroup', "Solidagouti")
						->get();
		
		$multicolored = DB::table('combinations')					
						->where('CombinationGroup', "Zeichnungen")
						->get();
						
		$unicolor = DB::table('combinations')					
						->where('CombinationGroup', "einfarbig")
						->get();
		
		return View::make('guineapigs.edit',array("selectedgp" => $selectedgp, 'unicolor' => $unicolor, 'multicolored' => $multicolored, 'solidagouti' => $solidagouti, 'agouti' => $agouti, 'short_hair' => $short_hair, 'long_hair' => $long_hair));
	}
	
	public function profile(){
		$id = Route::input('id');
		$selectedGP = GuineaPig::find($id);
		
		if($selectedGP == null)
		{		
			return Redirect::to('/breeding-overview')->with(array('title' => 'Kein Meerschweinchen ausgewählt',
					'warning' => "Du hast kein gültiges Meerschweinchen ausgewählt."));				
		}
		
		$race = self::findDescription("Race", $selectedGP->Race);
		$color = self::findDescription("Color", $selectedGP->Color);
		
		return View::make('guineapigs.profile', array('race' => $race, 'color' => $color, 'familytree' => $selectedGP->familyTree(), 'selectedGP' => $selectedGP));
	}
	
	public function racebook(){
		$combinations = DB::table('combinations')					
						->where('CombinationType', "Race")
						->where('showDescription', 1)
						->get();
					
		return View::make('guineapigs.race_color', array("book" => "Rassenbuch", "combinations" => $combinations));
	}
	
	public function colorbook(){
		$combinations = DB::table('combinations')					
						->where('CombinationType', "Color")
						->where('showDescription', 1)
						->get();
						
		return View::make('guineapigs.race_color', array("book" => "Farbenbuch", "combinations" => $combinations));
	}
}

?>