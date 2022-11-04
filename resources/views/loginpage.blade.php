<x-layout>

  <x-loginNavBar>
  </x-loginNavBar> 
  
  
  
  <div>
      <form action="/login" method="post" enctype="multipart/form-data" >
     
          <div class="container">
              <div class="row">
                  <div class="col-sm-3">
                      <h1>Login</h1>
                      <p>Please Enter Valid Information:</p>
                      @if(Session::has('fail1'))
                      <div class="alert alert-success">{{Session::get('fail1')}}</div>
                      @endif
                      @if(Session::has('fail2'))
                      <div class="alert alert-success">{{Session::get('fail2')}}</div>
                      @endif
                      @csrf
                      <hr class="mb-3">
                     
                      <label for="email">Email</label>
                      <input class="form-control" type="email" name="email"  placeholder="something@other.com" value="{{old('email')}}"  required>
                      <span class="text-danger">@error('email'){{$message}}@enderror</span>                  
  
                      <label for="password">Password</label>
                      <input class="form-control" type="password" name="password"  placeholder="Password" required><br>
                      <span class="text-danger">@error('password'){{$message}}@enderror</span>
                      
                      
                       
  
                      <hr class="mb-3">
                      
                      <input class="btn btn-primary" type="submit" name="create" value="Login">
                  </div>
              </div>
          </div>
  
      </form>
  
  </div>

</x-layout>  




