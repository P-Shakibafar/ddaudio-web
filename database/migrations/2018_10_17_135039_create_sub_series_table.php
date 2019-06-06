<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class CreateSubSeriesTable extends Migration {
		
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema ::create('sub_series', function(Blueprint $table) {
				$table -> string('Name');
				$table -> primary('Name');
				$table->text('Title');
				$table -> longText('Description');
				$table -> longText('Features')->nullable();
				$table -> timestamps();
				$table -> string('series_name')->nullable();
				$table -> foreign('series_name')
				       -> references('Name')
				       -> on('series')
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
			Schema ::dropIfExists('sub_series');
		}
	}
