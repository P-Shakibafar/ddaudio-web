<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Resources\Speaker\SpeakerCollection;
    use App\Http\Resources\Speaker\SpeakerResource;
    use App\Model\Product;
    use App\Model\Series;
    use App\Model\Speaker;
    use Illuminate\Http\Request;
    
    class SpeakerController extends Controller {
        
        /**
         * Display a listing of the resource.
         *
         * @param \App\Model\Product $product
         * @param \App\Model\Series  $series
         * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
         */
        public function index(Product $product, Series $series)
        {
            return SpeakerCollection ::collection($series -> speakers);
        }
        
        /**
         * Display the specified resource.
         *
         * @param \App\Model\Product  $product
         * @param \App\Model\Series   $series
         * @param  \App\Model\Speaker $speaker
         * @return \App\Http\Resources\Speaker\SpeakerResource
         */
        public function show($product, $series, Speaker $speaker)
        {
            return new SpeakerResource($speaker);
        }
    }
