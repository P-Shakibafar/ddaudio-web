<?php

namespace App\Http\Resources\Sub_Series;

use App\Http\Resources\Enclosure\EnclosureCollection;
use App\Http\Resources\Enclosure\EnclosureResource;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Subwoofer\SubwooferCollection;
use App\Http\Resources\Subwoofer\SubwooferResource;
use App\Model\Enclosure;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed Features
 * @property mixed Description
 * @property mixed Title
 * @property mixed Name
 * @property mixed subwoofers
 * @property mixed enclosoures
 * @property mixed images
 */
class Sub_SeriesResource extends JsonResource {
	
	/**
	 * Transform the resource into an array.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
				'Name'        => $this -> Name,
				'Title'       => $this -> Title,
				'Description' => $this -> Description,
				'Features'    => $this -> Features,
				'Sub Series'  => $this -> findHref(),
				'Images'      => ImageResource ::collection($this -> images),
		];
	}
	
	public function findHref()
	{
		if($this -> subwoofers -> count() > 0) {
			return array(
					SubwooferResource ::collection($this -> subwoofers),
			);
		}
		if($this -> enclosoures -> count() > 0) {
			return array(
					EnclosureResource ::collection($this -> enclosoures),
			);
		}
		
		return NULL;
	}
}
