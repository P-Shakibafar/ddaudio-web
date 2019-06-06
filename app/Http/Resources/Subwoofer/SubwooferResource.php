<?php
	
	namespace App\Http\Resources\Subwoofer;
	
	use Illuminate\Http\Resources\Json\JsonResource;
	
	/**
	 * @property mixed Ported_Enclosure_cu_ft
	 * @property mixed Sealed_Enclosure_cu_ft
	 * @property mixed Shipping_Weight_lbs
	 * @property mixed Woofer_Displacement_cu_ft
	 * @property mixed Motor_Depth_in
	 * @property mixed Motor_Diameter_in
	 * @property mixed Mounting_Depth_in
	 * @property mixed Mounting_Diameter_in
	 * @property mixed Frame_OD_w_Gasket_in
	 * @property mixed Frame_OD_in
	 * @property mixed Xmax_mm
	 * @property mixed Xmech_mm
	 * @property mixed Vas_liters
	 * @property mixed Qts
	 * @property mixed Qes
	 * @property mixed Qms
	 * @property mixed Fs_Hz
	 * @property mixed Piston_Dia_in
	 * @property mixed Impedance
	 * @property mixed VCD
	 * @property mixed Peak_Power
	 * @property mixed Watts_RMS
	 * @property mixed Driver_Size
	 * @property mixed Model
	 */
	class SubwooferResource extends JsonResource {
		
		/**
		 * Transform the resource into an array.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return array
		 */
		public function toArray($request)
		{
			return [
					'Model'                       => $this -> Model,
					'Driver Size'                 => $this -> Driver_Size,
					'Watts RMS'                   => $this -> Watts_RMS,
					'Peak Power'                  => $this -> Peak_Power,
					'VCD'                         => $this -> VCD,
					'Impedance'                   => $this -> Impedance,
					'Piston Dia - in'             => $this -> Piston_Dia_in,
					'Fs - Hz'                     => $this -> Fs_Hz,
					'Qms'                         => $this -> Qms,
					'Qes'                         => $this -> Qes,
					'Qts'                         => $this -> Qts,
					'Vas - liters'                => $this -> Vas_liters,
					'Xmech - mm'                  => $this -> Xmech_mm,
					'Xmax - mm'                   => $this -> Xmax_mm,
					'Frame OD - in'               => $this -> Frame_OD_in,
					'Frame OD w/Gasket - in'      => $this -> Frame_OD_w_Gasket_in,
					'Mounting Diameter - in'      => $this -> Mounting_Diameter_in,
					'Mounting Depth - in'         => $this -> Mounting_Depth_in,
					'Motor Diameter - in'         => $this -> Motor_Diameter_in,
					'Motor Depth - in'            => $this -> Motor_Depth_in,
					'Woofer Displacement - cu ft' => $this -> Woofer_Displacement_cu_ft,
					'Shipping Weight - lbs'       => $this -> Shipping_Weight_lbs,
					'Sealed Enclosure - cu ft'    => $this -> Sealed_Enclosure_cu_ft,
					'Ported Enclosure - cu ft'    => $this -> Ported_Enclosure_cu_ft,
			];
		}
	}
