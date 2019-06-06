<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class CreateSubSpeakersTable extends Migration {
		
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema ::create('sub_speakers', function(Blueprint $table) {
				$table -> increments('ID');
				$table -> string('Driver_Size', 50) -> nullable();
				$table -> string('Fs_Hz', 50) -> nullable();
				$table -> string('Qms', 50) -> nullable();
				$table -> string('Qes', 50) -> nullable();
				$table -> string('Qts', 50) -> nullable();
				$table -> string('Vas_liters', 50) -> nullable();
				$table -> string('Dimensions_in', 50) -> nullable();
				$table -> string('Dimensions_mm', 50) -> nullable();
				$table -> timestamps();
				$table -> string('speaker_name') -> nullable();
				$table -> foreign('speaker_name')
				       -> references('Name')
				       -> on('speakers')
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
			Schema ::dropIfExists('sub_speakers');
		}
	}
