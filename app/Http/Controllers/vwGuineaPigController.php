<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use View, Input, Redirect, Route, Validator;
use App\User;
use App\GuineaPig;
use App\Breeding;
use DB;

class vwGuineaPigController extends Controller {
	public function index() {
		$id = Route::input('id');
		$breeding = Breeding::find($id);
		
		if($breeding != null){
			$weibchen = $breeding->guineapigs(1);

			$maennchen = $breeding->guineapigs(0);
			
			$kastraten = $breeding->guineapigs(2);
			
			if($maennchen != null and $kastraten != null){
				$maennchen->merge($kastraten);
			}
			
		return View::make('guineapigs',
				array(
					'id_breeding' => $id,
					'weibchen' => $weibchen,
					'maennchen' => $maennchen
				)
			);
		}
		
		return View::make('guineapigs',
				array(
					'title' => "Keine Zucht",
					'warning' => 'Bitte Zucht auswählen',
					'weibchen' => array(),
					'maennchen' => array()
				)
			);
	}
	
	public function create(){
		$selected_breeding = Breeding::find(Route::input('id'));
		
		
		$breedings = self::getLoggedInUser()->breedings()->get();
		
		return View::make('guineapigs.create', array('selected_breeding' => $selected_breeding, 'breedings' => $breedings));
	}
	
	public function delete(){
		return View::make('guineapigs.delete');
	}
	
	public function update(){
		return View::make('guineapigs.update');
	}
	
	public function profile(){
		$id = Route::input('id');
		$selectedGP = GuineaPig::find($id);
		// TODO: generate error when not selecting an id and redirect to breedings overview
		return View::make('guineapigs.profile', array('selectedGP' => $selectedGP));
	}
	
	public function racebook(){
		$combinations = DB::table('combinations')					
						->where('CombinationType', "Race")
						->get();
					
		return View::make('guineapigs.race_color', array("book" => "Rassebuch", "booktitletwo" => "Mögliche Rassen", "combinations" => $combinations));
	}
	
	public function colorbook(){
		$combinations = DB::table('combinations')					
						->where('CombinationType', "Color")
						->get();
						
		return View::make('guineapigs.race_color', array("book" => "Farbenbuch", "booktitletwo" => "Mögliche Farben", "combinations" => $combinations));
	}
}

?>