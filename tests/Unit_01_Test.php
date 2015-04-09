<?php
use App\Category;

class Unit_01_Test extends TestCase {

	public function test_Category_Tree(){
// 		$response = $this->call('GET', '/');


		$tree	= Category::getTree();

// 		$arr	= [200,300,400];
// 		$this->assertEquals(200, 201);
	}

}
