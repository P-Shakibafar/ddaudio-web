<?php
	
	use App\Model\Sub_Series;
	use Faker\Generator as Faker;
	
	$factory -> define(App\Model\Subwoofer::class, function(Faker $faker) {
		return [
				'Model'                     => $faker -> numerify('###'),
				'Driver_Size'               => $faker -> numerify('## "'),
				'Watts_RMS'                 => $faker -> phoneNumber,
				'Peak_Power'                => $faker -> numerify('###'),
				'VCD'                       => $faker -> numberBetween(1, 5),
				'Impedance'                 => $faker -> numerify('D#'),
				'Piston_Dia_in'             => $faker -> numerify('##'),
				'Fs_Hz'                     => $faker -> numerify('##.##'),
				'Qms'                       => $faker -> numerify('#.###'),
				'Qes'                       => $faker -> numerify('0.###'),
				'Qts'                       => $faker -> numerify('0.###'),
				'Vas_liters'                => $faker -> numerify('##.##'),
				'Xmech_mm'                  => $faker -> numerify('##'),
				'Xmax_mm'                   => $faker -> numerify('##'),
				'Frame_OD_in'               => $faker -> numerify('## #/#'),
				'Frame_OD_w_Gasket_in'      => $faker -> numerify('## #/#'),
				'Mounting_Diameter_in'      => $faker -> numerify('# ##/##'),
				'Mounting_Depth_in'         => $faker -> numerify('# ##/##'),
				'Motor_Diameter_in'         => $faker -> numerify('# ##/##'),
				'Motor_Depth_in'            => $faker -> numerify('#'),
				'Woofer_Displacement_cu_ft' => $faker -> numerify('0.0#'),
				'Shipping_Weight_lbs'       => $faker -> randomDigit,
				'Sealed_Enclosure_cu_ft'    => $faker -> numerify('0.# - 0.#'),
				'Ported_Enclosure_cu_ft'    => $faker -> numerify('#.## - #.##'),
				'sub_series_name'           => function() {
					return Sub_Series ::all() -> random() -> Name;
				},
		];
	});
