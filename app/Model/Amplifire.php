<?php
	
	namespace App\Model;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Amplifire extends Model {
		
		public $incrementing = FALSE;
		
		protected $primaryKey = 'Name';
		protected $fillable   = [
				'Name',
				'Title',
				'Description',
				'Test_Voltage',
				'Channels',
				'Cont_Wattage_4ohm',
				'Cont_Wattage_2ohm',
				'Cont_Wattage_1ohm',
				'Dynamic_Wattage',
				'Max_Current_Draw_Amperage',
				'S_N_Ratio',
				'THD',
				'Input_Voltage_Sensitivity',
				'Pass_Through_Output',
				'Remote_Subwoofer_Control',
				'Power_Wire_Guage_In',
				'Speaker_Wire_Gauge_Out',
				'Dimensions_in',
				'Dimensions_mm',
				'Shipping_Weight_lbs',
				'series_name'
		];
		
		public function series()
		{
			return $this -> belongsTo(Series::class, 'series_name');
		}
		
		public function images()
		{
			return $this -> hasMany(Image::class, 'amplifire_name');
		}
	}
