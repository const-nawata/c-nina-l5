<?php
 namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model{


	private static function getTableRecs( &$rg ){
    	$cols	= $rg['columns'];

    	$recs	= self::select();

    	foreach( $cols as $col )//	Individual column search
    		if( $col['searchable'] == 'true' && $col['search']['value'] != '' )
    			$recs->where($col['name'],'like','%'.$col['search']['value'].'%');

    	if($rg['search']['value'] != '' )//	All columns search
    		foreach( $cols as $col )
    			if($col['searchable'] == 'true' )
    				$recs->orWhere($col['name'],'like','%'.$rg['search']['value'].'%');

    	foreach( $rg['order'] as $order )
    		$recs->orderBy( $cols[$order['column']]['name'], $order['dir'] );


    	$rg['filtered']	= $recs->count();

    	$page	= $rg['start']/$rg['length'] + 1;
    	$recs->forPage($page, $rg['length']);

    	$recs	= $recs->get();

    	return $recs;
	}

/**
 * gets prepared date to show in DataTables JQuery plugin
 * @param array $rg - get/post parameters which is sent by ajax
 * @param bool $isJson - retuned format
 * @return array/json
 */
	public static function getTableData( $rg, $isJson=FALSE ){

		$recs	= self::getTableRecs( $rg );
// info(print_r(  $rg, TRUE));
//TODO: Maybe it'd better to send pid by ajax. And maybe there is a possibility to get this ajax's pid in JS from table instanse.
//This may simplify code.
		$pid	= str_singular(self::__callStatic('getTable',[]));

		$cols	= $rg['columns'];

    	$data	= [];
    	foreach( $recs as $rec ){
    		$fld_vals	= [];

    		foreach( $cols as $col ){
    			$val	= "";

				switch( $col['name'] ){
					case 'all_check':
						$val	= "<input type='checkbox' id='".$pid."rowcheckbox-".$rec->id."' class='row-check-box' onclick='processRowCheck(\"".$pid."\");' />";
						break;

					case 'wprice':
					case 'rprice':
						$val	= number_format($rec->$col['name'],2,',',' ');
						break;

					default:
						$val	= $rec->$col['name'];
				}

				$fld_vals[]	= $val;
    		}

    		$data[]	= $fld_vals;
    	}

		$output	= [
			'draw' => intval($rg['draw']),
			'recordsTotal' => self::all()->count(),
			'recordsFiltered' => $rg['filtered'],
			'data' => $data
// 			,'start'=>50
		];

		return $isJson ? json_encode($output) : $output;
	}
//______________________________________________________________________________

}//	Class end