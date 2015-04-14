<?php
 namespace App;

use App\BaseModel;

class Good extends BaseModel{

	protected $table = 'goods';

	protected $fillable = [
		'name'		//200
		,'article'	//200
		,'r_price'	//0.000
		,'w_price'	//0.000
		,'in_pack'	//int
		,'packs'	//int
		,'assort'	//int
	];

// 	public function __construct(){
// 		$this->table	= 'goods';
// 	}

}//	Class end