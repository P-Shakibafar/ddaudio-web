<?php
	
	namespace App\Http\Resources\Image;
	
	use Illuminate\Http\Resources\Json\JsonResource;
	
	/**
	 * @property mixed Path
	 * @property mixed Name
	 */
	class ImageResource extends JsonResource {
		
		/**
		 * Transform the resource into an array.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return array
		 */
		public function toArray($request)
		{
			return [
					'Path'    => $this -> Path,
					'Name' => $this -> Name,
			];
		}
	}
