<?php
use App\Good;
// use Tests;

class Unit_01_Test extends TestCase{

// 	private $ids;

	public function tearDown(){
		$this->clearDb();

		parent::tearDown();
	}

	public function test_Category_Tree(){
// 		$response = $this->call('GET', '/');

		$exp_total	= Good::all()->count();

		$get	= [
			'draw'	=> '12'
		];
		$res	= Good::getTableData( $get );

		$this->assertEquals( 12, $res['draw'], "\n*** Assert 1 ***\nWrong 'draw' value\n" );
		$this->assertEquals( $exp_total, $res['recordsTotal'], "\n*** Assert 2 ***\nWrong 'recordsTotal' value\n" );

		$new_item	= [
			'name'	=> ''
			,'article'=> ''
			,'rprice'	=> 5.567
			,'wprice'	=> 4.444
			,'in_pack'	=> 24
			,'packs'	=> 13
			,'assort'	=> 17
		];



		$this->db['Good']	= [];
		$items	= &$this->db['Good'];

	    for( $i=0; $i<3; $i++ ){
	    	$item	= $new_item;
	    	$item['name']	= self::_ut_name.'_'.$i;
	    	$item['article']	= self::_ut_name.'_'.$i;
			$item_obj	= new Good();
	    	$item_obj	= $item_obj->fill( $item );
		    $res 	= $item_obj->save();

		    $ids[]	=
		    $item['id']	= $item_obj->id;;

			$items[]	= $item;

		    $item_obj	= NULL;
	    }


// print_r(  $ids);

// 	    $ut_item_id	= $item_obj->id;


	    $exp_total	= Good::all()->count();
	    $res	= Good::getTableData( $get );
// 	    $item_obj->delete();

// 		Good::whereIn('id');


	    $this->assertEquals( $exp_total, $res['recordsTotal'], "\n*** Assert 3 ***\nWrong 'recordsTotal' value\n" );

	}

}//	Class end

//	$this->assertEquals( $expected, $real, "\n*** Assert 1 ***\nInfo\n" );
//	$this->assertTrue( $condition, "\n*** Assert 1 ***\nInfo\n");
