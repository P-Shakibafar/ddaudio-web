<?php
	
	namespace App\Model;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Sub_Speaker extends Model {
		
		protected $table    = 'sub_speakers';
		protected $fillable = [
				'Driver_Size',
				'Fs_Hz',
				'Qms',
				'Qes',
				'Qts',
				'Vas_liters',
				'Dimensions_in',
				'Dimensions_mm',
		];
		
		public function speaker()
		{
			return $this -> belongsTo(Speaker::class, 'speaker_name');
		}
	}
