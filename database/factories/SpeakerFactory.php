<?php
	
	use App\Model\Series;
	use Faker\Generator as Faker;
	
	$factory -> define(App\Model\Speaker::class, function(Faker $faker) {
		return [
				'Name'                  => $faker -> unique() -> jobTitle,
				'Title'                 => $faker -> firstName,
				'Description'           => $faker -> text(2000),
				'Watts_RMS'             => $faker -> phoneNumber,
				'VCD'                   => $faker -> numberBetween(1, 5),
				'Impedance'             => $faker -> numerify('S #'),
				'Frequency_Response_Hz' => $faker -> numerify('### k'),
				'dBSPL'                 => $faker -> randomDigit,
				'Mounting_Diameter_in'  => $faker -> numerify('# ##/##'),
				'Mounting_Depth_in'     => $faker -> numerify('# ##/##'),
				'Shipping_Weight_lbs'   => $faker -> randomDigit,
				'series_name'             => function() {
					return Series ::all() -> where('product_name', 'Speakers') -> random() -> Name;
				},
		];
	});
