<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProdCat;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function fetch(Category $category)
    {
        //
        $user  =Session::get('loginId');
       // $category = new Category();
       $category= Category::where('userid','=',$user)->get();
        //$data = \DB::select('select * from category where userid = :user', [':user'=>$user])->withTrashed();
        return view('category/fetch',['data'=>$category]);
    }
    public function add(Request $request)
    {
        $request->validate([
            'categoryName'=>'required|string',
            'categoryDescription'=>'required|string',
        ]);
        $user  =Session::get('loginId');
        $category = new Category();
        $category->name= $request->get('categoryName');
        $category->description= $request->get('categoryDescription');
        $category->userid = $user;

       $res = $category->save();
      
       if($res){
        return redirect('category/fetch');
       }else{
        return back()->with('fail','Category addition failed.');
       }
    }

  

 


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category,$id)
    {
        //
        $category=Category::find($id);
        if(!$category){
            return back();
        }
       return view("category.update",['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category,$id)
    {
        //
        $request->validate([
            'categoryName'=>'required|string',
            'categoryDescription'=>'required|string',
        ]);
        $category=Category::find($id);
        $category->name= $request->get('categoryName');
        $category->description= $request->get('categoryDescription');
        $category->save();
        return redirect('category/fetch');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,$id,)
    {
        
       
        // $exist = array();
        // $pc = new ProdCat();
        // $pc = ProdCat::where('cat','=',$id)->get();
        // foreach($pc as $value ){
        //     $exist[] =  $value->cat;
        // }
        // if(in_array($id,$exist)){
        //     return back()->with('message','cannot delete category associated with a product.');
          
        // }else{
           
            $category=Category::find($id);
            $category->delete();
            return redirect('category/fetch');
            
        //  }

      
    }

    // fetch all deleted category
    public function deleted(){

        $user  =Session::get('loginId');
       // $product = Product::onlyTrashed()->where('userid','=',$user)->get();
        $category= Category::onlyTrashed()->where('userid','=',$user)->get();
        return view('category/deleted',['data'=>$category]);

            
    }

    public function restore($id){
        $category = Category::withTrashed()->where('id','=',$id)->restore();
        return redirect('category/fetch');
    }
}
