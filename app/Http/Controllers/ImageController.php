<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Resources\Image\ImageCollection;
    use App\Http\Resources\Image\ImageResource;
    use App\Model\Image;
    use Illuminate\Http\Request;
    
    class ImageController extends Controller {
        
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
         */
        public function index()
        {
            return ImageCollection ::collection(Image ::latest()->get());
        }
        
        /**
         * Display the specified resource.
         *
         * @param  \App\Model\Image $image
         * @return \App\Http\Resources\Image\ImageResource
         */
        public function show(Image $image)
        {
            return new ImageResource($image);
        }

        public function lastImage(){
            return ImageCollection::collection(Image::latest()->limit(5)->get());
        }
    }
