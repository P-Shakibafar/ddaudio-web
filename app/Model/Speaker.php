<?php
	
	namespace App\Model;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Speaker extends Model {
		
		public $incrementing = FALSE;
		
		protected $primaryKey = 'Name';
		protected $fillable   = [
				'Name',
				'Title',
				'Description',
				'Watts_RMS',
				'VCD',
				'Impedance',
				'Frequency_Response_Hz',
				'dBSPL',
				'Mounting_Diameter_in',
				'Mounting_Depth_in',
				'Shipping_Weight_lbs',
				'series_name',
		];
		
		public function series()
		{
			return $this -> belongsTo(Series::class, 'series_name');
		}
		
		public function sub_speaker()
		{
			return $this -> hasOne(Sub_Speaker::class, 'speaker_name');
		}
		
		public function images()
		{
			return $this -> hasMany(Image::class, 'speaker_name');
		}
	}
