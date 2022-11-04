<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProdCat;
use App\Models\Image;
use App\Models\Size;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Session;
use ImageNew;

class ProductController extends Controller
{ 

    public function fetch(Product $product,Category $category)
    {
      
      //for searching 
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


    public function add(Category $category,Size $size){
        $user  =Session::get('loginId');
        $category = Category::where('userid',$user)->get();
        $size = Size::where('userid',$user)->get();
        return view('product/add',['category'=>$category,'size'=>$size]);
        
    }
    public function add_product(Request $request,Category $category){
        $request->validate([
            'productName'=> 'required',
            'dropdown'=> 'required',
            'size'=>'required',
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
        $size =  $request->get('size');
        $product->userid = Session::get('loginId');
        
        $product->price =  $request->get('productPrice');
       
        if($request->hasfile('file'))
        {

           foreach($request->file('file') as $file)
           {    
            $image = ImageNew::make($file);
             /**
             * Main Image Upload on Folder Code
             */
               $imageName =time().'_'.$name.'.'.$file->getClientOriginalName();
             //  $image=$file->getClientOriginalName();
              // $request->file('file')->storeAs('public/uploads',$image);
               $destinationPath = public_path('public/uploads/');
               $image->save($destinationPath.$imageName);
            //   $file->move('public/uploads', $image); 
               //$file->move(public_path().'/files/', $name); 
    
          /**
          * Generate Thumbnail-1 Image Upload on Folder Code
          */
            $destinationPathThumbnail = public_path('public/uploads/thumbnail_1/');
            $image->resize(400,400);
            $image->save($destinationPathThumbnail.$imageName);
           
           /**
          * Generate Thumbnail-2 Image Upload on Folder Code
          */
            $destinationPathThumbnail = public_path('public/uploads/thumbnail_2/');
            $image->resize(800,800);
            $image->save($destinationPathThumbnail.$imageName);  
           
            
           /**
          * Generate Thumbnail-3 Image Upload on Folder Code
          */
          $destinationPathThumbnail = public_path('public/uploads/thumbnail_3/');
          $image->resize(300,300);
          $image->save($destinationPathThumbnail.$imageName);    
   
               
               $data[] = $imageName; 
               
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
            $count = 0;
            foreach($data as $file){
                if($count == 0){
                $file = Image::create(
                    [
                        'prod'=>$id->id,
                        'name'=>$file,
                        'dir'=>'public/uploads/'.$file,
                        'primary'=> 1
                    ]
                    );
                }else{
                    $file = Image::create(
                        [
                            'prod'=>$id->id,
                            'name'=>$file,
                            'dir'=>'public/uploads/'.$file
                        ]
                        );
                        
                }
                $count = 1;
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
               foreach($size as $value){
                $pSize = ProductSize::create([

                    'prod_id'=>$id->id,
                    'size_id'=>$value

                ]);
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


    public function destroy(Product $product,$id,ProdCat $prod_cat )
    {
        
        $image = new Image();
        $image = Image::where('prod','=',$id);
        $image->delete();

        //delete image related to product
        //for hard delete
        // foreach($image as $value){

        //     $dir=$value->dir;
            
        // if(\File::exists(public_path($dir))){
        //     \File::delete(public_path($dir));
        //   }

        
           
        // }
        $product=Product::where('id','=',$id);
       // $prod_cat = ProdCat::where('prod','=',$id);
       
      
        // delete product from database
       $product->delete();
       //$prod_cat->delete();
       return redirect('product/fetch');
    }
    

    //update product

    public function edit(Product $product,Category $category,Size $size,$id) // do product update
    {
     // check for null id
        $cat = array();
        $prod_size = array();
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
           foreach($value->size as $size){
            $prod_size[] = $size->id;
            
           }
          }
      
        $user  =Session::get('loginId');
        $category = Category::where('userid',$user)->get();
        $size = Size::where('userid',$user)->get();
        $product=Product::find($id);
        return view("product.update",['product'=>$product,'category'=>$category,'cat'=>$cat,'size'=>$size,'productSize'=>$prod_size]);
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
            'size'=> 'required',
            'productPrice'=> 'required',
            'file'=> 'required',
            'file.*'=> 'mimes:jpg,jpeg,png'
        ]); 
        $user  =Session::get('loginId');
        $name = $request->get('productName');
        $product->name =$name;
        $product->price =  $request->get('productPrice');
       
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
        $product_size=$request->get('size');
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
            $prod_size = ProductSize::where('prod_id','=',$id)->get(['size_id']);
            foreach($prod_cat as $value){
                $oldCat[] = $value->cat;
            }
            foreach( $prod_size as $value){
                $oldSize[] = $value->size_id;
            }
           
            //delete old rel if they dont exist currently
            foreach( $oldCat as $value){
                if(!in_array($value,$cat)){
                    $p_c = new ProdCat();
                  
                    $p_c = ProdCat::where('prod','=',$id)->where('cat','=',$value);
                    $p_c->delete();
                }}
                foreach( $oldSize as $value){
                    if(!in_array($value,$product_size)){
                        $p_c = new ProductSize();
                      
                        $p_c = ProductSize::where('prod_id','=',$id)->where('size_id','=',$value);
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
            foreach( $product_size as $value){
                if(!in_array($value,$oldSize)){
                     $pc = ProdCat::create(
                             [
                                'size_id' => $value,
                                'prod_id' => $id
                             ]
                             );
                }
            }
            return  redirect('product/fetch');
              
        
    
    }

    public function deleted(){

        $search='';
        $searchAll='';
        $user  =Session::get('loginId');
        $product = Product::onlyTrashed()->where('userid','=',$user)->get();
        $category= Category::where('userid','=',$user)->get();
        return view('product/deleted',['product'=>$product,'category'=>$category,'search'=>$search,'searchAll'=>$searchAll]);

    }
    public function restore($id){
        echo'restore';
        $user  =Session::get('loginId');
        $product = Product::withTrashed()->where('id','=',$id)->restore();
        $image = Image::withTrashed()->where('prod','=',$id)->restore();
        //$prod_cat=ProdCat::withTrashed()->where('prod','=',$id)->restore();//

        return redirect('product/fetch');
    }

    public function productList(){
        $search = '';
        $id  =Session::get('loginId');
        $product = Product::where('userid','=',$id)->get();
        $category = Category::where('userid','=',$id)->get();
        $size = Size::where('userid','=',$id)->get();
        return view('product/productList',['product'=>$product,'category'=>$category,'size'=>$size,'search'=>$search]);

    }
}
