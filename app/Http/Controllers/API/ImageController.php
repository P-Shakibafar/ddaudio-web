<?php
    
    namespace App\Http\Controllers\API;
    
    use App\Http\Controllers\Controller;
    use App\Model\Image;
    use Illuminate\Http\Request;
    
    class ImageController extends Controller {
        
        /**
         * Display a listing of the resource.
         *
         * @return \App\Model\Image[]|\Illuminate\Database\Eloquent\Collection
         */
        public function index()
        {
            return Image ::latest() -> paginate(8);
        }
        
        public function allImages()
        {
            return Image ::latest()->get();
        }
        
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @return array
         * @throws \Illuminate\Validation\ValidationException
         */
        public function store(Request $request)
        {
            $this -> validate($request, [
                'file' => 'required|mimes:jpg,jpeg,bmp,png',
            ]);
            if($request -> file('file')) {
                $image       = $request -> file('file');
                $currentName = $image -> getClientOriginalName();
                $name        = time() . $image -> getClientOriginalName();
                $image -> move(public_path() . '/images/', $name);
            }
            Image ::create([
                'Path' => "/images/{$name}",
                'Name' => $currentName,
            ]);
            
            return response() -> json(['success' => 'You have successfully uploaded an image'], 200);
        }
        
        /**
         * Display the specified resource.
         *
         * @param  int $id
         * @return void
         */
        public function show($id)
        {
            //
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $id
         * @return void
         */
        public function update(Request $request, $id)
        {
            //
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param $image
         * @return array
         */
        public function destroy($image)
        {
            $currentPhoto = Image ::findOrfail($image);
            if($currentPhoto !== NULL && !empty($currentPhoto)) {
                $currentPhoto -> delete();
                $this -> unlinkImage($currentPhoto -> Path);
                
                return ['message' => 'Photo Deleted.'];
            }
            
            return ['message' => 'Photo Can\'t Deleted.'];
        }
        
        protected function unlinkImage($photo)
        {
            $Photo = public_path($photo);
            if(file_exists($Photo)) {
                @unlink($Photo);
            }
        }
    }
