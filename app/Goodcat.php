<?php
 namespace App;

use App\BaseModel;
use App\Unit;

class Goodcat extends BaseModel{

	protected $table = 'goodcats';

	public $timestamps = FALSE;

	protected $fillable = [
		'good_id'
		,'cat_id'
	];

	public function product(){
		return $this->belongsToMany('App\Good');

		//	This method created for future using.
//Example:
// $good_cat	= Goodcat::find( $id );
// $good_cat->product()->associate($good);
// $good_cat->save();
	}
//______________________________________________________________________________

}//	Class end