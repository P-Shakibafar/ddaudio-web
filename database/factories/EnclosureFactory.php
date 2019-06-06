<?php
	
	use App\Model\Sub_Series;
	use Faker\Generator as Faker;
	
	$factory -> define(App\Model\Enclosure::class, function(Faker $faker) {
		return [
				'Model'                 => $faker -> numerify('###'),
				'Driver_Size'           => $faker -> numerify('## "'),
				'Watts_RMS'             => $faker -> phoneNumber,
				'VCD'                   => $faker -> numberBetween(1, 5),
				'Impedance'             => $faker -> numerify('D#'),
				'Dimensions_in'        => $faker -> numerify('##*#*#'),
				'Dimensions_mm'        => $faker -> numerify('###*###*##'),
				'Shipping_Weight_lbs' => $faker -> randomDigit,
				'sub_series_name'       => function() {
					return Sub_Series ::all() -> random() -> Name;
				},
		];
	});
