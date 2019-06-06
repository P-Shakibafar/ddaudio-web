<?php
	
	namespace App\Http\Resources\Speaker;
	
	use Illuminate\Http\Resources\Json\Resource;
	
	/**
	 * @property mixed Name
	 * @property mixed series_name
	 * @property mixed series
	 */
	class SpeakerCollection extends Resource {
		
		/**
		 * Transform the resource collection into an array.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return array
		 */
		public function toArray($request)
		{
			return [
					'name' => $this -> Name,
					'image' => $this -> images -> first() -> Path ?? NULL,
					'href' => [
							'link' => route('products.series.speakers.show',
									[$this -> series -> product_name, $this -> series_name, $this -> Name]),
					],
			];
		}
	}
