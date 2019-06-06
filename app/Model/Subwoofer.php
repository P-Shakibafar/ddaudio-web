<?php
	
	namespace App\Model;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Subwoofer extends Model {
		
		public $incrementing = FALSE;
		
		protected $primaryKey = 'Model';
		protected $fillable   = [
				'Model',
				'Driver_Size',
				'Watts_RMS',
				'Peak_Power',
				'VCD',
				'Impedance',
				'Piston_Dia_in',
				'Fs_Hz',
				'Qms',
				'Qes',
				'Qts',
				'Vas_liters',
				'Xmech_mm',
				'Xmax_mm',
				'Frame_OD_in',
				'Frame_OD_w_Gasket_in',
				'Mounting_Diameter_in',
				'Mounting_Depth_in',
				'Motor_Diameter_in',
				'Motor_Depth_in',
				'Woofer_Displacement_cu_ft',
				'Shipping_Weight_lbs',
				'Sealed_Enclosure_cu_ft',
				'Ported_Enclosure_cu_ft',
				'sub_series_name',
		];
		
		public function sub_series()
		{
			return $this -> belongsTo(Sub_Series::class, 'sub_seies_name');
		}
	}
