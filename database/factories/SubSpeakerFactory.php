<?php
	
	use App\Model\Speaker;
	use Faker\Generator as Faker;
	
	$factory -> define(App\Model\Sub_Speaker::class, function(Faker $faker) {
		return [
				'Driver Size'   => $faker -> numerify('## "'),
				'Fs_Hz'         => $faker -> numerify('##.##'),
				'Qms'           => $faker -> numerify('#.###'),
				'Qes'           => $faker -> numerify('0.###'),
				'Qts'           => $faker -> numerify('0.###'),
				'Vas_liters'    => $faker -> numerify('##.##'),
				'Dimensions_in' => $faker -> numerify('##*#*#'),
				'Dimensions_mm' => $faker -> numerify('###*###*##'),
				'speaker_name'  => function() {
					return Speaker ::all() -> random() -> Name;
				},
		];
	});
