<x-layout>
    <div>
      <x-welcomeNavBar>
      </x-welcomeNavBar> 
    </div>
<div class="form">

<form action="/password" method="post" enctype="multipart/form-data" >


   <div class="container">
   @if(Session::has('message'))
      <div class="alert alert-danger">{{Session::get('message')}}</div>
   @endif
   @csrf
       <div class="row">
           <div class="col-sm-3">
               <h1>Change Password</h1>
               
               <hr class="mb-3">
               <label for="email">Old Password</label>    
               <input class="form-control" type="password" name="oldPassword" id="oldPassword" placeholder="******" required>
            

                <label for="password">New Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="******" required><br>
                <hr class="mb-3">
                <button class="btn btn-primary"   onclick="return confirm('Are you sure want to continue?');" type="submit" name="create" value="Update">Update</button>
              
              
           </div>
       </div>
   </div>

</form>
    </div>

</x-layout>