<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>User Registration</title>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/register">PHP|CRUD</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/loginpage">Login</a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="/register">Register</a>
      </li>
    </ul>
  </div>
</nav>


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

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>