<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Resources\Sub_Series\Sub_SeriesCollection;
    use App\Http\Resources\Sub_Series\Sub_SeriesResource;
    use App\Http\Resources\Sub_Speaker\Sub_SpeakerResource;
    use App\Model\Product;
    use App\Model\Series;
    use App\Model\Sub_Series;
    use Illuminate\Http\Request;
    
    class SubSeriesController extends Controller {
        
        /**
         * Display a listing of the resource.
         *
         * @param \App\Model\Product $product
         * @param \App\Model\Series  $series
         * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
         */
        public function index(Product $product, Series $series)
        {
            return Sub_SeriesCollection ::collection($series -> sub_series);
        }
        
        /**
         * Display the specified resource.
         *
         * @param \App\Model\Product    $product
         * @param \App\Model\Series     $series
         * @param \App\Model\Sub_Series $subSeries
         * @return \App\Http\Resources\Sub_Series\Sub_SeriesResource
         */
        public function show($product, $series, Sub_Series $subSeries)
        {
            return new Sub_SeriesResource($subSeries);
        }
    }
