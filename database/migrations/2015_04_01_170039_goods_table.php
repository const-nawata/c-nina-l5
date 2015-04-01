<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::dropIfExists('goods');

		Schema::create( 'goods', function( Blueprint $table ){
			$table->engine = 'InnoDB';
			$table->increments( 'id' )->unsigned();

			$table->string( 'name', 200 )->nullable();
			$table->string( 'articul', 200 )->nullable();
			$table->decimal( 'r_price', 10, 3 )->default(0.000);
			$table->decimal( 'w_price', 10, 3 )->default(0.000);
			$table->integer( 'in_pack',FALSE, TRUE)->default(0);
			$table->integer( 'packs',FALSE, TRUE)->default(0);
			$table->integer( 'assort',FALSE, TRUE)->default(0);

			$table->timestamps();

			$table->index( ['name'] );
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('goods');
	}

}
