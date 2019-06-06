<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class CreateAmplifiresTable extends Migration {
		
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema ::create('amplifires', function(Blueprint $table) {
				$table -> string('Name');
				$table -> primary('Name');
				$table -> text('Title');
				$table -> longText('Description');
				$table -> string('Test_Voltage', 50) -> nullable();
				$table -> unsignedSmallInteger('Channels') -> nullable();
				$table -> string('Cont_Wattage_4ohm', 50) -> nullable();
				$table -> string('Cont_Wattage_2ohm', 50) -> nullable();
				$table -> string('Cont_Wattage_1ohm', 50) -> nullable();
				$table -> string('Dynamic_Wattage', 50) -> nullable();
				$table -> string('Max_Current_Draw_Amperage', 50) -> nullable();
				$table -> string('S_N_Ratio', 50) -> nullable();
				$table -> string('THD', 50) -> nullable();
				$table -> string('Input_Voltage_Sensitivity', 50) -> nullable();
				$table -> string('Pass_Through_Output', 50) -> nullable();
				$table -> string('Remote_Subwoofer_Control', 50) -> nullable();
				$table -> string('Power_Wire_Guage_In', 50) -> nullable();
				$table -> string('Speaker_Wire_Gauge_Out', 50) -> nullable();
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
			Schema ::dropIfExists('amplifires');
		}
	}
