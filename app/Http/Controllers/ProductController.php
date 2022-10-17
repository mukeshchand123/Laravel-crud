<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProdCat;
use App\Models\Image;
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
        $request->validate([
            'productName'=> 'required',
            'dropdown'=> 'required',
            'productPrice'=> 'required',
            'file'=> 'required',
            'file.*'=> 'mimes:jpg,jpeg,png'
        ]);
        $product = new Product();
        $name = $request->get('productName');
        $product->name  = $name;
       
        //save image in storage folder
       
        
       
      
        $user  =Session::get('loginId');
        $cat= $request->get('dropdown');
       
        $product->userid = Session::get('loginId');
        
        $product->price =  $request->get('productPrice');
       
        if($request->hasfile('file'))
        {

           foreach($request->file('file') as $file)
           {    
               $image =time().'_'.$name.'.'.$file->getClientOriginalName();
             //  $image=$file->getClientOriginalName();
              // $request->file('file')->storeAs('public/uploads',$image);
               $file->move('public/uploads', $image); 
               //$file->move(public_path().'/files/', $name);  
               $data[] = $image; 
               
           }
        }

      
       // $file->filename=json_encode($data);
       //
          
            $res = $product->save();
            //for prodCat
            $product = Product::where('userid',$user)->where('name',$name)->get(['id']);
            foreach($product as $value){
                $id = $value ;
            }
            //save imaage in image table for above product
            foreach($data as $file){
                $file = Image::create(
                    [
                        'prod'=>$id->id,
                        'name'=>$file,
                        'dir'=>'public/uploads/'.$file
                    ]
                    );
            }
            //add prod-cat relation for above product
              foreach( $cat as $value){
                $pc = ProdCat::create(
                [
                    'cat' => $value,
                    'prod' => $id->id
                ]
                );      
               }
            return redirect('product/fetch');     
      
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
        
        $image = new Image();
        $image = Image::where('prod','=',$id)->get();
        //delete image related to product
        foreach($image as $value){

            $dir=$value->dir;
            
        if(\File::exists(public_path($dir))){
            \File::delete(public_path($dir));
          }

        
           
        }
        $product=Product::where('id','=',$id);
       
      
        // delete product from database
       $product->delete();
       return redirect('product/fetch');
    }
    

    //update product

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
        $request->validate([
            'productName'=> 'required',
            'dropdown'=> 'required',
            'productPrice'=> 'required',
            'file'=> 'required',
            'file.*'=> 'mimes:jpg,jpeg,png'
        ]); 
        $user  =Session::get('loginId');
        $name = $request->get('productName');
        $product->name =$name;
        $product->price =  $request->get('productPrice');
        //getting all categories
        $category = Category::where('userid',$user)->get();
        foreach($category as $value){
            $all_cat[] = $value->id;
        }
        
       
        //add image to public folder 
        if($request->hasfile('file'))
        {

           foreach($request->file('file') as $file)
           {    
               $image =time().'_'.$name.'.'.$file->getClientOriginalName();
             //  $image=$file->getClientOriginalName();
              // $request->file('file')->storeAs('public/uploads',$image);
               $file->move('public/uploads', $image); 
               //$file->move(public_path().'/files/', $name);  
               $data[] = $image; 
               
           }
        }
          //saving new data
        $cat= $request->get('dropdown');
        $product = Product::find($id);           
            $res = $product->save();
            //add image in image table
            foreach($data as $file){
                $file = Image::create(
                    [
                        'prod'=>$id,
                        'name'=>$file,
                        'dir'=>'public/uploads/'.$file
                    ]
                    );
            }
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
}
