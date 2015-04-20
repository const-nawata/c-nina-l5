<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodsRafactorRpriceWprice extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::table('goods', function( Blueprint $table ){
			$table->renameColumn('r_price', 'rprice');
			$table->renameColumn('w_price', 'wprice');
			$table->renameColumn('in_pack', 'inpack');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::table('goods', function( Blueprint $table ){
			$table->renameColumn('rprice', 'r_price');
			$table->renameColumn('wprice', 'w_price');
			$table->renameColumn('inpack', 'in_pack');
		});
	}

}
