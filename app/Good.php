<?php
 namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model{

	protected $table = 'goods';

	protected $fillable = [
		'name'
		,'article'
		,'r_price'
		,'w_price'
		,'in_pack'
		,'packs'
		,'assort'
	];

}//	Class end