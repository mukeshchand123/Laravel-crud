<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>User Details</title>
</head>
<body>
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/welcome">PHP|Product Manager</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../category/fetch">Category</a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="../product/fetch">Product</a>
      </li>

      
      <li class="nav-item">
        <a class="nav-link" href="../settings">Settings</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../logout">Logout</a>
      </li>
      
    </ul>
  </div>
</nav>
    </div>
 
    <div class="container">
      <h1>User Details</h1> 
      <hr>  
       @foreach($user as $value)
       <p>
        First Name : {{$value->firstname}}<a href="user_update/{{'firstname'}}"> Edit</a><br>
        Last Name : {{$value->lastname}}<a href="user_update/{{'lastname'}}"> Edit</a><br>
        Contact : {{$value->phn}}<a href="user_update/{{'phn'}}"> Edit</a><br>
        Email : {{$value->email}}<a href="user_update/{{'email'}}"> Edit</a><br>
       </p>
       @endforeach
       <hr>  
       <a href="delete"  onclick="return confirm('Are you sure you want to delete?');">Delete Account</a>
     
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>