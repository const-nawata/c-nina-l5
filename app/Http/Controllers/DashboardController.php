<?php namespace App\Http\Controllers;

use App\Category;
use Request;
use League\Flysystem\Adapter\NullAdapter;

class DashboardController extends MainController{

	private $_cats_tree = NULL;


	private static function getCatsSelBoxItem( $parentsArr, $cat, $level=-1 ){
		$level++;

		$name	= '';
		for( $i=0; $i<$level; $i++){
			$name	.= "&#8226; ";
		}

		$name	.= $cat['name'];

		$parentsArr[$cat['id']]	= $name;

		foreach($cat['children'] as $child ){
			$parentsArr	= self::getCatsSelBoxItem( $parentsArr, $child, $level );
		}

		return $parentsArr;
	}
//______________________________________________________________________________

/**
 * shows categories tree and seleceted category (if it was selected)
 * @param integer $selCatId	- category id.
 * @return \Illuminate\View\View - HTML content
 */
    public function getCategories( $selCatId=NUll ){

    	$this->_cats_tree	= $this->_cats_tree == NULL
    		? Category::getTree()
    		: $this->_cats_tree;

    	return view( 'dashboard/categories/list', ['tree' => $this->_cats_tree, 'sel_cat_id'=>$selCatId ] );
    }
//______________________________________________________________________________

    public function getCategory( $id ){
    	$cat_sel = Category::find( $id );


    	$this->_cats_tree	= $this->_cats_tree == NULL
    		? Category::getTree()
    		: $this->_cats_tree;

    	$parents	= [ -1=>'- '.trans('prompts.root_cat').' -'];
    	foreach( $this->_cats_tree as $cat )
    		$parents	= self::getCatsSelBoxItem( $parents, $cat );

    	return view( 'dashboard/categories/form', ['cat'=>$cat_sel, 'parents'=>$parents ] );
    }
//______________________________________________________________________________

    public function postCategory( $id ){
    	$cat_data	= Request::all();
    	$cat_data['parent_id']	= $cat_data['parent_id'] < 0 ? NULL : $cat_data['parent_id'];

    	$cat	= Category::find( $id );
    	$cat	= $cat->fill( $cat_data );
	    $_id = $cat->save();

    	return redirect('/dashboard/categories/'.$id);
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