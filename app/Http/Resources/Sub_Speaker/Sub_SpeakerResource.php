<?php
	
	namespace App\Http\Resources\Sub_Speaker;
	
	use Illuminate\Http\Resources\Json\JsonResource;
	
	/**
	 * @property mixed Dimensions_mm
	 * @property mixed Dimensions_in
	 * @property mixed Vas_liters
	 * @property mixed Qts
	 * @property mixed Qes
	 * @property mixed Qms
	 * @property mixed Fs_Hz
	 * @property mixed Driver_Size
	 */
	class Sub_SpeakerResource extends JsonResource {
		
		/**
		 * Transform the resource into an array.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return array
		 */
		public function toArray($request)
		{
			return [
					'Driver Size'    => $this -> Driver_Size,
					'Fs - Hz'        => $this -> Fs_Hz,
					'Qms'            => $this -> Qms,
					'Qes'            => $this -> Qes,
					'Qts'            => $this -> Qts,
					'Vas - liters'   => $this -> Vas_liters,
					'Dimensions: in' => $this -> Dimensions_in,
					'Dimensions: mm' => $this -> Dimensions_mm,
			];
		}
	}
