<x-layout>


  <x-productNavBar>
  </x-productNavBar> 
  
  <form action="/add-product" method="post" enctype="multipart/form-data" >
     @csrf
     @if (count($errors) > 0)
     <div class="alert alert-danger">
          <strong>Whoops!</strong> There were some problems with your input.<br><br>       
        </div>
        @endif
     <div class="container">
         <div class="row">
             <div class="col-sm-3">
                
                 
                 <hr class="mb-3">
                
                 <label for="productName">Product Name</label>
                 <input class="form-control" type="productName" name="productName" placeholder="Product Name" required><br><br>
                
                 <label for="productCategory">Product Category</label>
                    <select name = "dropdown[]"  multiple required>
                      @foreach($category as $cat)
                          <option value = "{{$cat->id}}" >{{$cat->name}}</option>
                      @endforeach    
                    </select><br><br>
                  
                  <label for="size">Product Size</label>
                    <select name = "size[]"  multiple required>
                      @foreach($size as $value)
                          <option value = "{{$value->id}}" >{{$value->productSize}}</option>
                      @endforeach    
                    </select><br><br>  
  
                 <label for="productPrice">Product Price</label>
                 <input class="form-control" type="productPrice" name="productPrice"  placeholder="Product Price"  required><br><br>
  
                 <label for="file">Product Image</label>
                 <input type="file" name="file[]" id="file" accept="image/jpeg" multiple required><br><br>
                 <ul>
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{ $error }}</li>
            </div>
            @endforeach
            </ul>
                 <hr class="mb-3">
                 
                 <input class="btn btn-primary"  onclick="return confirm('Are you sure you want to continue?');" type="submit" name="create" value="ADD-Product">
             </div>
         </div>
     </div>
  
  </form>

</x-layout> 


