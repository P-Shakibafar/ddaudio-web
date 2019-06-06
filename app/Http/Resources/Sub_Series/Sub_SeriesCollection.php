<?php

namespace App\Http\Resources\Sub_Series;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @property mixed Name
 * @property mixed series_name
 * @property mixed series
 */
class Sub_SeriesCollection extends Resource {
	
	/**
	 * Transform the resource collection into an array.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
				'name'  => $this -> Name,
				'image' => $this -> images -> first() -> Path ?? NULL,
				'href'  => [
						'link' => route('products.series.sub_series.show',
								[$this -> series -> product_name, $this -> series_name, $this -> Name]),
				],
		];
	}
}
