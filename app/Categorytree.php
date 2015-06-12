<?php
namespace App;

use App\BaseModel;

class Categorytree extends BaseModel{

	protected $table = 'categorytree';


	protected $fillable = [
		'category_id',
		'parent_id'
	];


/**
 * gets category tree.
 * @param integer $selCatId. This parameter must be NULL by default!!!
 * @return array - categories tree
 */
	public static function getTree( $selCatId=NULL ){
		$cats	= self::whereRaw('parent_id IS NULL')->orderBy('rank')->get();

		$tree	= [];


		return $tree;
	}
//______________________________________________________________________________

}//	Class end