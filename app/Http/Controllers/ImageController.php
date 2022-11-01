<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Product;
use Session;

class ImageController extends Controller
{
    //
    public function fetch(Image $image,$prod){
        $image = Image::where('prod','=',$prod)->get();
        Session::put('prod', $prod);
       return view('product/image/fetch',['image'=>$image]);
    }

    public static function delete($id){
       $image= new Image();
        $image = Image::where('id','=',$id)->get();
        foreach($image as $value){
            if($value->primary == 1){
                return back()->with('msg','Cannot delete primary Image.');
            }
          
        }
      
        
        //delete image from directory 
        // if(\File::exists(public_path($dir))){
        //     \File::delete(public_path($dir));
        //   }

          $image = Image::find($id);
          $image->delete();
          return back();
    }

    public function deleted(){

        //display all deleted image data
       
        $user  =Session::get('loginId');
        $prod = Session::get('prod');
      
        $image= Image::onlyTrashed()->where('prod','=',$prod)->get();
        return view('product/image/deleted',['image'=>$image]);

            
    }

    public function restore($id){
        echo $id;
        $image = Image::withTrashed()->where('id','=',$id)->restore();
        return redirect('product/fetch');
    }

    public function update($id){
        $image = new Image();
        $prod = Session::get('prod');
        $image =  Image::where('primary','=',1)->where('prod','=',$prod)->first();
        $image->primary = 0; 
        $image->save();
        $image = Image::find($id);
        $image->primary = 1;
        $image->save();
        return back();
    }
}
