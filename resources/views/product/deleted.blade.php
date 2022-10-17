<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<title>PHP|CRUD</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/welcome">PHP|CRUD</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../product/fetch">Product</a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="../category/fetch">Category</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../product/add">Add Product</a>
      </li>

      
      <li class="nav-item">
        <a class="nav-link" href="../product/deleted">Deleted Product</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="/logout">Logout</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="/settings">Settings</a>
      </li>
    </ul>
  </div>
</nav>

<!-- forms -->

    <!-- product according to category -->   
  
    <!-- search form -->

    <div class ="container" >

    <table align="center" border="1px" width="1000px" style="  text-align: center;">
<tr>
 
   <tr> <th colspan="8" ><h2>Product table</h2></th></tr>
    <th ><h2>S.n</h2></th>
    <th ><h2>userid</h2></th>
    <th><h2>Product-Name</h2></th>
    <th><h2>Product-category</h2></th>
    <th><h2>Product-price</h2></th>
    <th><h2>Image</h2></th>
    <th><h2>Action</h2></th>

    
</tr>
@foreach($product as $pro )
@foreach($pro->category as $cat)

        <tr>
            <td> {{$pro->id}}</td>
            <td>{{$pro->userid}}</td>
            <td>{{$pro->name}}</td>
            <td>{{$cat->name}}</td>
            <td>{{$pro->price}}</td>
            <td><a href="product/image/fetch/{{$pro->id}}">Image</td>
             <td><a href="restore/{{$pro->id}}"  onclick=\"return confirm('Are you sure you want to restore?');\">Restore </td> 
        </tr>     


     
@endforeach
@endforeach

</tablw>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
