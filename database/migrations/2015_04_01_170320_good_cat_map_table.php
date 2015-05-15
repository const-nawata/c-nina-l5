<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodCatMapTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::dropIfExists('good_cat');

		Schema::create( 'good_cat', function( Blueprint $table ){
			$table->engine = 'InnoDB';
			$table->increments( 'id' )->unsigned();
			$table->integer( 'good_id',FALSE, TRUE);
			$table->integer( 'cat_id',FALSE, TRUE);


			$table->foreign('good_id','prod_map_fk')
				->references('id')->on('goods')
				->onDelete('cascade')
				->onUpdate('cascade');

			$table->foreign('cat_id','category_map_fk')
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
		Schema::dropIfExists('good_cat');
	}

}
