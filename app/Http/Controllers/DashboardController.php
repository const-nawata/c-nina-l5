<?php namespace App\Http\Controllers;

use App\Category;

class DashboardController extends MainController{

/**
 * shows categories tree and seleceted category (if it was selected)
 * @param integer $selCatId	- category id.
 * @return \Illuminate\View\View - HTML content
 */
    public function getCategories( $selCatId=NUll ){
    	$tree	= Category::getTree();


    	return view( 'dashboard/categories', ['tree' => $tree ] );
    }
//______________________________________________________________________________

    public function getGoods(){
    	return view( 'dashboard/goods' );
    }
//______________________________________________________________________________

    public function getUsers(){
    	return view( 'dashboard/users' );
    }
//______________________________________________________________________________

    public function getCategory( $id ){
    	$cat = Category::find( $id );
    	return view( 'dashboard/cat_content', ['cat'=>$cat] );
    }
//______________________________________________________________________________

    public function postCategory(){
    }
//______________________________________________________________________________

}//	Class end