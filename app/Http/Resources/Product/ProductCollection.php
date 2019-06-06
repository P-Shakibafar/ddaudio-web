<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Series\SeriesResource;
use Illuminate\Http\Resources\Json\Resource;
use function route;

/**
 * @property mixed Name
 * @property mixed Description
 * @property mixed Image
 * @property mixed series
 */
class ProductCollection extends Resource {
	
	/**
	 * Transform the resource collection into an array.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
				'name'        => $this -> Name,
				'description' => $this -> Description,
				'background'  => $this -> Background,
				'image'       => $this -> Icon,
				'href'        => [
						'link' => route('products.show', $this -> Name),
				],
		];
	}
}
