<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Resources\Signal_Processor\Signal_ProcessorCollection;
    use App\Http\Resources\Signal_Processor\Signal_ProcessorResource;
    use App\Model\Product;
    use App\Model\Series;
    use App\Model\Signal_Processor;
    use Illuminate\Http\Request;
    
    class SignalProcessorController extends Controller {
        
        /**
         * Display a listing of the resource.
         *
         * @param \App\Model\Product $product
         * @param \App\Model\Series  $series
         * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
         */
        public function index(Product $product, Series $series)
        {
            return Signal_ProcessorCollection ::collection($series -> signal_processors);
        }
        
        /**
         * Display the specified resource.
         *
         * @param \App\Model\Product          $product
         * @param \App\Model\Series           $series
         * @param \App\Model\Signal_Processor $signalProcessor
         * @return \App\Http\Resources\Signal_Processor\Signal_ProcessorResource
         */
        public function show($product, $series, Signal_Processor $signalProcessor)
        {
            return new Signal_ProcessorResource($signalProcessor);
        }
    }
