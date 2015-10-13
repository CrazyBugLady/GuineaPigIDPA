<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Litter extends Model {
    // Relations
	protected $table = 'litter';
	
	 protected $fillable = ['startdate, expectedLitterDate', 'AmountBabies', 'PercentageFemale', 'Title', 'Further_Information', 'IDMotherGP', 'IDFatherGP'];
	
    public function MotherGuineaPig() {
        return DB::table('guinea pigs')
                ->where('sexe', '=', 1)
                ->where('idLitter', $this->ID)
                ->first();
    }
	
	public function FatherGuineaPig() {
        return DB::table('guinea pigs')
                ->where('sexe', '=', 0)
                ->where('idLitter', $this->ID)
                ->first();
    }
	
	public function guineapigs(){
		return $this->hasMany("App\GuineaPig", "ID", "idLitter");
	}
    
    // Methods
   /* public function getValidator() {
        return Validator::make(
            array(
                'name' =>              $this->name,
                'birthdate' =>       $this->description,
                'breedingabbr' =>    $this->breedingabbr,
				'birthdate' => date('d.m.Y', strtotime($this->birthdate)),
				'color' => $this->color,
                'race' =>  $this->race,
				'sexe' => $this->sexe,
				'dateofdeath' => date('d.m.Y', strtotime($this->dateofdeath)),
                'image' => $this->image
            ),
            array(
                'name' =>              'required|between:2,150',
                'description' =>       'required|between:0,500',
                'duration' =>    array('required', 'regex:/^([01]?[0-9]|2[0-3]):([0-5][0-9])$/'),
                'cast' =>              'between:0,500',
                'image_description' => 'between:0,250'
            )
        );
    }*/
    
}