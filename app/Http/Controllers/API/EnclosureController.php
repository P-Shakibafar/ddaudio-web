<?php
	
	namespace App\Http\Controllers\API;
	
	use App\Model\Enclosure;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	
	class EnclosureController extends Controller {
		
		/**
		 * Display a listing of the resource.
		 *
		 * @return \App\Model\Enclosure[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
		 */
		public function index()
		{
			return Enclosure ::all();
			
		}
		
		public function indexOfEnclosures($subSeriesName)
		{
			return Enclosure ::all() -> where('sub_series_name', $subSeriesName);
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
			
			return Enclosure ::create($request -> all());
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
		 * @param                           $Enclosure
		 * @return array
		 * @throws \Illuminate\Validation\ValidationException
		 */
		public function update(Request $request, $Enclosure)
		{
			$currentEnclosure = Enclosure ::findOrfail($Enclosure);
			$this -> validate($request, [
					'Model' => 'required|string|max:191',
			]);
			if($currentEnclosure !== NULL && !empty($currentEnclosure)) {
				$currentEnclosure -> update($request -> all());
				
				return ['message' => 'Updated the Enclosure info.'];
			}
			
			return ['message' => 'Updated Faild!);'];
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param $Enclosure
		 * @return array
		 */
		public function destroy($Enclosure)
		{
			$currentEnclosure = Enclosure ::findOrfail($Enclosure);
			if($currentEnclosure !== NULL && !empty($currentEnclosure)) {
				$currentEnclosure -> delete();
				
				return ['message' => 'Enclosure Deleted.'];
			}
			
			return ['message' => 'Enclosure Can\'t Deleted.'];
		}
	}
