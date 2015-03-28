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
    	$this->_cats_tree	= Category::getTree( $selCatId );
    	return view( 'dashboard/categories/list', ['tree' => $this->_cats_tree, 'sel_cat_id'=>$selCatId ] );
    }
//______________________________________________________________________________

    public function removeCategory( $id ){
		$cat = Category::find( $id );
		$cat->delete();
    	return redirect('/dashboard/categories');
    }
//______________________________________________________________________________

    public function getCategory( $id=NULL ){
		if($id == NULL){
			$cat_sel	= new Category();
			$count_children	= 0;
			$cat_url	= '';
		}else{
			$cat_sel	= Category::find( $id );
			$count_children = Category::where('parent_id', '=', $id )->count();
			$cat_url	= '/'.$id;
		}

    	$this->_cats_tree	= $this->_cats_tree == NULL
    		? Category::getTree()
    		: $this->_cats_tree;

    	$cats_names	= [ -1=>'- '.trans('prompts.root_cat').' -'];
    	foreach( $this->_cats_tree as $cat )
    		$cats_names	= self::getCatsSelBoxItem( $cats_names, $cat );

    	return view( 'dashboard/categories/form', ['cat'=>$cat_sel, 'cats_names'=>$cats_names, 'is_has_chilren' => ($count_children > 0), 'cat_url'=>$cat_url ] );
    }
//______________________________________________________________________________

    public function postCategory( $id=NULL ){
    	$cat_data	= Request::all();
    	$cat_data['parent_id']	= $cat_data['parent_id'] < 0 ? NULL : $cat_data['parent_id'];

    	$cat	= $id != NULL ? Category::find( $id ) : new Category();
    	$cat	= $cat->fill( $cat_data );
	    $res 	= $cat->save();

    	return redirect('/dashboard/categories/'.$cat->id);
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