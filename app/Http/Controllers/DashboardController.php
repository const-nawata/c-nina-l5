<?php namespace App\Http\Controllers;

use App\Category;
use Request;
use App\Http\Requests\CategoryFormRequest;
use League\Flysystem\Adapter\NullAdapter;
use App\Good;


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
    	$cols	= $_GET['columns'];

    	$recs_total	= Good::all()->count();

    	$recs	= Good::select();

    	foreach( $cols as $col )
    		if( $col['search']['value'] != '' )
    			$recs->where($col['name'],'like','%'.$col['search']['value'].'%');

    	if($_GET['search']['value'] != '' )
    		foreach( $cols as $col )
    			if($col['searchable'] == 'true' )
    				$recs->orWhere($col['name'],'like','%'.$_GET['search']['value'].'%');


    	$n_filtered	= $recs->count();

    	$page	= $_GET['start']/$_GET['length'] + 1;
    	$recs->forPage($page, $_GET['length']);

    	$recs	= $recs->get();

    	$data	= [];
    	foreach( $recs as $rec ){
    		$data[]	= [
    			$rec->name,
    			$rec->article,
    			$rec->w_price,
    			$rec->r_price,
    			$rec->in_pack,
    			$rec->packs,
    			$rec->assort
			];
    	}


	$output	= [
		"draw" => intval($_GET['draw']),
		"recordsTotal" => $recs_total,
		"recordsFiltered" => $n_filtered,
		"data" => $data
	];

	return json_encode($output);
    }
//______________________________________________________________________________

    public function getUsers(){
    	return view( 'dashboard/users' );
    }
//______________________________________________________________________________

}//	Class end