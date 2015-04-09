<?php

class Unit_01_Test extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample(){
		$response = $this->call('GET', '/');
		$arr	= [200,300,400];
		$this->assertEquals(200, 201);
	}

}
