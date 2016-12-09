<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class IndexController extends MainController{

    public function getIndex(){

		$products = DB::table('products')->paginate(8);

    	return view( 'index',[
    		'products'=>$products
    	]);
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