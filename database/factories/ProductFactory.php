<?php
	
	use Faker\Generator as Faker;
	
	$factory -> define(App\Model\Product::class, function(Faker $faker) {
		return [
				'Name'        => $faker -> unique() -> jobTitle,
				'Description' => $faker -> text(2000),
				'Icon'       => $faker -> image($dir = '/tmp', $width = 640, $height = 480),
				'Background'       => $faker -> image($dir = '/tmp', $width = 640, $height = 480),
		];
	});
