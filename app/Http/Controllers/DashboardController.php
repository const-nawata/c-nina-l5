<?php namespace App\Http\Controllers;

use App\Category;
use Request;

class DashboardController extends MainController{

/**
 * shows categories tree and seleceted category (if it was selected)
 * @param integer $selCatId	- category id.
 * @return \Illuminate\View\View - HTML content
 */
    public function getCategories( $selCatId=NUll ){
    	$tree	= Category::getTree();
    	return view( 'dashboard/categories/list', ['tree' => $tree, 'sel_cat_id'=>$selCatId ] );
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
    	return view( 'dashboard/categories/form', ['cat'=>$cat] );
    }
//______________________________________________________________________________

    public function postCategory( $id ){
    	$cat_data	= Request::all();

    	$cat	= Category::find( $id );
    	$cat	= $cat->fill( $cat_data );
	    $_id = $cat->save();

    	return redirect('/dashboard/categories/'.$id);
    }
//______________________________________________________________________________

}//	Class end