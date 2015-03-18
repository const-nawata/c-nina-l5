<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::dropIfExists('categories');

		Schema::create( 'categories', function( Blueprint $table ){
			$table->engine = 'InnoDB';
			$table->increments( 'id' )->unsigned();

			$table->string( 'name', 100 )->nullable();
			$table->integer('parent_id', FALSE, TRUE )->unsigned()->nullable();

			$table->timestamps();
			$table->index( ['name'] );
		});
	}
//______________________________________________________________________________

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('categories');
	}
//______________________________________________________________________________

}//	Class end
