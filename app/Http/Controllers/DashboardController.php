<?php namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;


class DashboardController extends MainController{
// class IndexController extends Controller{

    public function getCategories(){
    	return view( 'dashboard/categories' );
    }
//______________________________________________________________________________

}//	Class end