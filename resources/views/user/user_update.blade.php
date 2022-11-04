<x-layout>
  <div>
    <x-welcomeNavBar>
    </x-welcomeNavBar> 
  </div>
 
   
<div>
    <form action="/user/update" method="post" enctype="multipart/form-data" >
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Update</h1>
                    <p>Please Edit  Information:</p>
                    
                    <hr class="mb-3">
                    

                    <label for="old">Old {{$field}}:</label>
                    <label >{{$data}}</label><br>

                     @if($field=='email')
                        <label for="new">New {{$field}} </label>
                        <input class="form-control" type="email" name="email"  placeholder="{{$data}}"   required>
                        <span class="text-danger">@error('email'){{$message}}@enderror</span><br>
                     @else
                        <label for="new">New {{$field}}</label>
                        <input class="form-control" type="text" name="new" placeholder="{{$data}}"    required>
                        <span class="text-danger">@error('new'){{$message}}@enderror</span><br>
                       
                     @endif  
                    <hr class="mb-3">
               
                    <input class="btn btn-primary" onclick="return confirm('Changes will be applied.Are you sure you want to continue?');" type="submit" name="create" value="Update">
                </div>
            </div>
        </div>

    </form>

</div>
</x-layout>