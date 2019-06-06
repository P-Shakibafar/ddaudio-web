<?php
	
	use App\Model\Series;
	use Faker\Generator as Faker;
	
	$factory -> define(App\Model\Amplifire::class, function(Faker $faker) {
		return [
				'Name'                      => $faker -> unique() -> jobTitle,
				'Title'                     => $faker -> firstName,
				'Description'               => $faker -> text(2000),
				'Test_Voltage'              => $faker -> numerify('##.#'),
				'Channels'                  => $faker -> numerify('#'),
				'Cont_Wattage_4ohm'         => $faker -> numerify('###'),
				'Cont_Wattage_2ohm'         => $faker -> numerify('####'),
				'Cont_Wattage_1ohm'         => $faker -> numerify('####'),
				'Dynamic_Wattage'           => $faker -> numerify('####'),
				'Max_Current_Draw_Amperage' => $faker -> numerify('###'),
				'S_N_Ratio'                 => $faker -> numerify('>##dB'),
				'THD'                       => $faker -> numerify('<0.##%'),
				'Input_Voltage_Sensitivity' => $faker -> numerify('#V-0.##V'),
				'Pass_Through_Output'       => $faker -> boolean,
				'Remote_Subwoofer_Control'  => $faker -> boolean,
				'Power_Wire_Guage_In'       => $faker -> randomDigit,
				'Speaker_Wire_Gauge_Out'    => $faker -> numerify('#'),
				'Dimensions_in'             => $faker -> numerify('##*#*#'),
				'Dimensions_mm'             => $faker -> numerify('###*###*##'),
				'Shipping_Weight_lbs'       => $faker -> randomDigit,
				'series_name'               => function() {
					return Series ::all() -> where('product_name', 'Amplifiers') -> random() -> Name;
				},
		];
	});
