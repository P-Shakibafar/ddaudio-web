<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class CreateSeriesTable extends Migration {
		
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema ::create('series', function(Blueprint $table) {
				$table -> string('Name');
				$table -> primary('Name');
				$table -> longText('Description')->nullable();
				$table -> timestamps();
				$table -> string('product_name') -> nullable();
				$table -> foreign('product_name')
				       -> references('Name')
				       -> on('products')
				       -> onDelete('cascade')
				       -> onUpdate('cascade');
			});
		}
		
		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema ::dropIfExists('series');
		}
	}
