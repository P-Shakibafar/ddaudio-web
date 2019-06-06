<?php

namespace App\Http\Resources\Image;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @property mixed ID
 * @property mixed ImgName
 * @property mixed Path
 */
class ImageCollection extends Resource {
	
	/**
	 * Transform the resource collection into an array.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
				'Path'    => $this -> Path,
				'ImgName' => $this -> ImgName,
				'href'    => [
						'link' => route('images.show', $this -> ID),
				],
		];
	}
}
