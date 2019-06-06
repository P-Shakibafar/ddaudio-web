<?php
    
    namespace App\Http\Controllers\API;
    
    use App\Http\Controllers\Controller;
    use App\Model\Product;
    use Illuminate\Http\Request;
    
    class ProductController extends Controller {
        
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return Product ::latest() -> paginate(10);
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
                'Description' => 'required',
                //					'Image'       => 'required|regex:/^data:image/',
            ]);
            // Create Uniqe Name for Image and marge with param
            $request -> merge(['Icon' => $this -> uniqeImage($request -> Icon)]);
            $request -> merge(['Background' => $this -> uniqeImage($request -> Background)]);
            
            return Product ::create([
                'Name'        => $request['Name'],
                'Description' => $request['Description'],
                'Icon'        => $request['Icon'],
                'Background'  => $request['Background'],
            ]);
        }
        
        /**
         * Display the specified resource.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param                           $product
         * @return array
         * @throws \Illuminate\Validation\ValidationException
         */
        public function update(Request $request, $product)
        {
            $currentproduct = Product ::findOrFail($product);
            $this -> validate($request, [
                'Name'        => 'required|string|max:191',
                'Description' => 'required',
            ]);
            $currentIcon = $currentproduct -> Icon;
            if($request -> Icon != $currentIcon) {
                $request -> merge(['Icon' => $this -> uniqeImage($request -> Icon)]);
                $this -> unlinkImage($currentIcon);
            }
            $currentBackground = $currentproduct -> Background;
            if($request -> Background != $currentBackground) {
                $request -> merge(['Background' => $this -> uniqeImage($request -> Background)]);
                $this -> unlinkImage($currentBackground);
            }
            $currentproduct -> update($request -> all());
            
            return ['message' => 'Updated the category info'];
        }
        
        protected function uniqeImage($image)
        {
            $name = time() . '.' . explode('/',
                    explode(':',
                        substr($image, 0,
                            strpos($image, ';')))[1])[1];
            \Image ::make($image) -> save(public_path('images/category/') . $name);
            
            return $name;
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param $product
         * @return array
         */
        public function destroy($product)
        {
            $product = Product ::findOrFail($product);
            // Unlink Icon and Background Image
            $this -> unlinkImage($product -> Background);
            $this -> unlinkImage($product -> Icon);
            //delete the category
            $product -> delete();
            
            return ['message' => 'Product Deleted'];
        }
        
        protected function unlinkImage($imge)
        {
            $ProductImge = public_path('images/category/') . $imge;
            if(file_exists($ProductImge)) {
                @unlink($ProductImge);
            }
        }
    }
