<?php
use App\Good;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	const _ut_name	= 'UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT Unit test item UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT-UT';

	protected $db=[];

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication(){
		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;
	}
//______________________________________________________________________________

	public function clearDb(){
		foreach( $this->db as $model=>$items){
			$ids	= [];

			foreach( $items as $item )
				$ids[]	= $item['id'];

			switch( $model ){
				case 'Good': Good::whereIn('id',$ids)->delete(); break;
			}
		}
	}
//______________________________________________________________________________

}//	Class end
