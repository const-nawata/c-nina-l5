<?php namespace App\Http\Controllers;

use App;

class MainController extends Controller {

	public function __construct(){
		$this->setLang();
	}
//______________________________________________________________________________

/**
 * sets language in application
 * @param string $lang
 */
	private function setLang(){

		if( isset($_GET['lang']) )
			$lang	= $_GET['lang'];

		else{
			$sess_lang	= session('lang');
			$lang		= $sess_lang ? $sess_lang : App::getLocale();
		}

		session(['lang'=>$lang]);
		App::setLocale( $lang );
	}
//______________________________________________________________________________

}//	Class end
