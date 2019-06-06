<?php
	
	namespace App\Model;
	
	use Illuminate\Database\Eloquent\Model;
	
	/**
	 * @property mixed series
	 */
	class Product extends Model {
		
		public $incrementing = FALSE;
		
		protected $primaryKey = 'Name';
		protected $fillable   = [
				'Name', 'Description', 'Icon', 'Background',
		];
		
		public function series()
		{
			
			return $this -> hasMany(Series::class);
		}
	}
