<?php
namespace App;

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

	public static function getTblDataJSON( $rg ){
		$tbl_info	= self::getTableData( $rg );
		return json_encode($tbl_info);
	}

}//	Class end
