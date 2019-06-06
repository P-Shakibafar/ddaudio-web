<?php
    
    namespace App\Http\Controllers\API;
    
    use App\Http\Resources\Sub_Series\Sub_SeriesResource;
    use App\Model\Sub_Series;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Pagination\LengthAwarePaginator;
    
    class SubSeriesController extends Controller {
        
        /**
         * Display a listing of the resource.
         *
         * @return \App\Model\Sub_Series[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
         */
        public function index()
        {
            return Sub_Series ::with(['images', 'series']) -> get();
        }
        
        /**
         * Display a listing of product name the resource.
         *
         * @param \Illuminate\Http\Request $request
         * @param                          $productName
         * @return \App\Model\Sub_Series[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
         */
        public function indexOf(Request $request, $productName)
        {
            $subSeries = Sub_Series ::with(['series', 'images']) -> get();
            $data      = array();
            foreach($subSeries as $sub) {
                if($sub -> series -> product_name === $productName) {
                    $data[] = array(
                        'Name'        => $sub['Name'],
                        'image'       => $sub -> images[0]['Path'],
                        //							'hover_image' => $sub -> images[1]['Path'] ?? '',
                        'series_name' => $sub['series_name'],
                    );
                }
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
        
        public function search($productName)
        {
            if($search = \Request ::get('q')) {
                $subSeries = Sub_Series ::with('series', 'images')
                                        -> where(
                                            function($query) use ($search) {
                                                $query -> where('Name', 'LIKE', "%$search%")
                                                       -> orWhere('series_name', 'LIKE', "%$search%");
                                            }) -> get();
                $data      = array();
                foreach($subSeries as $sub) {
                    if($sub -> series -> product_name === $productName) {
                        $data[] = array(
                            'Name'        => $sub['Name'],
                            'image'       => $sub -> images[0]['Path'],
                            //							'hover_image' => $sub -> images[1]['Path'] ?? '',
                            'series_name' => $sub['series_name'],
                        );
                    }
                }
            } else {
                $subSeries = Sub_Series ::with(['series', 'images']) -> get();
                $data      = array();
                foreach($subSeries as $sub) {
                    if($sub -> series -> product_name === $productName) {
                        $data[] = array(
                            'Name'        => $sub['Name'],
                            'image'       => $sub -> images[0]['Path'],
                            //							'hover_image' => $sub -> images[1]['Path'] ?? '',
                            'series_name' => $sub['series_name'],
                        );
                    }
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
                'series_name' => 'sometimes',
            ]);
            
            return Sub_Series ::create($request -> all());
        }
        
        /**
         * Store a newly images by subwoofer in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param                           $Subwoofer
         * @return \Illuminate\Http\Response
         * @throws \Illuminate\Validation\ValidationException
         */
        public function SubwooferAddPhotos(Request $request, $Subwoofer)
        {
            $this -> validate($request, [
                'file' => 'required|mimes:jpg,jpeg,bmp,png',
            ]);
            if($request -> file('file')) {
                $image       = $request -> file('file');
                $currentName = $image -> getClientOriginalName();
                $name        = time() . $image -> getClientOriginalName();
                $image -> move(public_path() . '/images/Subwoofers/', $name);
            }
            $currentSubwoofer = Sub_Series ::findOrfail($Subwoofer);
            if($currentSubwoofer !== NULL && !empty($currentSubwoofer)) {
                $currentSubwoofer -> images() -> create([
                    'Path' => "/images/Subwoofers/{$name}",
                    'Name' => $currentName,
                ]);
                
                return response() -> json(['success' => 'You have successfully uploaded an image'], 200);
            }
            
            return response() -> json(['faild' => 'You have faild uploaded an image'], 500);
        }
        
        /**
         * Store a newly images by Enclosure in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param                           $Enclosure
         * @return \Illuminate\Http\Response
         * @throws \Illuminate\Validation\ValidationException
         */
        public function EnclosureAddPhotos(Request $request, $Enclosure)
        {
            $this -> validate($request, [
                'file' => 'required|mimes:jpg,jpeg,bmp,png',
            ]);
            if($request -> file('file')) {
                $image       = $request -> file('file');
                $currentName = $image -> getClientOriginalName();
                $name        = time() . $image -> getClientOriginalName();
                $image -> move(public_path() . '/images/Enclosures/', $name);
            }
            $currentEnclosure = Sub_Series ::findOrfail($Enclosure);
            if($currentEnclosure !== NULL && !empty($currentEnclosure)) {
                $currentEnclosure -> images() -> create([
                    'Path' => "/images/Enclosures/{$name}",
                    'Name' => $currentName,
                ]);
                
                return response() -> json(['success' => 'You have successfully uploaded an image'], 200);
            }
            
            return response() -> json(['faild' => 'You have faild uploaded an image'], 500);
        }
        
        /**
         * Display the specified resource.
         *
         * @param $SubSeries
         * @return \App\Http\Resources\Sub_Series\Sub_SeriesResource
         */
        public function show(Sub_Series $SubSeries)
        {
            return new Sub_SeriesResource($SubSeries);
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param                           $SubSeries
         * @return array
         * @throws \Illuminate\Validation\ValidationException
         */
        public function update(Request $request, $SubSeries)
        {
            $currentSubSeries = Sub_Series ::findOrfail($SubSeries);
            $this -> validate($request, [
                'Name'        => 'required|string|max:191',
                'Title'       => 'required|string|max:191',
                'Description' => 'required',
            ]);
            if($currentSubSeries !== NULL && !empty($currentSubSeries)) {
                $currentSubSeries -> update($request -> all());
                
                return ['message' => 'Updated the sub series info.'];
            }
            
            return ['message' => 'Updated Faild!);'];
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param $SubSeries
         * @return array
         */
        public function destroy($SubSeries)
        {
            $currentSubSeries = Sub_Series ::findOrfail($SubSeries);
            if($currentSubSeries !== NULL && !empty($currentSubSeries)) {
                $currentSubSeries -> delete();
                
                return ['message' => 'Sub Series Deleted.'];
            }
            
            return ['message' => 'Sub Series Can\'t Deleted.'];
        }
    }
