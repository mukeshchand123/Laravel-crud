<x-layout>

  <x-sizeNavBar>
  </x-sizeNavBar> 
   
<div>
    <form action="/size/update/{{$size->id}}" method="post" enctype="multipart/form-data" >
    @csrf
   
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Update</h1>
                    <p>Please Edit  Information:</p>
                    
                    <hr class="mb-3">
                    

                    <label for="size">Product Size</label>
                    <input class="form-control" type="text" name="size" value="{{$size->productSize}}" required><br>
              
                   
                        
                    <hr class="mb-3">
               
                    <input class="btn btn-primary"  onclick="return confirm('Are you sure you want to continue?');" type="submit" name="create" value="Update">
                </div>
            </div>
        </div>

    </form>

</div>
</x-layout>