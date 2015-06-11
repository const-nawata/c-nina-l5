<?php
namespace App;

use App\BaseModel;

class Categorytree extends BaseModel{

	protected $table = 'categorytree';


	protected $fillable = [
		'category_id',
		'parent_id'
	];

}