<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class CreateSpeakersTable extends Migration {
		
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema ::create('speakers', function(Blueprint $table) {
				$table -> string('Name');
				$table -> primary('Name');
				$table -> string('Title', 50);
				$table -> longText('Description');
				$table -> string('Watts_RMS', 50) -> nullable();
				$table -> string('VCD', 50) -> nullable();
				$table -> string('Impedance', 50) -> nullable();
				$table -> string('Frequency_Response_Hz', 50) -> nullable();
				$table -> string('dBSPL', 50) -> nullable();
				$table -> string('Mounting_Diameter_in', 50) -> nullable();
				$table -> string('Mounting_Depth_in', 50) -> nullable();
				$table -> string('Shipping_Weight_lbs', 50) -> nullable();
				$table -> timestamps();
				$table -> string('series_name') -> nullable();
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
			Schema ::dropIfExists('speakers');
		}
	}
