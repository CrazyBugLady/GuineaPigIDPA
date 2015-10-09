<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use App\Weight;
use DateTime;

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
    protected $fillable = ['image', 'name', 'birthdate', 'dateofdeath', 'sexe', 'race', 'color', 'breedingabbr', 'id_breeding'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    // Relations
    public function breeding() {
        return $this->belongsTo('App\Breeding', 'ID', 'id_breeding');
    }
	
	public function parentLitter() {
        return $this->belongsTo('App\Litter', 'ID', 'IdLitter');
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
	
	public function getAge(){
		$birthdate = new DateTime($this->BirthDate); //Geburtsdatum
		$currentdate = new DateTime(date('Y')+'-'+date('m')+'-'+date('d')); //Aktuelles Datum
 
		$age = $currentdate->diff($birthdate);
		
		return $age->format("%Y");
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
		$currentLitter = $this->childLitters()->where('expectedLitterDate', '>=', date('Y-m-d', time()))->first();
				
		return $currentLitter;
	}
	
	public function isInCalf(){
		return ($this->currentLitter() != null and $this->Sexe == 1);
	}
	
	public function getRaceParts(){
		
	}
	
	public function getColorParts(){
		$Colorparts = explode(" ", $this->Color);
		
		$Color = array();
		foreach($Colorparts as $CP){
			$Parts = array();
			switch(strlen($CP)){
				case 2:
					array_push($Parts, substr($CP, 0, -1));
					array_push($Parts, substr($CP, -1));
					break;
				case 3:
					if(preg_match("/^[A-Z]$/", substr($CP, 0, 1)) == false){
						array_push($Parts, substr($CP, 0, -1));
						array_push($Parts, substr($CP, -1));
					}
					else // zweites und drittes Zeichen klein
					{
						array_push($Parts, substr($CP, 0, 1));
						array_push($Parts, substr($CP, -2));
					}
					break;
				case 4:
						array_push($Parts, substr($CP, 0, 2));
						array_push($Parts, substr($CP, -2));
					break;
			}
			array_push($Color, $Parts);
		}
		
		return $Color;
	}
	
	public function getGP(){
		$GP = array();
		$GP["race"] = $this->Race;
		$GP["color"] = $this->Color;
		$GP["age"] = $this->getAge();
		
		return $GP;
	}
 
	// Methods
    public function getValidator() {
        return Validator::make(
            array(
                'name' =>            $this->name,
                'breedingabbr' =>    $this->breedingabbr,
				'birthdate' => date('d.m.Y', strtotime($this->BirthDate)),
				'color' => $this->Color,
                'race' =>  $this->Race,
				'sexe' => $this->sexe,
				'dateofdeath' => date('d.m.Y', strtotime($this->DateOfDeath)),
                'image' => $this->image
            ),
            array(
                'name' =>              'required|between:2,150',
				'breedingabbr' => 'between:2,50',
				'dateofdeath' => array('required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{2,4}$/'),
                'birthdate' => array('required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{2,4}$/'),
				'color' => 'required|between: 0,255',
				'race' => 'required|between: 0,255',
                'sexe' =>    'required|numeric',
                'image' => 'between:0,500'
            )
        );
    }
    
}