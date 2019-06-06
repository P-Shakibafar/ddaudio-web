<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class CreateEnclosuresTable extends Migration {
		
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema ::create('enclosures', function(Blueprint $table) {
				$table -> string('Model');
				$table -> primary('Model');
				$table -> string('Driver_Size', 50) -> nullable();
				$table -> string('Watts_RMS', 50) -> nullable();
				$table -> string('VCD', 50) -> nullable();
				$table -> string('Impedance', 50) -> nullable();
				$table -> string('Dimensions_in', 150) -> nullable();
				$table -> string('Dimensions_mm', 150) -> nullable();
				$table -> string('Shipping_Weight_lbs', 50) -> nullable();
				$table -> timestamps();
				$table -> string('sub_series_name') -> nullable();
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
			Schema ::dropIfExists('enclosures');
		}
	}
