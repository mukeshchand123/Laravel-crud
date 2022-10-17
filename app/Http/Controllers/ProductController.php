<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProdCat;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{ 

    public function fetch(Product $product,Category $category)
    {
      
      //for searching via category
        if( Session::get('redirectToUsersPage')) {
            $search_id = Session::get('redirectToUsersPage');
            Session::forget('redirectToUsersPage');
            if($search_id==1){
                $searchAll='';
                $product=Session::get('product');
                $category=Session::get('category');
                $search  =Session::get('search');
                return view('product/fetch',['product'=>$product,'category'=>$category,'search'=>$search,'searchAll'=>$searchAll]);
            }elseif($search_id == 2){
                $search='';
               
                $product=Session::get('product');
                $category=Session::get('category');
                $searchAll  =Session::get('searchAll');
                return view('product/fetch',['product'=>$product,'category'=>$category,'search'=>$search,'searchAll'=>$searchAll]);
            }
            
        }else{ 
            $search='';
            $searchAll='';
            $user  =Session::get('loginId');
            $product = Product::where('userid','=',$user)->get();
            $category= Category::where('userid','=',$user)->get();
            return view('product/fetch',['product'=>$product,'category'=>$category,'search'=>$search,'searchAll'=>$searchAll]);
        } 
    }


    public function add(Category $category){
        $user  =Session::get('loginId');
        $category = Category::where('userid',$user)->get();
        return view('product/add',['category'=>$category]);
        
    }
    public function add_product(Request $request,Category $category){
        $user  =Session::get('loginId');
        $cat= $request->get('dropdown');
        $product = new Product();
        $product->userid = Session::get('loginId');
        $name = $request->get('productName');
        $product->name  = $name;
        $product->price =  $request->get('productPrice');
        $image =time().'_'.$name.'.'. $request->file('file')->getClientOriginalExtension();
        $ext = $request->file('file')->getClientOriginalExtension();
        if($ext == 'jpg'){
            $request->file('file')->storeAs('public/uploads',$image);
            $product->image = 'public/uploads/'.$image;
            $res = $product->save();
            //for prodCat
            $product = Product::where('userid',$user)->where('name',$name)->get(['id']);
            foreach($product as $value){
                $id = $value ;
            }
            $count = 1;
              foreach( $cat as $value){
                $pc = ProdCat::create(
                [
                    'cat' => $value,
                    'prod' => $id->id
                    ]

                );
                
               
                
               }
            return redirect('product/fetch');
 
        }else{
            echo"Invalid ext";
            echo $ext;
        }
       
      
    }

    //search via category
    public function searchCategory(Request $request){
        $search = $request->get('dropdown');
        $product = new Product();
        $category= new Category();
        $user  =Session::get('loginId');
        $product = Product::where('userid','=',$user)->get();
        $category= Category::where('userid','=',$user)->get();
        Session::put('redirectToUsersPage', '1');
        return redirect('product/fetch')->with(['product'=>$product,'category'=>$category,'search'=>$search]);
       
    }
     //search via product
     public function search(Request $request){
        $search = $request->get('search');
        $product = new Product();
        $category= new Category();
        $user  =Session::get('loginId');
        $product = Product::where('userid','=',$user)->where('name','LIKE',"%{$search}%")->orwhere('price','LIKE',"%{$search}%")->get();
        $category= Category::where('userid','=',$user)->get();
        Session::put('redirectToUsersPage', '2');
        return redirect('product/fetch')->with(['product'=>$product,'category'=>$category,'searchAll'=>$search]);
       
    }


    public function destroy(Product $product,$id)
    {
        //
        
        $product = Product::where('id','=',$id)->get();
        //delete image related to product
        foreach($product as $value){

            $image=$value->image;
        }
        $product=Product::find($id);
        if(\Storage::exists($image)){
            \Storage::delete($image);
          }
          //delete product from database
       $product->delete();
       return redirect('product/fetch');
    }

    public function edit(Product $product,Category $category,$id) // do product update
    {
     // check for null id
        $cat = array();
        $product = Product::find($id);
        if(!$product){
            return back();
        }
        $product=Product::where('id','=',$id)->get();
       if(!$product){
        return back();
       }
        foreach($product as $value){
           
           foreach($value->category as $category){
            $cat[]= $category->id;
           }
          }
          
        $user  =Session::get('loginId');
        $category = Category::where('userid',$user)->get();
        $product=Product::find($id);
        return view("product.update",['product'=>$product,'category'=>$category,'cat'=>$cat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product,$id)
    {   
        $user  =Session::get('loginId');
        $image = '';
        //getting all categories
        $category = Category::where('userid',$user)->get();
        foreach($category as $value){
            $all_cat[] = $value->id;
        }
        
        //delete existing image
        $product = Product::where('id','=',$id)->get(['image']);
        foreach($product as $file){
            $image = $file->image;
        }
        if(\Storage::exists($image)){
            \Storage::delete($image);
          }
        
          //saving new data
        $cat= $request->get('dropdown');
        $product = Product::find($id);
        $name = $request->get('productName');
        $product->name =$name;
        $product->price =  $request->get('productPrice');
        $image =time().'_'.$name.'.'. $request->file('file')->getClientOriginalExtension();
        $ext = $request->file('file')->getClientOriginalExtension();
       
        if($ext == 'jpg'){
            $request->file('file')->storeAs('public/uploads',$image);
            $product->image = 'public/uploads/'.$image;
            $res = $product->save();
           //fetch old relations
            $prod_cat = ProdCat::where('prod','=',$id)->get(['cat']);
            foreach($prod_cat as $value){
                $oldCat[] = $value->cat;
            }
           
            //delete old rel if they dont exist currently
            foreach( $oldCat as $value){
                if(!in_array($value,$cat)){
                    $p_c = new ProdCat();
                  
                    $p_c = ProdCat::where('prod','=',$id)->where('cat','=',$value);
                    $p_c->delete();
                }}

            //add new rel if they dont exist previously
            foreach( $cat as $value){
                if(!in_array($value,$oldCat)){
                     $pc = ProdCat::create(
                             [
                                'cat' => $value,
                                'prod' => $id
                             ]
                             );
                }
            }
            return  redirect('product/fetch');
        }
               
        else{
                return back()->with('message','jpg files only');
            }           
        
    
    }
}
