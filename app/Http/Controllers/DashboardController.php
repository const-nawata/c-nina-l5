<?php namespace App\Http\Controllers;

class DashboardController extends MainController{

    public function getCategories(){
    	return view( 'dashboard/categories' );
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