<?php
	
	namespace App\Http\Controllers\API;
	
	use App\Model\Series;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	
	class SeriesController extends Controller {
		
		/**
		 * Display a listing of the resource.
		 *
		 * @return void
		 */
		public function index()
		{
		}
		
		/**
		 * Display a listing of product Name the resource.
		 *
		 * @param $productName
		 * @return \App\Model\Series[]|\Illuminate\Database\Eloquent\Collection
		 */
		public function indexOf($productName)
		{
			return Series ::all() -> where('product_name', $productName);
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
					'Name'        => 'required|string|max:191',
					'Description' => 'sometimes',
			]);
			
			return Series ::create([
					'Name'         => $request['Name'],
					'Description'  => $request['Description'],
					'product_name' => $request['product_name'],
			]);
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 * @return void
		 */
		public function show($id)
		{
			//
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param                           $series
		 * @return array
		 * @throws \Illuminate\Validation\ValidationException
		 */
		public function update(Request $request, $series)
		{
			$currentSeries = Series ::findOrfail($series);
			$this -> validate($request, [
					'Name'        => 'required|string|max:191',
					'Description' => 'sometimes',
			]);
			if($currentSeries !== NULL && !empty($currentSeries)) {
				$currentSeries -> update($request -> all());
				
				return ['message' => 'Updated the Series info.'];
			}
			
			return ['message' => 'Updated Faild!);'];
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param $series
		 * @return array
		 */
		public function destroy($series)
		{
			$currentSeries = Series ::findOrfail($series);
			if( !empty($currentSeries) && $currentSeries !== NULL) {
				$currentSeries -> delete();
				
				return ['message' => 'Series Deleted'];
			}
			
			return ['message' => 'Series Can\'t Deleted.'];
		}
	}
