<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Categorytrees extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::dropIfExists('categorytrees');

		Schema::create( 'categorytrees', function( Blueprint $table ){
			$table->engine = 'InnoDB';
			$table->increments( 'id' )->unsigned();
			$table->integer( 'category_id',FALSE, TRUE);
			$table->integer( 'parent_id',FALSE, TRUE);

			$table->foreign('category_id','categrory_tree_fk')
				->references('id')->on('categories')
				->onDelete('cascade')
				->onUpdate('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('categorytrees');
	}

}
