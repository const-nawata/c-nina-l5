<?php namespace App;

use App\BaseModel;

class Category extends BaseModel{

	protected $table = 'categories';

	protected $fillable = [
		'name'
	];

	protected $jsFields	= [
		'id'		=> 'integer',
		'name'		=> 'varchar'
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




	public static function getTblDataJSON( $rg ){
		$tbl_info	= self::getTableData( $rg );
    	$data	= [];
    	foreach( $tbl_info['data'] as $rec ){
    		$fld_vals	= [];

    		foreach( $rg['columns'] as $ind=>$col ){
				$val	= $rec[$ind];
				$fld_vals[]	= $val;
    		}
    		$data[]	= $fld_vals;
    	}

		$tbl_info['data']	= $data;

		return json_encode($tbl_info);
	}

}//	Class end
