<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodsRefactorIsarch extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::table('goods', function( Blueprint $table ){
			$table->boolean('archived', FALSE, TRUE )->after('assort')->default( FALSE );
		});
	}
//______________________________________________________________________________

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::table('goods', function( Blueprint $table ){
			$table->dropColumn('archived');
		});
	}
//______________________________________________________________________________

}//	Class end
