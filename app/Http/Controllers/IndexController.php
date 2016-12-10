<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class IndexController extends MainController{

	private function prepareProducts( $products ){
		$path	= '/uploads/products/images/';

		foreach( $products as &$product )
			$product->photo	= $path.(($product->photo == null ) ? 'default.jpg' : $product->photo.'.jpg');

		return $products;
	}
//______________________________________________________________________________

    public function getIndex(){
    	return view( 'index',[
    		'products'	=> $this->prepareProducts( DB::table('products')->paginate(8) )
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