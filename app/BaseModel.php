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

    	foreach( $cols as $col )
    		if( $col['search']['value'] != '' )
    			$recs->where($col['name'],'like','%'.$col['search']['value'].'%');

    	if($rg['search']['value'] != '' )
    		foreach( $cols as $col )
    			if($col['searchable'] == 'true' )
    				$recs->orWhere($col['name'],'like','%'.$rg['search']['value'].'%');

    	foreach( $rg['order'] as $order )
    		$recs->orderBy( $cols[$order['column']]['name'], $order['dir'] );


    	$n_filtered	= $recs->count();

    	$page	= $rg['start']/$rg['length'] + 1;
    	$recs->forPage($page, $rg['length']);

    	$recs	= $recs->get();

    	$data	= [];
    	foreach( $recs as $rec ){
    		$dt	= [];

    		foreach( $cols as $col )
    			$dt[]	= $rec->$col['name'];

    		$data[]	= $dt;
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