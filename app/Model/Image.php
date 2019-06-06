<?php
	
	namespace App\Model;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Image extends Model {
		protected $primaryKey='ID';
		protected $fillable = [
				'Path',
				'Name',
		];
		
		public function sub_series()
		{
			return $this -> belongsTo(Sub_Series::class,'sub_series_name');
		}
		
		public function amplifire()
		{
			return $this -> belongsTo(Amplifire::class,'amplifire_name');
		}
		
		public function signal_processor()
		{
			return $this -> belongsTo(Signal_Processor::class,'signal_processor_name');
		}
		
		public function speaker()
		{
			return $this -> belongsTo(Speaker::class,'speaker_name');
		}
	}
