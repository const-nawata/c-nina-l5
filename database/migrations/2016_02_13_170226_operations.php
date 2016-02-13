<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Operations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){

		Schema::dropIfExists('operations');
 		Schema::create( 'operations', function( Blueprint $table ){
			$table->engine = 'InnoDB';
			$table->increments( 'id' )->unsigned();
			$table->integer( 'user_id',FALSE, TRUE);
			$table->enum( 'type',['sale','income','cancel'])->nullable();
			$table->timestamp( 'performed_at')->nullable();
			$table->decimal( 'cost', 10, 3 )->default(0.000)->comment = "The real cost.";

			$table->timestamps();

			$table->foreign('user_id','operations_users_fk')
				->references('id')->on('users')
				->onDelete('restrict')
				->onUpdate('cascade');
		});

 		Schema::dropIfExists('opentries');
 		Schema::create( 'opentries', function( Blueprint $table ){
			$table->engine = 'InnoDB';
			$table->increments( 'id' )->unsigned();
			$table->integer( 'operation_id',FALSE, TRUE);
			$table->integer( 'product_id',FALSE, TRUE);
			$table->integer( 'packs',FALSE, TRUE)->default(0);
			$table->integer( 'assort',FALSE, TRUE)->default(0);
			$table->decimal( 'cost', 10, 3 )->default(0.000);

			$table->timestamps();

			$table->foreign('product_id','opentries_products_fk')
				->references('id')->on('products')
				->onDelete('restrict')
				->onUpdate('cascade');

			$table->foreign('operation_id','opentries_operations_fk')
				->references('id')->on('operations')
				->onDelete('cascade')
				->onUpdate('cascade');
		});

	}
//______________________________________________________________________________

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){

		Schema::table('opentries', function($table){
			$table->dropForeign('opentries_products_fk');
			$table->dropForeign('opentries_operations_fk');
		});

		Schema::table('operations', function($table){
			$table->dropForeign('operations_users_fk');
		});

		Schema::dropIfExists('opentries');
		Schema::dropIfExists('operations');
	}
//______________________________________________________________________________

}//	Class end
