<?php
	
	namespace App\Model;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Enclosure extends Model {
		
		public $incrementing = FALSE;
		
		protected $primaryKey = 'Model';
		protected $fillable   = [
				'Model',
				'Driver_Size',
				'Watts_RMS',
				'VCD',
				'Impedance',
				'Dimensions_in',
				'Dimensions_mm',
				'Shipping_Weight_lbs',
				'sub_series_name',
		];
		
		public function sub_series()
		{
			return $this -> belongsTo(Sub_Series::class, 'sub_series_name');
		}
	}
