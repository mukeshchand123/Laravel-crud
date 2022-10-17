<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Product;

class ImageController extends Controller
{
    //
    public function fetch(Image $image,$prod){
        $image = Image::where('prod','=',$prod)->get();
      
       return view('product/image/fetch',['image'=>$image]);
    }

    public static function delete($id){
       $image= new Image();
        $image = Image::where('id','=',$id)->get();
        foreach($image as $value){
            $dir = $value->dir;
        }
        
        

        if(\File::exists(public_path($dir))){
            \File::delete(public_path($dir));
          }

          $image = Image::find($id);
          $image->delete();
          return back();
    }
}
