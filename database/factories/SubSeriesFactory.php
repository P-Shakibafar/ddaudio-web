<?php
	
	use App\Model\Series;
	use Faker\Generator as Faker;
	
	$factory -> define(App\Model\Sub_Series::class, function(Faker $faker) {
		return [
				'Name'        => $faker -> unique() -> jobTitle,
				'Title'       => $faker -> firstName,
				'Description' => $faker -> text(200),
				'Features'    => $faker -> sentence(6, TRUE),
				'series_name' => function() {
					return Series ::all()->where('product_name','Subwoofers') -> random() -> Name;
//					return Series ::all()->where('product_name','Enclosures') -> random() -> Name;
				},
		];
	});
