<?php
	
	namespace App\Model;
	
	use Illuminate\Database\Eloquent\Model;
	
	/**
	 * @property mixed amplifires
	 * @property mixed sub_series
	 * @property mixed speakers
	 * @property mixed signal_processors
	 * @property mixed category
	 */
	class Series extends Model {
		
		public $incrementing = FALSE;
		
		protected $primaryKey = 'Name';
		protected $fillable   = [
				'Name', 'Description', 'product_name',
		];
		
		public function product()
		{
			return $this -> belongsTo(Product::class);
		}
		
		public function sub_series()
		{
			return $this -> hasMany(Sub_Series::class,'series_name');
		}
		
		public function amplifires()
		{
			return $this -> hasMany(Amplifire::class,'series_name');
		}
		
		public function signal_processors()
		{
			return $this -> hasMany(Signal_Processor::class,'series_name');
		}
		
		public function speakers()
		{
			return $this -> hasMany(Speaker::class,'series_name');
		}
	}
