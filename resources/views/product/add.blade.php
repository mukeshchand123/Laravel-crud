<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
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
        <a class="nav-link" href="../logout">Logout</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="../settings">Settings</a>
      </li>
    </ul>
  </div>
</nav>

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
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>