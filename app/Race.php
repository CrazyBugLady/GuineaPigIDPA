<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Race extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'race';
	
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ID', 'RaceCode', 'created_at', 'updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
}