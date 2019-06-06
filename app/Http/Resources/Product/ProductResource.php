<?php
	
	namespace App\Http\Resources\Product;
	
	use App\Http\Resources\Series\SeriesResource;
	use Illuminate\Http\Resources\Json\JsonResource;
	use function route;
	
	/**
	 * @property mixed Name
	 * @property mixed Description
	 * @property mixed Image
	 * @property mixed series
	 */
	class ProductResource extends JsonResource {
		
		/**
		 * Transform the resource into an array.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return array
		 */
		public function toArray($request)
		{
			return [
					'name'        => $this -> Name,
					'description' => $this -> Description,
					'image'       => $this -> Icon,
					'background'    =>$this->Background,
					'href'        => [
                    						'link' => route('products.series.index', $this -> Name),
                    				],
			];
		}
	}
