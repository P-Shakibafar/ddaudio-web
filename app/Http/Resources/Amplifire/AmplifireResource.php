<?php
	
	namespace App\Http\Resources\Amplifire;
	
	use App\Http\Resources\Image\ImageResource;
	use Illuminate\Http\Resources\Json\JsonResource;
	
	/**
	 * @property mixed Shipping_Weight_lbs
	 * @property mixed Dimensions_mm
	 * @property mixed Dimensions_in
	 * @property mixed Speaker_Wire_Gauge_Out
	 * @property mixed Power_Wire_Guage_In
	 * @property mixed Remote_Subwoofer_Control
	 * @property mixed Pass_Through_Output
	 * @property mixed Input_Voltage_Sensitivity
	 * @property mixed THD
	 * @property mixed S_N_Ratio
	 * @property mixed Max_Current_Draw_Amperage
	 * @property mixed Dynamic_Wattage
	 * @property mixed Cont_Wattage_1ohm
	 * @property mixed Cont_Wattage_2ohm
	 * @property mixed Cont_Wattage_4ohm
	 * @property mixed Channels
	 * @property mixed Test_Voltage
	 * @property mixed Description
	 * @property mixed Title
	 * @property mixed Name
	 * @property mixed images
	 */
	class AmplifireResource extends JsonResource {
		
		/**
		 * Transform the resource into an array.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return array
		 */
		public function toArray($request)
		{
			return [
					'Name'                        => $this -> Name,
					'Title'                       => $this -> Title,
					'Description'                 => $this -> Description,
					'Test Voltage'                => $this -> Test_Voltage,
					'Channels'                    => $this -> Channels,
					'Cont Wattage @ 4ohm'         => $this -> Cont_Wattage_4ohm,
					'Cont Wattage @ 2ohm'         => $this -> Cont_Wattage_2ohm,
					'Cont Wattage @ 1ohm'         => $this -> Cont_Wattage_1ohm,
					'Dynamic Wattage'             => $this -> Dynamic_Wattage,
					'Max Current Draw - Amperage' => $this -> Max_Current_Draw_Amperage,
					'S / N Ratio'                 => $this -> S_N_Ratio,
					'THD'                         => $this -> THD,
					'Input Voltage Sensitivity'   => $this -> Input_Voltage_Sensitivity,
					'Pass - Through Output'       => $this -> Pass_Through_Output,
					'Remote Subwoofer Control'    => $this -> Remote_Subwoofer_Control,
					'Power Wire Guage In'         => $this -> Power_Wire_Guage_In,
					'Speaker Wire Gauge Out'      => $this -> Speaker_Wire_Gauge_Out,
					'Dimensions: in'              => $this -> Dimensions_in,
					'Dimensions: mm'              => $this -> Dimensions_mm,
					'Shipping Weight - lbs'       => $this -> Shipping_Weight_lbs,
					'Images'                      => ImageResource ::collection($this -> images),
			];
		}
	}
