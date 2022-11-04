<x-layout>

  <x-productNavBar>
  </x-productNavBar> 

<form action="/update/{{$product->id}}" method="post" enctype="multipart/form-data" >
    @csrf
   
   <div class="container">
       <div class="row">
           <div class="col-sm-3">
              
               
               <hr class="mb-3">
              
               <label for="productName">Product Name</label>
               <input class="form-control" type="productName" name="productName" placeholder="Product Name" value="{{$product->name}}" required><br><br>
              
              
               <label for="productCategory">Product Category</label>
                  <select name = "dropdown[]"  multiple required>
                    @foreach($category as $value)
                        @if(in_array($value->id,$cat))
                        <option value = "{{$value->id}}" selected>{{$value->name}}</option>
                        @else
                        <option value = "{{$value->id}}">{{$value->name}}</option>
                        @endelse
                        @endif
                    @endforeach    
                  </select><br><br>
                  <label for="size">Product size</label>
                  <select name = "size[]"  multiple required>
                    @foreach($size as $value)
                        @if(in_array($value->id,$productSize))
                        <option value = "{{$value->id}}" selected>{{$value->productSize}}</option>
                        @else
                        <option value = "{{$value->id}}">{{$value->productSize}}</option>
                        @endelse
                        @endif
                    @endforeach    
                  </select><br><br>
                  
                  
             
               <label for="productPrice">Product Price</label>
               <input class="form-control" type="productPrice" name="productPrice"  placeholder="Product Price"  value="{{$product->price}}"  required><br><br>

               <label for="file">Product Image</label>
               <input type="file" name="file[]" id="file" accept="image/jpeg" multiple required><br><br>
                        
               <hr class="mb-3">
               
               <input class="btn btn-primary"  onclick="return confirm('Are you sure you want to continue?');" type="submit" name="create" value="Update-Product">
           </div>
       </div>
   </div>

</form>


</x-layout>