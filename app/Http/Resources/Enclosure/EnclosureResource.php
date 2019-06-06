<?php
	
	namespace App\Http\Resources\Enclosure;
	
	use App\Http\Resources\Image\ImageResource;
	use Illuminate\Http\Resources\Json\JsonResource;
	
	/**
	 * @property mixed Shipping_Weight_lbs
	 * @property mixed Dimensions_in
	 * @property mixed Impedance
	 * @property mixed VCD
	 * @property mixed Watts_RMS
	 * @property mixed Driver_Size
	 * @property mixed Model
	 * @property mixed images
	 * @property mixed Dimensions_mm
	 */
	class EnclosureResource extends JsonResource {
		
		/**
		 * Transform the resource into an array.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return array
		 */
		public function toArray($request)
		{
			return [
					'Model'                 => $this -> Model,
					'Driver Size'           => $this -> Driver_Size,
					'Watts RMS'             => $this -> Watts_RMS,
					'VCD'                   => $this -> VCD,
					'Impedance'             => $this -> Impedance,
					'Dimensions: in'        => $this -> Dimensions_in,
					'Dimensions: mm'        => $this -> Dimensions_mm,
					'Shipping Weight - lbs' => $this -> Shipping_Weight_lbs,
			];
		}
	}
