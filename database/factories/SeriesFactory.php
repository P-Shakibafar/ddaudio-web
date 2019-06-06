<?php
	
	use App\Model\Product;
	use Faker\Generator as Faker;
	
	$factory -> define(App\Model\Series::class, function(Faker $faker) {
		return [
				'Name'         => $faker -> unique() -> jobTitle,
				'Description'  => $faker -> text(2000),
				'product_name' => function() {
					return Product ::all() -> random() -> Name;
				},
		];
	});
