<?php

namespace App\Http\Resources\Series;

use App\Http\Resources\Amplifire\AmplifireCollection;
use App\Http\Resources\Amplifire\AmplifireResource;
use App\Http\Resources\Signal_Processor\Signal_ProcessorCollection;
use App\Http\Resources\Speaker\SpeakerCollection;
use App\Http\Resources\Sub_Series\Sub_SeriesCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed Name
 * @property mixed Description
 * @property mixed Image
 * @property mixed amplifires
 * @property mixed product_name
 * @property mixed category
 * @property mixed signal_processors
 * @property mixed speakers
 * @property mixed sub_series
 */
class SeriesResource extends JsonResource {
	
	/**
	 * Transform the resource into an array.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return array(
				'name'        => $this -> Name,
				'description' => $this -> Description,
				'href'        => $this -> findHref(),
		);
	}
	
	public function findHref()
	{
		if($this -> amplifires -> count() > 0) {
			return [
					'link' => route('products.series.amplifires.index',
							[$this -> product_name, $this -> Name]),
			];
		}
		if($this -> signal_processors -> count() > 0) {
			return [
					'link' => route('products.series.signal_processors.index',
							[$this -> product_name, $this -> Name]),
			];
		}
		if($this -> speakers -> count() > 0) {
			return [
					'link' => route('products.series.speakers.index',
							[$this -> product_name, $this -> Name]),
			];
		}
		if($this -> sub_series -> count() > 0) {
			return [
					'link' => route('products.series.sub_series.index',
							[$this -> product_name, $this -> Name]),
			];
		}
		
		return NULL;
	}
	
}
