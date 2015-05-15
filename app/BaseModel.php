<?php
 namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Goodcat;

class BaseModel extends Model{


	protected $jsFields	= [];

	private static function getTableRecs( &$rg, $jsFields=[] ){
    	$cols	= $rg['columns'];

    	$stmt	= self::select();

    	$instance = new static;
    	$js_fields	= $instance->jsFields;

    	if($rg['search']['value'] != '')
			$stmt->orWhere(function($query) use ( $cols, $rg ){
			    foreach ($cols as $col) {
			    	if($col['searchable'] == 'true' )
						$query->orWhere($col['name'],'like','%'.$rg['search']['value'].'%');
			    }
			 });


			//	Individual column search
    	foreach( $cols as $col ){
    		$search	= $col['search']['value'];

    		$ftype	= isset($js_fields[$col['name']]) ? $js_fields[$col['name']] : 'varchar';

    		switch( $ftype ){
    			case 'varchar':
    			case 'text':
		    		if( $search != '' )
		    			$stmt->where($col['name'],'like','%'.$search.'%' );
    				break;

    			case 'bool':
    				$stmt->where($col['name'],'=', $search );
    				break;

    			case 'integer':
    			case 'float':
					if( $search != '' )
		    			$stmt->where($col['name'],'=', $search );
    				break;
    		}
    	}

    	foreach( $rg['order'] as $order )
    		$stmt->orderBy( $cols[$order['column']]['name'], $order['dir'] );


    	$rg['filtered']	= $stmt->count();

    	$page	= $rg['start']/$rg['length'] + 1;
    	$stmt->forPage($page, $rg['length']);

    	return $stmt->get();
	}

/**
 * gets prepared date to show in DataTables JQuery plugin
 * @param array $rg - get/post parameters which is sent by ajax
 * @param bool $isJson - retuned format
 * @return array/json
 */
	public static function getTableData( $rg ){

		$recs	= self::getTableRecs( $rg );

		$pid	= $rg['pid'];

		$cols	= $rg['columns'];

    	$data	= [];
    	foreach( $recs as $rec ){
    		$fld_vals	= [];

    		foreach( $cols as $col )
				$fld_vals[]	= isset($rec->$col['name']) ? $rec->$col['name'] : '';

    		$data[]	= $fld_vals;
    	}

		return [
			'draw' => intval($rg['draw']),
			'recordsTotal' => self::all()->count(),
			'recordsFiltered' => $rg['filtered'],
			'data' => $data
		];
	}
//______________________________________________________________________________

/**
 * gets JSON array string for DataTable component.
 * @param	array $excludeFields - fields which must be excluded from DataTable processing.
 * @return string
 */
	public static function getFieldsJSON($exclFields=[]){

    	$instance = new static;
    	$js_fields	= $instance->jsFields;

    	foreach($exclFields as $fld )
    		unset($js_fields["$fld"]);

    	$result	= [];
    	foreach($js_fields as $fld_name=>$fld )
    		$result[]	= ['name'=>$fld_name];

    	$result	= json_encode($result);

    	return $result;
	}
//______________________________________________________________________________

}//	Class end