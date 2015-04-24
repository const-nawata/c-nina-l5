<?php
 namespace App;

use App\BaseModel;

class Good extends BaseModel{

	protected $table = 'goods';

	protected $fillable = [
		'name'		//200
		,'article'	//200
		,'rprice'	//0.000
		,'wprice'	//0.000
		,'inpack'	//int
		,'packs'	//int
		,'assort'	//int
		,'archived'	//boolean
	];

	public static function archiveGoods( $ids=[] ){
		$affectedRows	= self::whereIn('id',$ids)->update(['archived' => TRUE])
		;
		return $affectedRows;
	}
//______________________________________________________________________________

}//	Class end