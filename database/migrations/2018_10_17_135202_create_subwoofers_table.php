<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class CreateSubwoofersTable extends Migration {
		
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema ::create('subwoofers', function(Blueprint $table) {
				$table -> string('Model');
				$table -> primary('Model');
				$table -> string('Driver_Size', 50) -> nullable();
				$table -> string('Watts_RMS', 50) -> nullable();
				$table -> string('Peak_Power', 50) -> nullable();
				$table -> string('VCD', 50) -> nullable();
				$table -> string('Impedance', 50) -> nullable();
				$table -> string('Piston_Dia_in', 50) -> nullable();
				$table -> string('Fs_Hz', 50) -> nullable();
				$table -> string('Qms', 50) -> nullable();
				$table -> string('Qes', 50) -> nullable();
				$table -> string('Qts', 50) -> nullable();
				$table -> string('Vas_liters', 50) -> nullable();
				$table -> string('Xmech_mm', 50) -> nullable();
				$table -> string('Xmax_mm', 50) -> nullable();
				$table -> string('Frame_OD_in', 50) -> nullable();
				$table -> string('Frame_OD_w_Gasket_in', 50) -> nullable();
				$table -> string('Mounting_Diameter_in', 50) -> nullable();
				$table -> string('Mounting_Depth_in', 50) -> nullable();
				$table -> string('Motor_Diameter_in', 50) -> nullable();
				$table -> string('Motor_Depth_in', 50) -> nullable();
				$table -> string('Woofer_Displacement_cu_ft', 50) -> nullable();
				$table -> string('Shipping_Weight_lbs', 50) -> nullable();
				$table -> string('Sealed_Enclosure_cu_ft', 50) -> nullable();
				$table -> string('Ported_Enclosure_cu_ft', 50) -> nullable();
				$table -> timestamps();
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
			Schema ::dropIfExists('subwoofers');
		}
	}
