<?php
	
	namespace App\Model;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Sub_Series extends Model {
		
		public $incrementing = FALSE;
		
		protected $primaryKey = 'Name';
		protected $table      = 'sub_series';
		protected $fillable   = [
				'Name',
				'Title',
				'Description',
				'Features',
				'series_name',
		];
		
		public function series()
		{
			return $this -> belongsTo(Series::class, 'series_name');
		}
		
		public function enclosoures()
		{
			return $this -> hasMany(Enclosure::class, 'sub_series_name');
		}
		
		public function subwoofers()
		{
			return $this -> hasMany(Subwoofer::class, 'sub_series_name');
		}
		
		public function images()
		{
			return $this -> hasMany(Image::class, 'sub_series_name');
		}
	}
