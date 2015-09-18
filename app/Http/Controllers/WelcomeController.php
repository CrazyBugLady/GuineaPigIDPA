<?php
namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Http\Request;
use View, Auth;

class WelcomeController extends Controller
{	

	public function index(){
		return View::make("welcome");
	}
}
