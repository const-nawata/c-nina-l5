<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryLevelField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::table('categories', function( Blueprint $table ){
			$table->integer('rank', FALSE, TRUE )->after('parent_id')->default(0);
			$table->index( ['rank','name'],'categories_rank_name_index' );
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::table('categories', function( Blueprint $table ){
			$table->dropIndex('categories_rank_name_index');
			$table->dropColumn('rank');
		});
	}

}
