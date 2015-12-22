<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'birthdate', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
	
	
	public function breedings() {
        return $this->hasMany('App\Breeding', 'user_id', 'ID');
    }
	
	public function getValidator() {
        return Validator::make(
            array(
                'email' =>            $this->Email,
                'birthdate' =>    $this->birthdate,
				'firstname' => $this->firstname,
				'lastname' => $this->lastname
            ),
            array(
                'email' => 'required',
                'birthdate' => 'required|date_format:d.m.Y',
                'firstname' => 'required',
				'lastname' => 'required'
            )
        );
    }
	
	 /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }
	
	/**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
	
	    /**
     * Automatically Hash the password when setting it
     * @param string $password The password
     */
    public function setPassword($password)
    {
        $this->password = Hash::make($password);
    }
	
}
