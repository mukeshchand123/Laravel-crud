<x-layout>

  <x-sizeNavBar>
  </x-sizeNavBar> 

<form action='/size/add' method="post" enctype="multipart/form-data" >
@if(Session::has('fail'))
<div class="alert alert-success">{{Session::get('fail')}}</div>
@endif    
@csrf
   
   <div class="container">
       <div class="row">
           <div class="col-sm-3">
              
               
               <hr class="mb-3">
              
               <label for="size">Product Size</label>
               <input class="form-control" type="text" name="size" placeholder="Product size" required><br>
              
              
                        
               <hr class="mb-3">
               
               <input class="btn btn-primary"  onclick="return confirm('Are you sure you want to continue?');" type="submit" name="create" value="Add-Size">
           </div>
       </div>
   </div>

</form>
</x-layout>