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

	public static function getTblDataJSON( $rg ){
		$tbl_info	= self::getTableData( $rg );

    	$data	= [];
    	foreach( $tbl_info['data'] as $rec ){
    		$fld_vals	= [];

    		foreach( $rg['columns'] as $ind=>$col ){
    			$val	= "";

				switch( $col['name'] ){
					case 'checkbox':
// 						$val	= "<input type='checkbox' id='".$pid."rowcheckbox-".$rec->id."' class='row-check-box' />";
						break;

					case 'wprice':
					case 'rprice':
						$val	= number_format($rec[$ind],2,',',' ');
						break;

					default:
						$val	= $rec[$ind];
				}


// // 				$val	= isset($rec->$col['name']) ? $rec->$col['name'] : '';

				$fld_vals[]	= $val;
    		}
    		$data[]	= $fld_vals;
    	}

		$tbl_info['data']	= $data;

		return json_encode($tbl_info);
	}

}//	Class end