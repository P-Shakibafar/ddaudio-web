<?php
	
	use App\Model\Series;
	use Faker\Generator as Faker;
	
	$factory -> define(App\Model\Signal_Processor::class, function(Faker $faker) {
		return [
				'Name'                      => $faker -> unique() -> jobTitle,
				'Title'                     => $faker -> firstName,
				'Description'               => $faker -> text(2000),
				'Channels'                  => $faker -> numerify('#'),
				'Input_Voltage_Sensitivity' => $faker -> numerify('#V-0.##V'),
				'Input_Channels'            => $faker -> numerify('#'),
				'Output_Channels'           => $faker -> numerify('#'),
				'Output_Voltage'            => $faker -> numerify('##V'),
				'Dimensions_in'             => $faker -> numerify('##*#*#'),
				'Dimensions_mm'             => $faker -> numerify('###*###*##'),
				'Shipping_Weight_lbs'       => $faker -> randomDigit,
				'series_name'               => function() {
					return Series ::all() -> where('product_name', 'Signal_Processors') -> random() -> Name;
				},
		];
	});
