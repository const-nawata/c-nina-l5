<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategorytreeRankField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::table('categorytree', function( Blueprint $table ){
			$table->integer('rank', FALSE, TRUE )->after('parent_id')->default(0);
			$table->index( ['rank'],'categorytree_rank_index' );
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::table('categorytree', function( Blueprint $table ){
			$table->dropIndex('categorytree_rank_index');
			$table->dropColumn('rank');
		});

	}

}
