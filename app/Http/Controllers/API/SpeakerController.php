<?php
    
    namespace App\Http\Controllers\API;
    
    use App\Http\Resources\Speaker\SpeakerResource;
    use App\Model\Speaker;
    use App\Model\Sub_Speaker;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Pagination\LengthAwarePaginator;
    
    class SpeakerController extends Controller {
        
        /**
         * Display a listing of the resource.
         *
         * @param \Illuminate\Http\Request $request
         * @return array
         */
        public function index(Request $request)
        {
            $speakers = Speaker ::with('images') -> get();
            $data     = array();
            foreach($speakers as $speaker) {
                $data[] = array(
                    'Name'        => $speaker['Name'],
                    'image'       => $speaker -> images[0]['Path'] ?? '',
                    //							'hover_image' => $speaker -> images[1]['Path'] ?? '',
                    'series_name' => $speaker['series_name'],
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
         * Display a listing of series name the resource.
         *
         * @param $seriesName
         * @return array
         */
        public function indexOf($seriesName)
        {
            return Speaker ::with(['sub_speaker', 'images']) -> where('series_name', $seriesName) -> get();
        }
        
        public function search()
        {
            if($search = \Request ::get('q')) {
                $speakers = Speaker ::with('images')
                                    -> where(
                                        function($query) use ($search) {
                                            $query -> where('Name', 'LIKE', "%$search%")
                                                   -> orWhere('series_name', 'LIKE', "%$search%");
                                        }) -> get();
                $data     = array();
                foreach($speakers as $speaker) {
                    $data[] = array(
                        'Name'        => $speaker['Name'],
                        'image'       => $speaker -> images[0]['Path'] ?? '',
                        //							'hover_image' => $speaker -> images[1]['Path'] ?? '',
                        'series_name' => $speaker['series_name'],
                    );
                }
            } else {
                $speakers = Speaker ::with('images') -> get();
                $data     = array();
                foreach($speakers as $speaker) {
                    $data[] = array(
                        'Name'        => $speaker['Name'],
                        'image'       => $speaker -> images[0]['Path'] ?? '',
                        //							'hover_image' => $speaker -> images[1]['Path'] ?? '',
                        'series_name' => $speaker['series_name'],
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
            $speaker = Speaker ::create($request -> all());
            if($request['Driver_Size'] !== NULL ||
               $request['Fs_Hz'] !== NULL ||
               $request['Qms'] !== NULL ||
               $request['Qes'] !== NULL ||
               $request['Qts'] !== NULL ||
               $request['Vas_liters'] !== NULL ||
               $request['Dimensions_in'] !== NULL ||
               $request['Dimensions_mm'] !== NULL) {
                if($speaker !== NULL && !empty($speaker)) {
                    $speaker -> sub_speaker() -> create([
                        'Driver_Size'   => $request['Driver_Size'],
                        'Fs_Hz'         => $request['Fs_Hz'],
                        'Qms'           => $request['Qms'],
                        'Qes'           => $request['Qes'],
                        'Qts'           => $request['Qts'],
                        'Vas_liters'    => $request['Vas_liters'],
                        'Dimensions_in' => $request['Dimensions_in'],
                        'Dimensions_mm' => $request['Dimensions_mm'],
                        'speaker_name'  => $speaker -> Name,
                    ]);
                }
            }
            
            return $speaker;
        }
        
        public function addPhotos(Request $request, $Speaker)
        {
            $this -> validate($request, [
                'file' => 'required|mimes:jpg,jpeg,bmp,png',
            ]);
            if($request -> file('file')) {
                $image       = $request -> file('file');
                $currentName = $image -> getClientOriginalName();
                $name        = time() . $image -> getClientOriginalName();
                $image -> move(public_path() . '/images/Speakers/', $name);
            }
            $currentSpeaker = Speaker ::findOrfail($Speaker);
            if($currentSpeaker !== NULL && !empty($currentSpeaker)) {
                $currentSpeaker -> images() -> create([
                    'Path' => "/images/Speakers/{$name}",
                    'Name' => $currentName,
                ]);
                
                return response() -> json(['success' => 'You have successfully uploaded an image'], 200);
            }
            
            return response() -> json(['faild' => 'You have faild uploaded an image'], 500);
        }
        
        /**
         * Display the specified resource.
         *
         * @param $Speaker
         * @return \App\Http\Resources\Speaker\SpeakerResource
         */
        public function show(Speaker $Speaker)
        {
            return new SpeakerResource($Speaker);
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param                           $Speaker
         * @return array
         * @throws \Illuminate\Validation\ValidationException
         */
        public function update(Request $request, $Speaker)
        {
            $currentSpeaker = Speaker ::findOrFail($Speaker);
            $this -> validate($request, [
                'Name'        => 'required|string|max:191',
                'Title'       => 'required|string|max:191',
                'Description' => 'required',
            ]);
            if($currentSpeaker !== NULL && !empty($currentSpeaker)) {
                $currentSpeaker -> update($request -> all());
                
                return ['message' => 'Updated the Speaker info.'];
            }
            
            return ['message' => 'Updated Faild!);'];
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param $Speaker
         * @return array
         */
        public function destroy($Speaker)
        {
            $currentSpeaker = Speaker ::findOrFail($Speaker);
            if($currentSpeaker !== NULL && !empty($currentSpeaker)) {
                $currentSpeaker -> delete();
                
                return ['message' => 'Speaker Deleted.'];
            }
            
            return ['message' => 'Speaker Can\'t Deleted.'];
        }
    }
