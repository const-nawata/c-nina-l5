<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::dropIfExists('units');

		Schema::create( 'units', function( Blueprint $table ){
			$table->engine = 'InnoDB';
			$table->increments( 'id' )->unsigned();

			$table->string( 'const', 200 );

			$table->unique( 'const' );

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('units');
	}

}
