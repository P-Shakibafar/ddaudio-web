<?php
	
	namespace App\Http\Controllers\API;
	
	use App\Model\Subwoofer;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	
	class SubwooferController extends Controller {
		
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			//
		}
		
		public function indexOfSubwoofers($subSeriesName)
		{
			return Subwoofer ::all() -> where('sub_series_name', $subSeriesName);
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return \Illuminate\Http\Response
		 * @throws \Illuminate\Validation\ValidationException
		 */
		public function store(Request $request)
		{
			$this -> validate($request, [
					'Model' => 'required|string|max:191',
			]);
			
			return Subwoofer ::create($request -> all());
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 * @return \Illuminate\Http\Response
		 */
		public function show($id)
		{
			//
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param                           $Subwoofer
		 * @return array
		 * @throws \Illuminate\Validation\ValidationException
		 */
		public function update(Request $request, $Subwoofer)
		{
			$currentSubwoofer = Subwoofer ::findOrfail($Subwoofer);
			$this -> validate($request, [
					'Model' => 'required|string|max:191',
			]);
			if($currentSubwoofer !== NULL && !empty($currentSubwoofer)) {
				$currentSubwoofer -> update($request -> all());
				
				return ['message' => 'Updated the Subwoofer info.'];
			}
			
			return ['message' => 'Updated Faild!);'];
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param $Subwoofer
		 * @return array
		 */
		public function destroy($Subwoofer)
		{
			$currentSubwoofer = Subwoofer ::findOrfail($Subwoofer);
			if($currentSubwoofer !== NULL && !empty($currentSubwoofer)) {
				$currentSubwoofer -> delete();
				
				return ['message' => 'Subwoofer Deleted.'];
			}
			
			return ['message' => 'Subwoofer Can\'t Deleted.'];
		}
	}
