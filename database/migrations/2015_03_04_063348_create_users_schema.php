<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class CreateUsersSchema extends Migration {

/**
 * Runs the migrations.
 *
 * @return void
 */
	public function up(){
		Schema::dropIfExists('users');

		Schema::create( 'users', function( Blueprint $uTable ){
			$uTable->engine = 'InnoDB';
			$uTable->increments( 'id' )->unsigned();

			$uTable->string( 'username', 20 )->unique();
			$uTable->string( 'password' );
			$uTable->string( 'email', 100 );
			$uTable->string( 'surname', 100 )->nullable();
			$uTable->string( 'name', 100 )->nullable();
			$uTable->text( 'address' )->nullable();
			$uTable->string( 'phone', 20 )->nullable();


			$uTable->enum( 'role', ['admin','client','guest','seller','woker'] );

			$uTable->boolean('isActive')->default(FALSE);
			$uTable->string('activationCode')->nullable();

			//	Tokent for possibility to remember use
			$uTable->rememberToken();

			$uTable->timestamps();


			$uTable->index( ['surname', 'name'] );
		});

		$this->createRootAdmin();
	}
//______________________________________________________________________________

/**
 * Reverses the migrations.
 *
 * @return void
 */
	public function down(){
		Schema::dropIfExists('users');
	}
//______________________________________________________________________________

	private function createRootAdmin(){
		$user_data	= [
			'username'	=> 'admin'
			,'password'	=> Hash::make( 'admin' )
			,'email'	=> 'nawataster@gmail.com'
			,'surname'	=> 'Root'
			,'name'	=> 'Admin'
			,'address'	=> ''
			,'phone'	=> ''
			,'role'	=> 'admin'
			,'isActive'	=> TRUE
			,'activationCode'	=> ''
		];


	    $user = new User();
    	$user	= $user->fill($user_data);
	    $id = $user->save();

	}
//______________________________________________________________________________

}//	Class end
