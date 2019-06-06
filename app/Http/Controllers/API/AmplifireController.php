<?php
    
    namespace App\Http\Controllers\API;
    
    use App\Model\Amplifire;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Pagination\LengthAwarePaginator;
    use App\Http\Resources\Amplifire\AmplifireResource;
    
    class AmplifireController extends Controller {
        
        /**
         * Display a listing of the resource.
         *
         * @param \Illuminate\Http\Request $request
         * @return array
         */
        public function index(Request $request)
        {
            $amplifires = Amplifire ::with('images') -> get();
            $data       = array();
            foreach($amplifires as $amplifire) {
                $data[] = array(
                    'Name'        => $amplifire['Name'],
                    'image'       => $amplifire -> images[0]['Path'] ?? '',
                    //							'hover_image' => $amplifire -> images[1]['Path'] ?? '',
                    'series_name' => $amplifire['series_name'],
                );
            }
//			// Get current page form url e.x. &page=1
//			$currentPage = LengthAwarePaginator ::resolveCurrentPage();
//			// Create a new Laravel collection from the array data
//			$productCollection = collect($data);
//			// Define how many products we want to be visible in each page
//			$perPage = 12;
//			// Slice the collection to get the products to display in current page
//			$currentPageproducts = $productCollection -> slice(($currentPage * $perPage) - $perPage, $perPage) -> all();
//			// Create our paginator and pass it to the view
//			$paginatedproducts = new LengthAwarePaginator($currentPageproducts, \count($productCollection), $perPage);
//			// set url path for generted links
//			$paginatedproducts -> setPath($request -> url());
//
//			return $paginatedproducts;
            return $data;
        }
        
        /**
         * Display a listing of series Name the resource.
         *
         * @param $seriesName
         * @return array
         */
        public function indexOf($seriesName)
        {
            return Amplifire ::with('images') -> where('series_name', $seriesName) -> get();
        }
        
        public function search()
        {
            if($search = \Request ::get('q')) {
                $amplifires = Amplifire ::with('images')
                                        -> where(
                                            function($query) use ($search) {
                                                $query -> where('Name', 'LIKE', "%$search%")
                                                       -> orWhere('series_name', 'LIKE', "%$search%");
                                            }) -> get();
                $data       = array();
                foreach($amplifires as $amplifire) {
                    $data[] = array(
                        'Name'        => $amplifire['Name'],
                        'image'       => $amplifire -> images[0]['Path'] ?? '',
                        //							'hover_image' => $amplifire -> images[1]['Path'] ?? '',
                        'series_name' => $amplifire['series_name'],
                    );
                }
            } else {
                $amplifires = Amplifire ::with('images') -> get();
                $data       = array();
                foreach($amplifires as $amplifire) {
                    $data[] = array(
                        'Name'        => $amplifire['Name'],
                        'image'       => $amplifire -> images[0]['Path'] ?? '',
                        //							'hover_image' => $amplifire -> images[1]['Path'] ?? '',
                        'series_name' => $amplifire['series_name'],
                    );
                }
            }
            
            return $data;
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
                'Title'       => 'required|string|max:191',
                'Description' => 'required',
            ]);
            
            return Amplifire ::create($request -> all());
        }
        
        public function addPhotos(Request $request, $Amplifire)
        {
            $this -> validate($request, [
                'file' => 'required|mimes:jpg,jpeg,bmp,png',
            ]);
            if($request -> file('file')) {
                $image       = $request -> file('file');
                $currentName = $image -> getClientOriginalName();
                $name        = time() . $image -> getClientOriginalName();
                $image -> move(public_path() . '/images/Amplifires/', $name);
            }
            $currentAmplifire = Amplifire ::findOrfail($Amplifire);
            if($currentAmplifire !== NULL && !empty($currentAmplifire)) {
                $currentAmplifire -> images() -> create([
                    'Path' => "/images/Amplifires/{$name}",
                    'Name' => $currentName,
                ]);
                
                return response() -> json(['success' => 'You have successfully uploaded an image'], 200);
            }
            
            return response() -> json(['faild' => 'You have faild uploaded an image'], 500);
        }
        
        /**
         * Display the specified resource.
         *
         * @param $Amplifier
         * @return \App\Http\Resources\Amplifire\AmplifireResource
         */
        public function show(Amplifire $Amplifier)
        {
            return new AmplifireResource($Amplifier);
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param                           $Amplifire
         * @return array
         * @throws \Illuminate\Validation\ValidationException
         */
        public function update(Request $request, $Amplifire)
        {
            $currentAmplifire = Amplifire ::findOrFail($Amplifire);
            $this -> validate($request, [
                'Name'        => 'required|string|max:191',
                'Title'       => 'required|string|max:191',
                'Description' => 'required',
            ]);
            if($currentAmplifire !== NULL && !empty($currentAmplifire)) {
                $currentAmplifire -> update($request -> all());
                
                return ['message' => 'Updated the Amplifire info.'];
            }
            
            return ['message' => 'Updated Faild!);'];
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param $Amplifire
         * @return array
         */
        public function destroy($Amplifire)
        {
            $currentAmplifire = Amplifire ::findOrFail($Amplifire);
            if($currentAmplifire !== NULL && !empty($currentAmplifire)) {
                $currentAmplifire -> delete();
                
                return ['message' => 'Amplifire Deleted.'];
            }
            
            return ['message' => 'Amplifire Can\'t Deleted.'];
        }
    }
