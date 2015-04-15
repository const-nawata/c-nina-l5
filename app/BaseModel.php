<?php
 namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model{

/**
 * gets prepared date to show in DataTables JQuery plugin
 * @param array $rg - get/post parameters which is sent by ajax
 * @param bool $isJson - retuned format
 * @return array/json
 */
	public static function getTableData( $rg, $isJson=FALSE ){
    	$cols	= $rg['columns'];

    	$recs	= self::select();

    	foreach( $cols as $col )//	Individual column search
    		if( $col['search']['value'] != '' )
    			$recs->where($col['name'],'like','%'.$col['search']['value'].'%');

    	if($rg['search']['value'] != '' )//	All columns search
    		foreach( $cols as $col )
    			if($col['searchable'] == 'true' )
    				$recs->orWhere($col['name'],'like','%'.$rg['search']['value'].'%');

    	foreach( $rg['order'] as $order )
    		$recs->orderBy( $cols[$order['column']]['name'], $order['dir'] );


    	$n_filtered	= $recs->count();

    	$page	= $rg['start']/$rg['length'] + 1;
    	$recs->forPage($page, $rg['length']);

    	$recs	= $recs->get();

    	$pid 	= self::__callStatic('getTable',[]).'table';

    	$data	= [];
    	foreach( $recs as $rec ){
    		$fld_vals	= [];

    		foreach( $cols as $col ){
    			$val	= "";

				switch( $col['name'] ){
					case 'all_check':
						$val	= "<input type='checkbox' id='".$pid."rowcheckbox-".$rec->id."' class='row-check-box' onclick='processRowCheck(\"".$pid."\");' />";
						break;

					case 'w_price':
					case 'r_price':
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
			'recordsFiltered' => $n_filtered,
			'data' => $data
		];

		return $isJson ? json_encode($output) : $output;
	}
//______________________________________________________________________________

}//	Class end