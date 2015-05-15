<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodsToProductsRename extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::rename('goods', 'products');
		Schema::rename('goodcats', 'prodcats');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::rename('products', 'goods');
		Schema::rename('prodcats', 'goodcats');
	}

}
