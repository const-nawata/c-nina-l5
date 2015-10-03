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
		Schema::dropIfExists('categorytree');

		Schema::create( 'categorytree', function( Blueprint $table ){
			$table->engine = 'InnoDB';
			$table->increments( 'id' )->unsigned();
			$table->integer( 'category_id',FALSE, TRUE);
			$table->integer( 'parent_id',FALSE, TRUE)->nullable()->default(NULL);
			$table->integer( 'rank', FALSE, TRUE )->default(0);

			$table->foreign('category_id','categrory_tree_fk')
				->references('id')->on('categories')
				->onDelete('cascade')
				->onUpdate('cascade');

			$table->foreign('parent_id','parent_tree_fk')
				->references('id')->on('categorytree')
				->onDelete('set null')
				->onUpdate('set null');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('categorytree');
	}

}
