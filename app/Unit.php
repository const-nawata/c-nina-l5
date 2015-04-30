<?php namespace App;

use App\BaseModel;

class Unit extends BaseModel{

	protected $table = 'units';

	protected $fillable = [
		'const'
	];

	public static function getUnits(){
		$uitems	= Unit::all(['id','const']);

		$units	= [];
		foreach($uitems as $unit )
			$units[$unit->id]	= @trans('prompts.units.'.$unit->const);

		return $units;
	}
//______________________________________________________________________________

}//	Class end
