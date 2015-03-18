<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{

	protected $table = 'categories';

	protected $fillable = [
		'name'
		,'parent_id'
	];

	private static function getChildren( $catId ){
		$cats	= self::whereRaw('parent_id IS NOT NULL AND parent_id = ?', [$catId] )->get();

		$children	= [];
		foreach( $cats as $cat ){
			$children[]	= [
				'id'	=> $cat->id,
				'name'	=> $cat->name,
				'children'	=> self::getChildren( $cat->id )
			];
		}

		return $children;
	}
//______________________________________________________________________________

	public static function getTree(){

		$cats	= self::whereRaw('parent_id IS NULL')->get();

		$tree	= [];

		foreach( $cats as $cat ){
			$tree[]	= [
				'id'	=> $cat->id,
				'name'	=> $cat->name,
				'children'	=> self::getChildren( $cat->id )
			];
		}

		return $tree;
	}
//______________________________________________________________________________

}//	Class end
