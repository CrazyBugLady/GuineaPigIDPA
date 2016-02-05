<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use App\Weight;
use DateTime;
use DB;

class GuineaPig extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'guinea pigs';
	
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image', 'name', 'birthdate', 'dateofdeath', 'CastrationDate', 'sexe', 'race', 'color', 'breedingabbr', 'idLitter', 'id_breeding'];


    // Relations
    public function breeding() {
        return $this->belongsTo('App\Breeding', 'id_breeding', 'ID');
    }
	
	public function parentLitter() {
        return $this->belongsTo('App\Litter', 'idLitter', 'ID')->first();
    }
	
	public function familyTree(){
		$familyTree = array();
		$familyTree["mother"] = "unbekannt";
		$familyTree["mother_id"] = 0;
		$familyTree["father"] = "unbekannt";
		$familyTree["father_id"] = 0;
		$familyTree["grandmother_m"] = "unbekannt";
		$familyTree["grandmother_m_id"] = 0;
		$familyTree["grandfather_m"] ="unbekannt";
		$familyTree["grandfather_m_id"] = 0;
		$familyTree["grandmother_f"] = "unbekannt";
		$familyTree["grandmother_f_id"] = 0;
		$familyTree["grandfather_f"] = "unbekannt";
		$familyTree["grandfather_f_id"] = 0;	
			
		$litter = $this->parentLitter();	
		
		if($litter != null){
			$mother = GuineaPig::find($litter->IDMotherGP);
			$father = GuineaPig::find($litter->IDFatherGP);

			$familyTree["mother"] = $mother->Name;
			$familyTree["mother_id"] = $mother->ID;
			$familyTree["father"] = $father->Name;
			$familyTree["father_id"] = $father->ID;
			
			$motherlitter = $mother->parentLitter();
			if($motherlitter != null){
				$grandmother_m = GuineaPig::find($motherlitter->IDMotherGP);
				$grandfather_m = GuineaPig::find($motherlitter->IDFatherGP);
				$familyTree["grandmother_m"] = $grandmother_m->Name;
				$familyTree["grandmother_m_id"] = $grandmother_m->ID;
				$familyTree["grandfather_m"] = $grandfather_m->Name; 
				$familyTree["grandfather_m_id"] = $grandfather_m->ID;
			}
			
			$fatterlitter = $father->parentLitter();
			if($fatterlitter != null){
				$grandmother_f = GuineaPig::find($fatterlitter->IDMotherGP);
				$grandfather_f = GuineaPig::find($fatterlitter->IDFatherGP);
				$familyTree["grandmother_f"] = $grandmother_f->Name;
				$familyTree["grandmother_f_id"] = $grandmother_f->ID;
				$familyTree["grandfather_f"] = $grandfather_f->Name; 
				$familyTree["grandfather_f_id"] = $grandfather_f->ID;
			}
		}	
		return $familyTree;
			
	}
	
	public function containsGenPair($genpair){
		return strpos($this->color, $genpair) || strpos($this->race, $genpair);
	}
	
	public function weighings(){
		return $this->hasMany('App\Weight', 'id_guineapig', 'ID')->orderBy('DateOfWeighing', 'desc');
	}
	
	public function currentWeight(){
		if($this->weighings()->first() == null){
			return "-";
		}
		else
		{
			return $this->weighings()->first()->Weight;
		}
	}
	
	public function getFormattedBirthdate(){
		$date = new DateTime($this->BirthDate);
		echo $date->format('d.m.Y');
	}
	
	public function getAge(){
		$birthdate = new DateTime($this->BirthDate); //Geburtsdatum
		$currentdate = new DateTime(date('Y')+'-'+date('m')+'-'+date('d')); //Aktuelles Datum
 
		$age = $currentdate->diff($birthdate);
		
		return $age->format("%y.%m");
	}
 
		
	public function childLitters(){
		if($this->Sexe == 1){
			return $this->hasMany('App\Litter', 'IDMotherGP', 'ID')->orderBy('ID', 'desc');
		}
		else
		{
			return $this->hasMany('App\Litter', 'IDFatherGP', 'ID')->orderBy('ID', 'desc');
		}
	}
		
	public function currentLitter(){
		$currentLitter = $this->childLitters()->where('LitterStatus', '=', 'unbekannt')->first();
		return $currentLitter;
	}
	
	public function isInCalf(){
		return ($this->currentLitter() != null and $this->Sexe == 1);
	}
 
	// Methods
    public function getValidator() {
        return Validator::make(
            array(
                'Name' =>            $this->Name,
                'breedingabbr' =>    $this->breedingabbr,
				'birthdate' => date('d.m.Y', strtotime($this->BirthDate)),
				'Color' => $this->Color,
                'race' =>  $this->Race,
				'Sexe' => $this->Sexe,
				'dateofdeath' => date('d.m.Y', strtotime($this->DateOfDeath)),
                'image' => $this->image
            ),
            array(
                'Name' =>         'required|between:2,150',
				'breedingabbr' => 'between:2,50',
				'dateofdeath' => array('required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{2,4}$/'),
                'birthdate' => array('required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{2,4}$/'),
				'Color' => 'required|between: 0,255',
				'race' => 'required|between: 0,255',
                'Sexe' =>    'required|numeric',
                'image' => 'between:0,500'
            )
        );
    }
    
}