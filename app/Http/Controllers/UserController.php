<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Hash;
use Session;
//use Illuminate\Support\Facade\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('register');
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate requests
        
        $request->validate([
            'firstName'=>'required|string',
            'lastName'=>'required|string',
            'phnNumber'=>'required',
            'email'=>'required|email|unique:users', //must be unique in users table or model
            'password'=>'required|min:4|max:12',
            'confirm-password'=>'required|min:4|max:12'
        ]);
       
        $user = new User;
        $user->firstname = $request->get('firstName');
        $user->lastname = $request->get('lastName');
        $user->phn = $request->get('phnNumber');
        $email = $request->get('email');
        
        $user->email = $email;
        //check if email already exists.
      //  $users = \DB::select('select * from users where email = :email', [':email'=>$email]);
      
      
        $password = $request->get('password');
        $confirm_password = $request->get('confirm-password');
        if( $password ==  $confirm_password){
            $user->password = Hash::make($password);
           $res = $user->save();
            return back()->with('success','User registered ssuccesfully.');
        }else{
            return back()->with('fail','User registration failed.');
        }             
    }

    public function login(Request $request){
        //validate input
        $request->validate([
            'email'=>'required|email', 
            'password'=>'required|min:4|max:12'
        ]);

        $user = new User;
        $email = $request->get('email');
        $password = $request->get('password');
        $users = \DB::select('select * from users where email = :email', [':email'=>$email]);
        //echo "<pre>";
       // print_r($users);
      
        if(($users)){
            foreach($users as $user){
                $user_password = $user->password;
                $user_id = $user->id;
            }
          
           if(Hash::check($password, $user_password)){
             $request->session()->put('loginId',$user_id);//setting session login id to user id.
             return redirect('welcome'); 
           }else{
             return back()->with('fail1','Wrong password.');
           }
       
        }else{
            return back()->with('fail2','Email not registered.');
        }

    }
    public function logout()
    {
        if(Session::has('loginId')){
            Session::pull('loginId');
           // return redirect(\URL::previous());
            return redirect('loginpage');
        }else{
           
            return redirect('loginpage');
        }

    }
    public function welcome(User $user){

        return view('welcome');
    }
   
    public function changePassword(Request $request,User $user){
       
       $id  =Session::get('loginId');
       $userPassword ='';
       $newPassword = $request->get('password');
       $oldPassword =  $request->get('oldPassword');
       $user = User::where('id','=',$id)->get(['password']);
      
       foreach($user as $use){
        $userPassword = $use->password;
       }
       //if Oldpassword and user password matches update the password 
       if(Hash::check($oldPassword, $userPassword)){
            $user = User::find($id);
            $user->password =  Hash::make($newPassword);
            $user->save();
            return redirect('settings');
       }else{
        return back()->with('message','Wrong old password.');
       }

    }

    public function userDetails(Request $request,User $user){

        $id  =Session::get('loginId');
        $user = User::where('id','=',$id)->get();
        return view('user/userdetails',['user'=>$user]);
    }
    public function userEdit(Request $request, $field){
        $id  =Session::get('loginId');
        Session::put('field', $field);
        $user = User::where('id','=',$id)->get();
        foreach($user as $value){
            if($field=='id'){
                return back();
        }else{
            $data = $value->$field;
        }
        }
        return view("user/user_update",['data'=>$data,'field'=>$field]);
       
    }
    public function userUpdate(Request $request,User $user){
        $field   =Session::get('field');
        Session::forget('field');
        $id  =Session::get('loginId');
        $user = User::find($id);
        if($field=='email'){
            $request->validate([
                'email'=>'required|email|unique:users'
             ]);
             $user->$field =  $request->get('email');
        }else{
            $request->validate([
                'new'=>'required'
             ]);
             $user->$field =  $request->get('new');
        }
        
        $user->save();
        return redirect('user/userdetails');

    }
   
    public function destroy(User $user,Product $product)
    {
        //code for deleting user
        //delete all the image related to products for this user
        //delete user and the related product and categories will be automatically deleted as they are set as cascade on delete
        $id  =Session::get('loginId');
        $image=array();
       
        $product = Product::where('userid','=',$id)->get(['image']);
        foreach($product as $value){
            $image = $value->image;
            if(\Storage::exists($image)){
                \Storage::delete($image);
              }
            
        }
        $prod = new Product();
        $prod = Product::where('userid','=',$id);
        $user = User::find($id);
        $prod->delete();
        $user->delete();
        return redirect('logout');
    }
}
