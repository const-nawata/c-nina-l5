<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Unit;


class GoodUnitIdField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::table('goods', function( Blueprint $table ){

			$query	= Unit::whereRaw("const = 'pcs'");

			if( $query->exists() ){
				$id	= $query->take(1)->get()[0]->id;

			}else{
				$unit_data	= [
					'const'	=> 'pcs'
				];

			    $unit = new Unit();
		    	$unit	= $unit->fill($unit_data);
			    $id = $unit->save();
			}

			$table->integer('unit_id', FALSE, TRUE )->after('article')->default( $id );

			$table->foreign('unit_id','good_unit_fk')
				->references('id')->on('units')
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
		Schema::table('goods', function( Blueprint $table ){
			$table->dropForeign('good_unit_fk');
			$table->dropColumn('unit_id');
		});

	}

}
