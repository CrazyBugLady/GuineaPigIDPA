<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Combination extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'combinations';
	
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ID', 'Name', 'CombinationType', 'showDescription', 'Description', 'Code', 'CombinationGroup', 'ImageUrl', 'created_at', 'updated_at'];


    // Relations
    public function getVariations() {
        if($this->CombinationType == "Race")
		{
			return $this->hasMany('App\Race', 'ID', 'ID')->orderBy('RaceCode', 'desc');
		}
		else
		{
			return $this->hasMany('App\Color', 'ID', 'ID')->orderBy('ColorCode', 'desc');
		}
    }
	
}