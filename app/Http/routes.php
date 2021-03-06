<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::filter('auth', function()
{
	if (Session::has('user') == false)
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('/auth/login')->with(array("error" => "Keine Befugnis, den Bereich des aufgerufenen Links einzusehen. Bitte zuerst einloggen."));
		}
	}
});

Route::pattern('id', '[0-9]+');
Route::pattern('wId', '[0-9]+');
Route::pattern('mId', '[0-9]+');

Route::get('', 
	[
		"uses" => 'WelcomeController@index',
		"as" => ''
	]);

Route::get('/application', 
	[
		"uses" => 'WelcomeController@application',
		"as" => "application"
	]);	
	
Route::get('/team', 
	[
		"uses" => 'WelcomeController@team',
		"as" => "team"
	]);	
	
Route::get('register', 
	[
		"uses" => 'Auth\RegisterController@index',
		"as" => "register"
	]);

Route::post('/register', 'Auth\RegisterController@create');

Route::get('/auth/login', 
	[
		"uses" => 'Auth\LoginController@index',
		"as" => "auth/login"
	]);	



Route::post('/auth/login', 'Auth\LoginController@logIn');

Route::group(array('before' => 'auth'), function() {
    Route::get(
	
	'/breeding-overview', 
		[
			"uses" => 'vwBreedingController@index',
			"as" => 'breeding-overview'
		]
	);
	
	Route::get('/auth/logout', 
	[
		"uses" => 'Auth\LoginController@logout',
		"as" => "auth/logout"
	]);	
	
	
    Route::get('/breeding-overview/create',     
		[
			"uses" => 'vwBreedingController@create',
			"as" => 'create-breeding'
		]
	);
    
    Route::post('/breeding-overview/create', 'dbBreedingController@create');
});

Route::group(array('before' => 'auth'), function() {
	Route::get(
		'/guineapigs-overview/racebook',
		[
			"uses" => 'vwGuineaPigController@racebook',
			"as" => 'guineapig-racebook'
		]
	);
	
	Route::get(
		'/guineapigs-overview/colorbook',
		[
			"uses" => 'vwGuineaPigController@colorbook',
			"as" => 'guineapig-colorbook'
		]
	);

    Route::get(
	
	'/guineapigs-overview', 
		[
			"uses" => 'vwGuineaPigController@index',
			"as" => 'guineapigs-overview'
		]
	);
	
	Route::get('/guineapigs-overview/{id}', 'vwGuineaPigController@index');
	
	
	 Route::get(
	
	'/guineapigs-overview/create/', 
		[
			"uses" => 'vwGuineaPigController@create',
			"as" => 'create-guineapig'
		]
	);
    Route::get('/guineapigs-overview/create/{id}', 'vwGuineaPigController@create');
	
	
	Route::get(
	'/guineapigs-overview/profile/', 
		[
			"uses" => 'vwGuineaPigController@profile',
			"as" => 'profile-guineapig'
		]
	);
	Route::get('/guineapigs-overview/profile/{id}', 'vwGuineaPigController@profile');
	
	Route::get('/guineapigs-overview/dataGP', 
	[
		"uses" => 'dbGuineaPigController@data',
		"as" => "guineapig-data"
	]);	
	
	Route::get('/guineapigs-overview/dataGP/{id}', "dbGuineaPigController@data");
	Route::post('/guineapigs-overview/dataGP/', "dbGuineaPigController@data");

	Route::get('/guineapigs-overview/profile/dateofDeath',
		[
			"uses" => 'dbGuineaPigController@Death',
			"as" => "deathdate-guineapig"
		]);
		
	Route::get('/guineapigs-overview/profile/dateofDeath/{id}', 'dbGuineaPigController@Death');
	
	Route::get(
	'/guineapigs-overview/profile/castrate', 
		[
			"uses" => 'dbGuineaPigController@castrate',
			"as" => 'sexe-change'
		]
	);
	
	Route::get('/guineapigs-overview/profile/castrate/{id}', 'dbGuineaPigController@castrate');
	
	Route::get(
	'/guineapigs-overview/profile/imageupload', 
		[
			"uses" => 'dbGuineaPigController@ImageUpload',
			"as" => 'guineapig-image'
		]
	);
	Route::post('/guineapigs-overview/profile/imageupload/{id}', 'dbGuineaPigController@ImageUpload');
	
	Route::any(
	'/guineapigs-overview/profile/weighings', 
		[
			"uses" => 'vwGuineaPigController@createWeighings',
			"as" => 'create-weighing'
		]
	);
	Route::any('/guineapigs-overview/profile/weighings/{id}', 'dbGuineaPigController@createWeighings');
	
	Route::get('/guineapigs-overview/edit', 
	[
		"uses" => 'vwGuineaPigController@edit',
		"as" => "guineapig-edit"
	]);	
    Route::get('/guineapigs-overview/edit/{id}',   'vwGuineaPigController@edit');
	Route::post('/guineapigs-overview/edit/{id}',   'dbGuineaPigController@edit');
	
    Route::get('/guineapigs-overview/delete/{id}', 'GuineaPig\GuineaPigController@delete');
    
    Route::post('/guineapigs-overview/create/{id}', 'dbGuineaPigController@create');
    Route::post('api/guineapigs-overview/{id}', 'GuineaPig\ApiGuineaPigController@update');
    Route::delete('api/guineapigs-overview/{id}', 'GuineaPig\ApiGuineaPigController@delete');
});

Route::group(array('before' => 'auth'), function() {

	Route::get('/litter-overview/icc', "dbLitterController@icc");

	Route::get(
	
	'/litter-overview', 
		[
			"uses" => 'vwLitterController@index',
			"as" => 'litter-overview'
		]
	);
	
	Route:get(
	
	'/litter-overview/form', 
		[
			"uses" => 'vwLitterController@form',
			"as" => 'litter-form'
		]
	);
	
	Route::get('/litter-overview/form/{id}', 'vwLitterController@form');
	
	Route::post('/litter-overview/form/{id}', 'dbGuineaPigController@createFromLitter');
	
	Route::post('/litter-overview', 'dbGuineaPigController@createFromLitter');
	
	Route::get(
	
	'/litter-overview/create/', 
		[
			"uses" => 'vwLitterController@create',
			"as" => 'create-litter'
		]
	);
	
	Route::get(
	
	'/litter-overview/update/', 
		[
			"uses" => 'dbLitterController@update',
			"as" => 'litter-update'
		]
	);
	
    Route::get('/litter-overview/create/{id}', 'vwLitterController@create');
    Route::post('/litter-overview/create/', 'dbLitterController@create');
	
	Route::get('/litter-overview/generate', "vwLitterController@generatePossibleLitter");
	
});

?>	
