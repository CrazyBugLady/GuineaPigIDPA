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
					->select('litter.*', 'guinea pigs.Name');
		return $litters->get();
	}
	
	public function guineapigs($sexe = -1) {
	
		if($sexe > -1)
		{
			$breedingGP = DB::table('guinea pigs')					
                    ->where('id_breeding', $this->ID)
					->where('sexe', '=', $sexe)
                    ->get();
		}
		else
		{
			$breedingGP = DB::table('guinea pigs')					
                    ->where('id_breeding', $this->ID)
                    ->get();
		}
		
		return $breedingGP;
					
    }

    
	protected $table = 'breedings';
	
	protected $fillable = ['name', 'description', 'breedingabbrdef', 'user_id'];
	
    // Methods
    public function getValidator() {
        return Validator::make(
            array(
                'name' =>              $this->name,
                'description' =>       $this->description,
                'breedingabbrdef' =>    $this->breedingabbrdef,
            ),
            array(
                'name' =>              'required|between:2,45',
                'description' =>       'required',
                'breedingabbrdef' =>   'required|between:2,10'
            )
        );
    }
    
}