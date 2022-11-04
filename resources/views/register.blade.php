<x-layout>
  
 
  <x-loginNavBar>
  </x-loginNavBar>
  
  <div>
      <form action="/store" method="post" enctype="multipart/form-data" >
     
          <div class="container">
              <div class="row">
                  <div class="col-sm-3">
                      <h1>Registration</h1>
                      <p>Please Enter Valid Information:</p>
                      @if(Session::has('success'))
                      <div class="alert alert-success">{{Session::get('success')}}</div>
                      @endif
                      @if(Session::has('fail'))
                      <div class="alert alert-success">{{Session::get('fail')}}</div>
                      @endif
                      @csrf
                      <hr class="mb-3">
                     
                      <label for="firstName">First Name</label>
                      <input class="form-control" type="firstName" name="firstName" placeholder="First Name" value="{{old('firstName')}}" required><br>
                      <span class="text-danger">@error('firstName'){{$message}}@enderror</span>
                     
  
                      <label for="lastName">Last Name</label>
                      <input class="form-control" type="lastName" name="lastName"  placeholder="Last Name" value="{{old('lastName')}}" required><br>
                      <span class="text-danger">@error('lastName'){{$message}}@enderror</span>
  
  
                      <label for="phnNumber">Phone Number</label>
                      <input class="form-control" type="phnNumber" name="phnNumber"  placeholder="Phone Number" value="{{old('phnNumber')}}" required><br>
                      <span class="text-danger">@error('phnNumber'){{$message}}@enderror</span>
  
                      <label for="email">Email</label>
                      <input class="form-control" type="email" name="email"  placeholder="something@other.com" value="{{old('email')}}"  required>
                      <span class="text-danger">@error('email'){{$message}}@enderror</span>
  
  
                      <label for="password">Password</label>
                      <input class="form-control" type="password" name="password"  placeholder="Password" value="{{old('password')}}" required><br>
                      <span class="text-danger">@error('password'){{$message}}@enderror</span>
                      
                      
                      <label for="confirm-password">Confirm Password</label>
                      <input class="form-control" type="password" name="confirm-password"  placeholder="Password" value="{{old('confirm-password')}}" required>
                      <span class="text-danger">@error('confirm-password'){{$message}}@enderror</span>
                       
                      <hr class="mb-3">
                      
                      <input class="btn btn-primary" type="submit" name="create" value="Sign Up">
                  </div>
              </div>
          </div>
  
      </form>
  
  </div>
  

</x-layout> 



