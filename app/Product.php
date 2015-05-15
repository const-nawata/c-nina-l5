<?php
 namespace App;

use App\BaseModel;
use App\Unit;

class Product extends BaseModel{

	protected $table = 'products';

	protected $fillable = [
		'name'		//200
		,'article'	//200
		,'rprice'	//0.000
		,'wprice'	//0.000
		,'inpack'	//int
		,'packs'	//int
		,'assort'	//int
		,'unit_id'	//int
		,'archived'	//boolean
	];

	protected $jsFields	= [
		'id'		=> 'integer',
		'name'		=> 'varchar',
		'article'	=> 'varchar',
		'rprice'	=> 'float',
		'wprice'	=> 'float',
		'inpack'	=> 'integer',
		'packs'		=> 'integer',
		'assort'	=> 'integer',
		'archived'	=> 'bool'
	];

	public static function archive( $status, $ids=[] ){
		return self::whereIn('id',$ids)->update(['archived' => $status]);
	}
//______________________________________________________________________________

	public static function getTblDataJSON( $rg ){

		$last_column	= count($rg['columns']);
		$rg['columns'][]	= [
			'data'	=> $last_column,
			'name'	=> 'archived',
			'searchable'	=> 'false',
			'orderable'		=> 'false',
			'search'	=> [
				'value'	=> $rg['is_show_arch'] == 'true'
			]
		];

		$last_column	= count($rg['columns']);
		$rg['columns'][]	= [
			'data'	=> $last_column,
			'name'	=> 'unit_id',
			'searchable'	=> 'false',
			'orderable'		=> 'false',
			'search'	=> [
				'value'	=> ''
			]
		];

		$tbl_info	= self::getTableData( $rg );

		$units	= Unit::getUnits();

    	$data	= [];
    	foreach( $tbl_info['data'] as $rec ){
    		$fld_vals	= [];

    		foreach( $rg['columns'] as $ind=>$col ){
				switch( $col['name'] ){
					case 'wprice':
					case 'rprice':
						$val	= number_format($rec[$ind],2,',',' ');
						break;

					case 'inpack':
					case 'assort':
						$val	= $rec[$ind].' '.$units[$rec[$last_column]];
						break;

					default:
						$val	= $rec[$ind];
				}

				$fld_vals[]	= $val;
    		}
    		$data[]	= $fld_vals;
    	}

		$tbl_info['data']	= $data;

		return json_encode($tbl_info);
	}
//______________________________________________________________________________

}//	Class end