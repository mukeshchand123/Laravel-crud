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

  <x-categoryNavbar>
  </x-categoryNavbar> 

<div class = "container">
@if(Session::has('message'))
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                    @endif
    <table  border="1px" align="center" width="800px" style="text-align: center;">
      <tr>
          <tr> <th colspan="8" ><h2>Category table</h2></th></tr>
             <th ><h2>S.n</h2></th>
             <th ><h2>userid</h2></th>
             <th><h2>Cat-Name</h2></th>
             <th><h2>Cat-Description</h2></th>
             <th><h2>Action</h2></th>
      </tr>
  @foreach($data as $category )
        <tr>
            <td> {{$category->id}}</td>
            <td>{{$category->userid}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->description}}</td>
            
             <td><a href="delete/{{$category->id}}"  onclick=\"return confirm('Are you sure you want to delete?');\">Delete <a href="update/{{$category->id}}">Update </td> 
        </tr>     
     
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
