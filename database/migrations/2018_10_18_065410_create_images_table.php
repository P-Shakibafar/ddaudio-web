<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class CreateImagesTable extends Migration {
		
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema ::create('images', function(Blueprint $table) {
				$table -> increments('ID');
				$table -> string('Path');
				$table -> string('Name');
				$table -> timestamps();
				$table -> string('amplifire_name')->nullable();
				$table -> foreign('amplifire_name')
				       -> references('Name')
				       -> on('amplifires')
				       -> onDelete('cascade')
				       -> onUpdate('cascade');
				$table -> string('speaker_name')->nullable();
				$table -> foreign('speaker_name')
				       -> references('Name')
				       -> on('speakers')
				       -> onDelete('cascade')
				       -> onUpdate('cascade');
				$table -> string('signal_processor_name')->nullable();
				$table -> foreign('signal_processor_name')
				       -> references('Name')
				       -> on('signal_processors')
				       -> onDelete('cascade')
				       -> onUpdate('cascade');
				$table -> string('sub_series_name')->nullable();
				$table -> foreign('sub_series_name')
				       -> references('Name')
				       -> on('sub_series')
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
			Schema ::dropIfExists('images');
		}
	}
