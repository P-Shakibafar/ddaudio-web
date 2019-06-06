<?php
    
    namespace App\Http\Controllers\API;
    
    use App\Http\Resources\Signal_Processor\Signal_ProcessorResource;
    use App\Model\Signal_Processor;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Pagination\LengthAwarePaginator;
    
    class SignalProcessorController extends Controller {
        
        /**
         * Display a listing of the resource.
         *
         * @param \Illuminate\Http\Request $request
         * @return array
         */
        public function index(Request $request)
        {
            $signalProcessors = Signal_Processor ::with('images') -> get();
            $data             = array();
            foreach($signalProcessors as $signalProcessor) {
                $data[] = array(
                    'Name'        => $signalProcessor['Name'],
                    'image'       => $signalProcessor -> images[0]['Path'] ?? '',
                    //							'hover_image' => $signalProcessor -> images[1]['Path'] ?? '',
                    'series_name' => $signalProcessor['series_name'],
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
            return Signal_Processor ::with('images') -> where('series_name', $seriesName) -> get();
        }
        
        public function search()
        {
            if($search = \Request ::get('q')) {
                $signalProcessors = Signal_Processor ::with('images')
                                                     -> where(
                                                         function($query) use ($search) {
                                                             $query -> where('Name', 'LIKE', "%$search%")
                                                                    -> orWhere('series_name', 'LIKE', "%$search%");
                                                         }) -> get();
                $data             = array();
                foreach($signalProcessors as $signalProcessor) {
                    $data[] = array(
                        'Name'        => $signalProcessor['Name'],
                        'image'       => $signalProcessor -> images[0]['Path'] ?? '',
                        //							'hover_image' => $signalProcessor -> images[1]['Path'] ?? '',
                        'series_name' => $signalProcessor['series_name'],
                    );
                }
            } else {
                $signalProcessors = Signal_Processor ::with('images') -> get();
                $data             = array();
                foreach($signalProcessors as $signalProcessor) {
                    $data[] = array(
                        'Name'        => $signalProcessor['Name'],
                        'image'       => $signalProcessor -> images[0]['Path'] ?? '',
                        //							'hover_image' => $signalProcessor -> images[1]['Path'] ?? '',
                        'series_name' => $signalProcessor['series_name'],
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
            
            return Signal_Processor ::create($request -> all());
        }
        
        public function addPhotos(Request $request, $SignalProcessor)
        {
            $this -> validate($request, [
                'file' => 'required|mimes:jpg,jpeg,bmp,png',
            ]);
            if($request -> file('file')) {
                $image       = $request -> file('file');
                $currentName = $image -> getClientOriginalName();
                $name        = time() . $image -> getClientOriginalName();
                $image -> move(public_path() . '/images/SignalProcessors/', $name);
            }
            $currentSignalProcessor = Signal_Processor ::findOrfail($SignalProcessor);
            if($currentSignalProcessor !== NULL && !empty($currentSignalProcessor)) {
                $currentSignalProcessor -> images() -> create([
                    'Path' => "/images/SignalProcessors/{$name}",
                    'Name' => $currentName,
                ]);
                
                return response() -> json(['success' => 'You have successfully uploaded an image'], 200);
            }
            
            return response() -> json(['faild' => 'You have faild uploaded an image'], 500);
        }
        
        /**
         * Display the specified resource.
         *
         * @param $Signal_Processor
         * @return \App\Http\Resources\Signal_Processor\Signal_ProcessorResource
         */
        public function show(Signal_Processor $Signal_Processor)
        {
            return new Signal_ProcessorResource($Signal_Processor);
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param                           $Signal_Processor
         * @return array
         * @throws \Illuminate\Validation\ValidationException
         */
        public function update(Request $request, $Signal_Processor)
        {
            $currentSignalProcessor = Signal_Processor ::findOrfail($Signal_Processor);
            $this -> validate($request, [
                'Name'        => 'required|string|max:191',
                'Title'       => 'required|string|max:191',
                'Description' => 'required',
            ]);
            if($currentSignalProcessor !== NULL && !empty($currentSignalProcessor)) {
                $currentSignalProcessor -> update($request -> all());
                
                return ['message' => 'Updated the Signal Processor info.'];
            }
            
            return ['message' => 'Updated Faild!);'];
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param $Signal_Processor
         * @return array
         */
        public function destroy($Signal_Processor)
        {
            $currentSignalProcessor = Signal_Processor ::findOrfail($Signal_Processor);
            if($currentSignalProcessor !== NULL && !empty($currentSignalProcessor)) {
                $currentSignalProcessor -> delete();
                
                return ['message' => 'Signal Processor Deleted.'];
            }
            
            return ['message' => 'Signal Processor Can\'t Deleted.'];
        }
    }
