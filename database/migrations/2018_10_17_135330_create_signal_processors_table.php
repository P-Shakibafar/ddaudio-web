<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class CreateSignalProcessorsTable extends Migration {
		
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema ::create('signal_processors', function(Blueprint $table) {
				$table -> string('Name', 50);
				$table -> primary('Name');
				$table -> string('Title', 50);
				$table -> longText('Description');
				$table -> string('Channels', 50) -> nullable();
				$table -> string('Input_Voltage_Sensitivity', 50) -> nullable();
				$table -> string('Input_Channels', 50) -> nullable();
				$table -> string('Output_Channels', 50) -> nullable();
				$table -> string('Output_Voltage', 50) -> nullable();
				$table -> string('Dimensions_in', 50) -> nullable();
				$table -> string('Dimensions_mm', 50) -> nullable();
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
			Schema ::dropIfExists('signal_processors');
		}
	}
