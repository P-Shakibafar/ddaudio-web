<?php
	
	namespace App\Http\Resources\Signal_Processor;
	
	use App\Http\Resources\Image\ImageResource;
	use Illuminate\Http\Resources\Json\JsonResource;
	
	/**
	 * @property mixed Shipping_Weight_lbs
	 * @property mixed Dimensions_mm
	 * @property mixed Dimensions_in
	 * @property mixed Output_Voltage
	 * @property mixed Output_Channels
	 * @property mixed Input_Channels
	 * @property mixed Input_Voltage_Sensitivity
	 * @property mixed Channels
	 * @property mixed Description
	 * @property mixed Title
	 * @property mixed Name
	 * @property mixed images
	 */
	class Signal_ProcessorResource extends JsonResource {
		
		/**
		 * Transform the resource into an array.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return array
		 */
		public function toArray($request)
		{
			return [
					'Name'                      => $this -> Name,
					'Title'                     => $this -> Title,
					'Description'               => $this -> Description,
					'Channels'                  => $this -> Channels,
					'Input Voltage Sensitivity' => $this -> Input_Voltage_Sensitivity,
					'Input Channels'            => $this -> Input_Channels,
					'Output Channels'           => $this -> Output_Channels,
					'Output Voltage'            => $this -> Output_Voltage,
					'Dimensions: in'            => $this -> Dimensions_in,
					'Dimensions: mm'            => $this -> Dimensions_mm,
					'Shipping Weight - lbs'     => $this -> Shipping_Weight_lbs,
					'Images'                    => ImageResource ::collection($this -> images),
			];
		}
	}
