<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

use App\GuineaPig;
use DB;

class Breeding extends Model {
    // Relations
    public function User() {
        return $this->belongsTo('App\User');
    }
	
	public function mostCurrentLitters(){
		$litters = DB::table('litter')			
					->join('guinea pigs', 'guinea pigs.ID', '=', 'litter.IDMotherGP')
                    ->where('id_breeding', $this->ID)
					->where('LitterStatus', 'unbekannt')
					->select('litter.*', 'guinea pigs.Name');
		return $litters->get();
	}
	
	public function guineapigs($sexe = -1) {
	
		if($sexe > -1 and $sexe < 3)
		{
			$breedingGP = DB::table('guinea pigs')					
                    ->where('id_breeding', $this->ID)
					 ->whereNull('DateOfDeath')
					->where('sexe', '=', $sexe);
		}
		else if($sexe == -1)
		{
			$breedingGP = DB::table('guinea pigs')					
                    ->where('id_breeding', $this->ID);
		}
		else
		{
			$breedingGP = DB::table('guinea pigs')		
					 ->whereNotNull('DateOfDeath')
                    ->where('id_breeding', $this->ID);			
		}
		
		return $breedingGP->get();
					
    }

    
	protected $table = 'breedings';
	
	protected $fillable = ['Name', 'Description', 'BreedingAbbrDef', 'user_id'];
	
    // Methods
    public function getValidator() {
        return Validator::make(
            array(
                'Name' =>              $this->Name,
                'Description' =>       $this->Description,
                'BreedingAbbrDef' =>    $this->BreedingAbbrDef,
            ),
            array(
                'Name' =>              'required|between:2,45',
                'Description' =>       'required',
                'BreedingAbbrDef' =>   'required|between:2,10'
            )
        );
    }
    
}