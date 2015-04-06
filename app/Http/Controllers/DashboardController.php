<?php namespace App\Http\Controllers;

use App\Category;
use Request;
use App\Http\Requests\CategoryFormRequest;
use League\Flysystem\Adapter\NullAdapter;


class DashboardController extends MainController{

	private static function getCatsSelBoxItem( $parentsArr, $cat, $level=-1 ){
		$level++;

		$name	= '';
		for( $i=0; $i<$level; $i++)
			$name	.= "&#8226; ";

		$name	.= $cat['name'];

		$parentsArr[$cat['id']]	= $name;

		foreach($cat['children'] as $child )
			$parentsArr	= self::getCatsSelBoxItem( $parentsArr, $child, $level );

		return $parentsArr;
	}
//______________________________________________________________________________

/**
 * shows categories tree and seleceted category (if it was selected)
 * @param integer $selCatId	- category id.
 * @return \Illuminate\View\View - HTML content
 */
    public function getCategories( $selCatId=NUll ){
    	$tree	= Category::getTree( $selCatId );

    	$cat_sel	= ($selCatId == NULL)
			? new Category()
			: Category::find( $selCatId );

    	$cats_names	= [ -1=>'- '.trans('prompts.root_cat').' -'];
    	foreach( $tree as $cat )
    		$cats_names	= self::getCatsSelBoxItem( $cats_names, $cat );

    	return view( 'dashboard/categories/list'
    				,[
    					'tree'		=> $tree
    					,'sel_id'	=> ($selCatId!=NULL?$selCatId : 'null')
    					, 'cats_names'=>$cats_names
    				]
    			);
    }
//______________________________________________________________________________

    public function removeCategory( $id ){
		$cat = Category::find( $id );
		$cat->delete();
    	return redirect('/dashboard/categories');
    }
//______________________________________________________________________________

/**
 *
 * @param string $id
 * @return string
 */
    public function getCategory( $id=NULL ){

		$cat	= $id != NULL ? Category::find( $id ) : new Category();


		$n_children = Category::where('parent_id', '=', $id )->count();

		$json	=

		 '{'.
			'"id":'.($id != NULL?$id:'null').
			',"name":"'.$cat->name.'"'.
			',"parent_id":'.($cat->parent_id!=NULL?$cat->parent_id:'null').
			',"rank":'.($cat->rank!=NULL?$cat->rank:0).
			',"n_children":'.$n_children.
		'}';

		return $json;
    }
//______________________________________________________________________________

     public function postCategory( CategoryFormRequest $request, $id=NULL ){

    	$cat_data	= $request->all();
    	$cat_data['parent_id']	= $cat_data['parent_id'] < 0 ? NULL : $cat_data['parent_id'];

    	$cat	= $id != NULL ? Category::find( $id ) : new Category();
    	$cat	= $cat->fill( $cat_data );
	    $res 	= $cat->save();

    	return redirect('/dashboard/categories/'.$cat->id);
    }
//______________________________________________________________________________

    public function getGoods(){
    	return view( 'dashboard/goods/list' );
    }
//______________________________________________________________________________

    public function getGoodstable(){





// 	$output	= [
// 		"sEcho" => intval($_GET['sEcho']),
// 		"iTotalRecords" => $iTotal,
// 		"iTotalDisplayRecords" => $iFilteredTotal,
// 		"aaData" => []
// 	];


    	return
'{'.
	'"sEcho": 1,'.
	'"iTotalRecords": "3",'.
	'"iTotalDisplayRecords": "3",'.
	'"aaData":['.
		'['.
			'"F1-R1",'.
			'"F2-R1",'.
			'"F3-R1",'.
			'"F4-R1",'.
			'"F4-R1",'.
			'"F4-R1",'.
			'"F5-R1"'.
		'],'.
		'['.
			'"F1-R2",'.
			'"F2-R2",'.
			'"F3-R2",'.
			'"F4-R2",'.
			'"F4-R1",'.
			'"F4-R1",'.
			'"F5-R2"'.
		'],'.
		'['.
			'"F1-R3",'.
			'"F2-R3",'.
			'"F3-R3",'.
			'"F4-R3",'.
			'"F4-R1",'.
			'"F4-R1",'.
			'"F5-R3"'.
		']'.
	']'.
'}'.


    	'';
    }
//______________________________________________________________________________

    public function getUsers(){
    	return view( 'dashboard/users' );
    }
//______________________________________________________________________________

}//	Class end