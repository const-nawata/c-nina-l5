<?php
 namespace App;

use App\BaseModel;
use App\Unit;

class Prodcat extends BaseModel{

	protected $table = 'prodcats';

	public $timestamps = FALSE;

	protected $fillable = [
		'product_id'
		,'category_id'
	];

	public function product(){
		return $this->belongsToMany('App\Product');

		//	This method created for future using.
//Example:
// $good_cat	= Goodcat::find( $id );
// $good_cat->product()->associate($good);
// $good_cat->save();
	}
//______________________________________________________________________________

}//	Class end