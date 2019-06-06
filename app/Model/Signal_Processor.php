<?php
	
	namespace App\Model;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Signal_Processor extends Model {
		
		public $incrementing = FALSE;
		
		protected $primaryKey = 'Name';
		protected $table      = 'signal_processors';
		protected $fillable   = [
				'Name',
				'Title',
				'Description',
				'Channels',
				'Input_Voltage_Sensitivity',
				'Input_Channels',
				'Output_Channels',
				'Output_Voltage',
				'Dimensions_in',
				'Dimensions_mm',
				'Shipping_Weight_lbs',
				'series_name',
		];
		
		public function series()
		{
			return $this -> belongsTo(Series::class, 'series_name');
		}
		
		public function images()
		{
			return $this -> hasMany(Image::class, 'signal_processor_name');
		}
	}
