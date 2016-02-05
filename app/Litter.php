<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use App\GuineaPig;

class Litter extends Model {
    // Relations
	protected $table = 'litter';
	
	protected $fillable = ['startdate, expectedLitterDate', 'earliestLitterdate', 'realLitterdate', 'Title', 'IDMotherGP', 'IDFatherGP', 'Litterresult', 'LitterStatus'];
	
    public function MotherGuineaPig() {
		return $this->belongsTo('App\GuineaPig', 'IDMotherGP', 'ID');
    }
	
	public function MotherName(){
		return $this->MotherGuineaPig()->first()->Name;
	}
	
	public function FatherGuineaPig() {
        return $this->belongsTo('App\GuineaPig', 'IDFatherGP', 'ID');
    }
	
	public function FatherName(){
		return $this->FatherGuineaPig()->Name;
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
				'IDFatherGP' => $this->IDFatherGP,
				'Litterresult' => $this->LitterResult
            ),
            array(
                'startdate' =>                array('required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{2,4}$/'),
                'expectedLitterDate' =>       array('required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{2,4}$/'),
                'earliestLitterdate' =>       array('required', 'regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{2,4}$/'),
                'realLitterdate' =>           array('regex:/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{2,4}$/'),
                'Title' => 				     'required|between:2,40',
				'IDMotherGP' =>              'required|numeric',
				'IDFatherGP' =>              'required|numeric',
				'Litterresult' => 			 'between:5,11'
            )
        );
    }
    
}