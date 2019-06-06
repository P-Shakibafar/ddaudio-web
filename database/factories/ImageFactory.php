<?php
	
	use App\Model\Amplifire;
	use App\Model\Signal_Processor;
	use App\Model\Speaker;
	use App\Model\Sub_Series;
	use Faker\Generator as Faker;
	
	$factory -> define(App\Model\Image::class, function(Faker $faker) {
		return [
				'Path'                  => $faker -> imageUrl($width = 640, $height = 480),
				'ImgName'               => $faker -> colorName,
//				'amplifire_name'        => function() {
//					return Amplifire ::all() -> random() -> Name;
//				},
//				'speaker_name'          => function() {
//					return Speaker ::all() -> random() -> Name;
//				},
//				'signal_processor_name' => function() {
//					return Signal_Processor ::all() -> random() -> Name;
//				},
				'sub_series_name'       => function() {
					return Sub_Series ::all() -> random() -> Name;
				},
		];
	});
