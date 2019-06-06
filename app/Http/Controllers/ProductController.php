<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Resources\Product\ProductCollection;
    use App\Http\Resources\Product\ProductResource;
    use App\Model\Product;
    use Illuminate\Http\Request;
    
    class ProductController extends Controller {
        
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
         */
        public function index()
        {
            return ProductCollection ::collection(Product ::all());
        }
        
        /**
         * Display the specified resource.
         *
         * @param  \App\Model\Product $product
         * @return \App\Http\Resources\Product\ProductResource
         */
        public function show(Product $product)
        {
            return new ProductResource($product);
        }
    }
