<?php
	
	use App\Model\Amplifire;
	use App\Model\Enclosure;
	use App\Model\Image;
	use App\Model\Product;
	use App\Model\Series;
	use App\Model\Signal_Processor;
	use App\Model\Speaker;
	use App\Model\Sub_Series;
	use App\Model\Sub_Speaker;
	use App\Model\Subwoofer;
	use Illuminate\Database\Seeder;
	
	class DatabaseSeeder extends Seeder {
		
		/**
		 * Seed the application's database.
		 *
		 * @return void
		 */
		public function run()
		{
			// $this->call(UsersTableSeeder::class);
//			factory(Product::class, 6) -> create();
//			factory(Series::class, 50) -> create();
//			factory(Sub_Series::class, 15) -> create();
//			factory(Speaker::class, 30) -> create();
//			factory(Sub_Speaker::class, 15) -> create();
			factory(Amplifire::class, 30) -> create();
//			factory(Signal_Processor::class, 10) -> create();
//			factory(Subwoofer::class, 40) -> create();
//			factory(Enclosure::class, 15) -> create();
//			factory(Image::class, 45) -> create();
		}
	}
