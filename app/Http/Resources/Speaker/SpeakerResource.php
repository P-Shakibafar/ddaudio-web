<?php
	
	namespace App\Http\Resources\Speaker;
	
	use App\Http\Resources\Image\ImageResource;
	use App\Http\Resources\Sub_Speaker\Sub_SpeakerCollection;
	use App\Http\Resources\Sub_Speaker\Sub_SpeakerResource;
	use Illuminate\Http\Resources\Json\JsonResource;
	
	/**
	 * @property mixed Shipping_Weight_lbs
	 * @property mixed Mounting_Depth_in
	 * @property mixed Mounting_Diameter_in
	 * @property mixed dBSPL
	 * @property mixed Frequency_Response_Hz
	 * @property mixed Impedance
	 * @property mixed VCD
	 * @property mixed Watts_RMS
	 * @property mixed Description
	 * @property mixed Title
	 * @property mixed Name
	 * @property mixed sub_speaker
	 * @property mixed images
	 */
	class SpeakerResource extends JsonResource {
		
		/**
		 * Transform the resource into an array.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return array
		 */
		public function toArray($request)
		{
			return array(
					'Name'                    => $this -> Name,
					'Title'                   => $this -> Title,
					'Description'             => $this -> Description,
					'Watts RMS'               => $this -> Watts_RMS,
					'VCD'                     => $this -> VCD,
					'Impedance'               => $this -> Impedance,
					'Frequency Response - Hz' => $this -> Frequency_Response_Hz,
					'dBSPL'                   => $this -> dBSPL,
					'Mounting Diameter - in'  => $this -> Mounting_Diameter_in,
					'Mounting Depth - in'     => $this -> Mounting_Depth_in,
					'Shipping Weight - lbs'   => $this -> Shipping_Weight_lbs,
					'Sub_Speaker'             => $this -> findSub_Speaker(),
					'Images'                    => ImageResource ::collection($this -> images),
			);
		}
		
		public function findSub_Speaker()
		{
			if($this -> sub_speaker !== NULL && $this -> sub_speaker -> count() > 0) {
				return new Sub_SpeakerResource($this -> sub_speaker);
			}
			
			return NULL;
		}
	}
