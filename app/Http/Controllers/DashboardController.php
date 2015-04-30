<?php namespace App\Http\Controllers;

use App\Category;
use Request;
use Response;
use App\Http\Requests\CategoryFormRequest;
use App\Http\Requests\GoodFormRequest;
use League\Flysystem\Adapter\NullAdapter;
use App\Good;
use App\Unit;


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

/**
 *
 * @param string $id
 * @return string
 */
    public function getGoodEditform( $pid, $id=NULL ){

    	if( $id == NULL ){
    		$item	= new Good();
    		$id_url	= '';
    	}else{
    		$item	= Good::find( $id );
    		$id_url	= '/'.$id;
    	}

    	$cllct	= Unit::select(['id','const'])->get();

    	$units	= []; $sel = -1;
    	foreach( $cllct as $unit ){
    		$units[$unit->id]	= @trans('prompts.units.'.$unit->const);
    		$sel	= ($unit->id == $item->unit_id) ? $unit->id : $sel;
    	}


		return view( 'dashboard/goods/form', [
			'pid'		=> $pid
			,'id_url'	=> $id_url
			,'name'		=> $item->name
			,'article'	=> $item->article
			,'unit_id'	=> $item->unit_id
			,'rprice'	=> $item->rprice
			,'wprice'	=> $item->wprice
			,'inpack'	=> $item->inpack
			,'units'	=> ['list'=>$units,'sel'=>$sel]
		]);
    }
//______________________________________________________________________________

     public function postGood( GoodFormRequest $request, $id=NULL ){
     	$good_data	= $request->all();

    	$good	= $id != NULL ? Good::find( $id ) : new Good();
    	$good	= $good->fill( $good_data );
	    $res 	= $good->save();

     	return Response::json(['id'=>$good->id]);
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

    public function getGoods( $id=NULL ){
    	$js_fields	= Good::getFieldsJSON($exclFields=['archived']);
    	$js_fields	= json_decode($js_fields,TRUE);
    	$js_fields[]= ['name'=>'checkbox'];

    	return view( 'dashboard/goods/list',['pid'=>'goodstable','jsFields'=>json_encode($js_fields)] );
    }
//______________________________________________________________________________

    public function getGoodstable(){
    	return Good::getTblDataJSON( $_GET );
    }
//______________________________________________________________________________

    public function archiveGoods(){
    	$n_rows 	= Good::archiveGoods( $_POST['data']['is_to_arch'] == 'true', $_POST['ids'] );

    	$n_rows_req	= count($_POST['ids']);

    	$message	= $n_rows == $n_rows_req
    		? trans('messages.arch_success')
    		: '';

    	return json_encode( ['message'=>$message] );
    }

    public function getUsers(){
    	return view( 'dashboard/users' );
    }
//______________________________________________________________________________

}//	Class end