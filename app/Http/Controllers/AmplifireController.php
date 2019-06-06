<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Resources\Amplifire\AmplifireCollection;
    use App\Http\Resources\Amplifire\AmplifireResource;
    use App\Model\Amplifire;
    use App\Model\Product;
    use App\Model\Series;
    use Illuminate\Http\Request;
    
    class AmplifireController extends Controller {
        
        /**
         * Display a listing of the resource.
         *
         * @param \App\Model\Product $product
         * @param \App\Model\Series  $series
         * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
         */
        public function index(Product $product, Series $series)
        {
            return AmplifireCollection ::collection($series -> amplifires);
        }
        
        /**
         * Display the specified resource.
         *
         * @param \App\Model\Product    $product
         * @param \App\Model\Series     $series
         * @param  \App\Model\Amplifire $amplifire
         * @return \App\Http\Resources\Amplifire\AmplifireResource
         */
        public function show($product, $series, Amplifire $amplifire)
        {
            return new AmplifireResource($amplifire);
        }
    }
