<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Session;


class ProductSizeController extends Controller
{
    //

    public function fetch(Size $size)
    {
        //
        $user  =Session::get('loginId');
       // $category = new Category();
       $size = Size::where('userid','=',$user)->get();
        //$data = \DB::select('select * from category where userid = :user', [':user'=>$user])->withTrashed();
        return view('size/fetch',['data'=>$size]);
    }

    public function add(){
        return view('size/add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'size'=>'required|string',
            
        ]);
        $user  =Session::get('loginId');
        $size = new Size();
        $size->productSize= $request->get('size');
        $size->userid = $user;

       $res = $size->save();
      
       if($res){
        return redirect('size/fetch');
       }else{
        return back()->with('fail','Category addition failed.');
       }
    }

    public function destroy($id,Size $size){

         
        $exist = array();
        $ps = new ProductSize();
        $pc = ProductSize::where('size_id','=',$id)->get();
        foreach($pc as $value ){
            $exist[] =  $value->size_id;
        }
        if(in_array($id,$exist)){
            return back()->with('message','cannot delete Size associated with a product.');
          
        }else{
           
            $size=Size::find($id);
            $size->delete();
            return redirect('size/fetch');
            
         }

    }

    public function deleted(){
        $user  =Session::get('loginId');
        // $product = Product::onlyTrashed()->where('userid','=',$user)->get();
         $size= Size::onlyTrashed()->where('userid','=',$user)->get();
         return view('size/deleted',['data'=>$size]);
 
    }

    public  function restore($id){
        $size = Size::withTrashed()->where('id','=',$id)->restore();
        return redirect('size/fetch');
    }

    public function edit(Size $size,$id){
        $size=Size::find($id);
        if(!$size){
            return back();
        }
       return view("size.update",['size'=>$size]);
    }

    public function update(Request $request, Size $size,$id)
    {
        //
        $request->validate([
            'size'=>'required|string',
           
        ]);
        $size=Size::find($id);
        $size->productSize= $request->get('size');
       
        $size->save();
        return redirect('size/fetch');
    }
}
