<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Litter extends Model {
    // Relations
	protected $table = 'litter';
	
	 protected $fillable = ['startdate, expectedLitterDate', 'earliestLitterdate', 'realLitterdate', 'Title', 'IDMotherGP', 'IDFatherGP'];
	
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
    public function getValidator() {
        return Validator::make(
            array(
                'startdate' =>              date('d.m.Y', strtotime($this->startdate)),
                'expectedLitterDate' =>      date('d.m.Y', strtotime($this->expectedLitterDate)),
                'earliestLitterdate' =>    date('d.m.Y', strtotime($this->earliestLitterdate)),
				'realLitterdate' => date('d.m.Y', strtotime($this->realLitterdate)),
				'Title' => $this->Title,
                'IDMotherGP' =>  $this->IDMotherGP,
				'IDFatherGP' => $this->IDFatherGP
            ),
            array(
                'startdate' =>                array('required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{2,4}$/'),
                'expectedLitterDate' =>       array('required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{2,4}$/'),
                'earliestLitterdate' =>       array('required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{2,4}$/'),
                'realLitterdate' =>           array('regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{2,4}$/'),
                'Title' => 				     'between:2,40',
				'IDMotherGP' =>              'required|numeric',
				'IDFatherGP' =>              'required|numeric'
            )
        );
    }
    
}