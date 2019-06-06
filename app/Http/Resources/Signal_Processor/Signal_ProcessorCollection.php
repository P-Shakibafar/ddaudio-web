<?php
    
    namespace App\Http\Resources\Signal_Processor;
    
    use Illuminate\Http\Resources\Json\Resource;
    
    /**
     * @property mixed Name
     * @property mixed series
     * @property mixed series_name
     */
    class Signal_ProcessorCollection extends Resource {
        
        /**
         * Transform the resource collection into an array.
         *
         * @param  \Illuminate\Http\Request $request
         * @return array
         */
        public function toArray($request)
        {
            return [
                'name' => $this -> Name,
                'image' => $this -> images -> first() -> Path ?? NULL,
                'href' => [
                    'link' => route('products.series.signal_processors.show',
                        [$this -> series -> product_name, $this -> series_name, $this -> Name]),
                ],
            ];
        }
    }
