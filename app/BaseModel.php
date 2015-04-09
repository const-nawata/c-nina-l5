<?php
 namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model{

/**
 * gets prepared date to show in DataTables JQuery plugin
 * @param array $get - get/post parameters which is sent by ajax
 * @param bool $isJson - retuned format
 * @return array/json
 */
	public static function getTableData( $get, $isJson=FALSE ){


		$result	= [
			'draw' => intval($get['draw']),
			'recordsTotal'	=> self::all()->count()
		];


		return $result;
	}
//______________________________________________________________________________

}//	Class end