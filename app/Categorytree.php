<?php
namespace App;

use App\BaseModel;

class Categorytree extends BaseModel{

	protected $table = 'categorytree';


	protected $fillable = [
		'category_id',
		'parent_id'
	];


	private static function isChildrenHasExpand( $children, $selCatId ){

		foreach( $children as $child )
			if( $child['expand'] )
				return TRUE;

		return FALSE;
	}
//______________________________________________________________________________

	private static function getChildren( $catId, $selCatId ){
		$cats	= self::whereNotNull('parent_id')
			->select('categorytree.id AS id','name','category_id')
			->leftJoin('categories', function($join){
            	$join->on('categories.id', '=', 'categorytree.category_id');
        	})
				->where('parent_id','=', $catId)
				->orderBy('rank')
				->orderBy('name')
				->get();

		$sub_tree	= [];
		foreach( $cats as $cat ){
			$children	= self::getChildren( $cat->id, $selCatId );

			$sub_tree[]	= [
				'id'	=> $cat->id,
				'name'	=> $cat->name,
				'category_id'	=> $cat->category_id,
				'expand'	=> $cat->id == $selCatId || self::isChildrenHasExpand( $children, $selCatId ),
				'children'	=> $children,
				'is_selected'	=> $selCatId == $cat->id
			];
		}

		return $sub_tree;
	}
//______________________________________________________________________________

/**
 * gets category tree.
 * @param integer $selCatId. This parameter must be NULL by default!!!
 * @return array - categories tree
 */
	public static function getTree( $selCatId=NULL ){
		$cats	= self::whereRaw('parent_id IS NULL')
			->select('categorytree.id AS id','name','category_id')
			->leftJoin('categories', function($join){
            	$join->on('categories.id', '=', 'categorytree.category_id');
        	})
			->orderBy('rank')->get();

		$tree	= [];

		foreach( $cats as $cat ){
			$children	= self::getChildren( $cat->id, $selCatId );

			$tree[]	= [
				'id'	=> $cat->id,
				'name'	=> $cat->name,
				'category_id'	=> $cat->category_id,
				'expand'	=> $cat->id == $selCatId || self::isChildrenHasExpand( $children, $selCatId ),
				'children'	=> $children,
				'is_selected'	=> $selCatId == $cat->id
			];
		}

		return $tree;
	}
//______________________________________________________________________________

}//	Class end