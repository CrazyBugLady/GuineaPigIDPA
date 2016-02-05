<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Weight extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'weight_guineapig';
	
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_guineapig', 'Weight', 'DateOfWeighing'];


    // Relations
    public function guineapig() {
        return $this->belongsTo('App\GuineaPig', 'ID', 'id_guineapig');
    }
    
	// Methods
    public function getValidator() {
        return Validator::make(
            array(
                'Weight' =>            $this->Weight,
                'DateOfWeighing' =>    $this->DateOfWeighing
            ),
            array(
                'Weight' => 'required|numeric',
                'DateOfWeighing' => 'required|date_format:d.m.Y'
            )
        );
    }
    
}