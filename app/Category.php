<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{

	protected $table = 'categories';

	protected $fillable = [
		'name'
		,'parent_id'
		,'rank'
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
				->where('parent_id','=', $catId)
				->orderBy('rank')->orderBy('name')->get();

		$sub_tree	= [];
		foreach( $cats as $cat ){
			$children	= self::getChildren( $cat->id, $selCatId );

			$sub_tree[]	= [
				'id'	=> $cat->id,
				'name'	=> $cat->name,
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

		$cats	= self::whereRaw('parent_id IS NULL')->orderBy('rank')->orderBy('name')->get();

		$tree	= [];

		foreach( $cats as $cat ){
			$children	= self::getChildren( $cat->id, $selCatId );

			$tree[]	= [
				'id'	=> $cat->id,
				'name'	=> $cat->name,
				'expand'	=> $cat->id == $selCatId || self::isChildrenHasExpand( $children, $selCatId ),
				'children'	=> $children,
				'is_selected'	=> $selCatId == $cat->id
			];
		}

		return $tree;
	}
//______________________________________________________________________________

/**
 * defines validation rules for planet creation.
 * @return	array - validation rules
 */
	public static function getValidationRules() {
		return [
			'name'      => 'required',
			'rank'     => 'integer|min:0'
		];
	}
//______________________________________________________________________________

}//	Class end
