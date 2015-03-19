<?php namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;


class IndexController extends MainController{
// class IndexController extends Controller{

    public function getIndex(){
    	return view( 'index' );
    }
//______________________________________________________________________________

    public function getAbout(){
    	return view( 'about' );
    }
//______________________________________________________________________________

    public function getContacts(){
    	return view( 'contacts' );
    }
//______________________________________________________________________________

    public function getDashboard(){
    	return view( 'dashboard' );
    }
//______________________________________________________________________________

}//	Class end