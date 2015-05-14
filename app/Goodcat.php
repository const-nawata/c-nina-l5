<?php
 namespace App;

use App\BaseModel;
use App\Unit;

class Goodcat extends BaseModel{

	protected $table = 'goodcats';

	protected $fillable = [
		'good_id'
		,'cat_id'
	];
}//	Class end