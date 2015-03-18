<?php namespace App\Http\Controllers;

use App\Category;

class DashboardController extends MainController{

    public function getCategories(){
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

}//	Class end