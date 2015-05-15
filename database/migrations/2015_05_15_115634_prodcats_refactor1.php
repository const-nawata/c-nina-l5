<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProdcatsRefactor1 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::table('prodcats', function( Blueprint $table ){
			$table->renameColumn('good_id', 'product_id');
			$table->renameColumn('cat_id', 'category_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::table('prodcats', function( Blueprint $table ){
			$table->renameColumn('product_id', 'good_id');
			$table->renameColumn('category_id', 'cat_id');
		});
	}

}
