<?php namespace App\Http\Controllers;


use Request;
use Response;
use App\Http\Requests\CategoryFormRequest;
use App\Http\Requests\ProductFormRequest;
use League\Flysystem\Adapter\NullAdapter;

use DB;
use App\Category;
use App\Product;
use App\Unit;
use App\Prodcat;

class DashboardController extends MainController{

    public function getUsers(){
    	return view( 'dashboard/users' );
    }
//______________________________________________________________________________


//		Categories
//______________________________________________________________________________

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
		$js_fields	= Category::getFieldsJSON();
		$js_fields	= json_decode($js_fields,TRUE);
    	$js_fields[]= ['name'=>'checkbox'];
		return view( 'dashboard/categories/list',['pid'=>'categoriestable','jsFields'=>json_encode($js_fields)] );
    }
//______________________________________________________________________________

    public function getCategoriestable(){
    	return Category::getTblDataJSON( $_GET );
    }
//______________________________________________________________________________

    public function removeCategories(){
    	$n_rows	= Category::select()->whereIn('id',$_POST['ids'])->delete();

    	$n_rows_req	= count($_POST['ids']);

    	$message	= $n_rows == $n_rows_req
    		? trans('messages.del_success')
    		: trans('messages.del_error');

    	return json_encode( ['message'=>$message] );
    }
//______________________________________________________________________________

/**
 *
 * @param string $id
 * @return string
 */
    public function getCategoryForm( $pid, $id=NULL ){

		$cat	= $id != NULL ? Category::find( $id ) : new Category();

    	if( $id == NULL ){
    		$cat	= new Category();
    		$id_url	= '';
    	}else{
    		$cat	= Category::find( $id );
    		$id_url	= '/'.$id;
    	}

		return view( 'dashboard/categories/form', [
			'pid'		=> $pid
			,'id_url'	=> $id_url
			,'name'		=> $cat->name
		]);
    }
//______________________________________________________________________________

	public function postCategory( CategoryFormRequest $request, $id=NULL ){

		$cat_data	= $request->all();

		$cat	= $id != NULL ? Category::find( $id ) : new Category();
		$cat	= $cat->fill( $cat_data );
		$res 	= $cat->save();

		return redirect('/dashboard/categories/'.$cat->id);
	}

//------------------------------------------------------------------------------
//		Products
//------------------------------------------------------------------------------
/**
 *
 * @param string $id
 * @return string
 */
    public function getProductForm( $pid, $id=NULL ){

    	if( $id == NULL ){
    		$item	= new Product();
    		$id_url	= '';
    		$cats	= [];//TODO: Get all categoties where `sel`=""
    	}else{
    		$item	= Product::find( $id );
    		$id_url	= '/'.$id;
    		$cats	= Category::select(DB::raw("id,name,IF(exists(SELECT * FROM `prodcats` WHERE `product_id`=$id AND `category_id`=`categories`.`id`),'selected','') AS `sel`"))->get()->toArray();
    	}

		return view( 'dashboard/products/form', [
			'pid'		=> $pid
			,'id_url'	=> $id_url
			,'name'		=> $item->name
			,'article'	=> $item->article
			,'unit_id'	=> $item->unit_id
			,'rprice'	=> $item->rprice
			,'wprice'	=> $item->wprice
			,'inpack'	=> $item->inpack
			,'units'	=> ['list'=>Unit::getUnits(),'sel'=>$item->unit_id]
			,'cats'		=> $cats
		]);
    }
//______________________________________________________________________________

     public function postProduct( ProductFormRequest $request, $id=NULL ){
     	$prod_data	= $request->all();

    	$prod	= $id != NULL ? Product::find( $id ) : new Product();
    	$prod	= $prod->fill( $prod_data );
	    $prod->save();

	    Prodcat::select()->where('product_id','=', $prod->id )->delete();

	    if( isset($prod_data['categories']) ){

	    	$prod_cats	= [];
	    	foreach( $prod_data['categories'] as $cat_id )
	    		$prod_cats[]	= new Prodcat( ['category_id'=>$cat_id] );

	    	$prod->hasMany('App\Prodcat')->saveMany( $prod_cats );
	    }

     	return Response::json(['id'=>$prod->id]);
    }
//______________________________________________________________________________

    public function getProducts( $id=NULL ){
    	$js_fields	= Product::getFieldsJSON($exclFields=['archived']);
    	$js_fields	= json_decode($js_fields,TRUE);
    	$js_fields[]= ['name'=>'checkbox'];

    	return view( 'dashboard/products/list',['pid'=>'productstable','jsFields'=>json_encode($js_fields)] );
    }
//______________________________________________________________________________

    public function getProductstable(){
    	return Product::getTblDataJSON( $_GET );
    }
//______________________________________________________________________________

    public function archiveProducts(){
    	$n_rows 	= Product::archive( $_POST['data']['is_to_arch'] == 'true', $_POST['ids'] );

    	$n_rows_req	= count($_POST['ids']);

    	$message	= $n_rows == $n_rows_req
    		? trans('messages.arch_success')
    		: trans('messages.arch_error');

    	return json_encode( ['message'=>$message] );
    }

}//	Class end