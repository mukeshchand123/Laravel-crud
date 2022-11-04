<x-layout>

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
{{-- <div class="container">
    <!-- product according to category -->   
    <form action="/product/searchCategory" method="post" style=" float:left" >
    @csrf
                <label for="productCategory">Product Category</label>
                  <select name = "dropdown[]" multiple required>
                    @foreach($category as $cat)
                    @if($search!='' && in_array($cat->id,$search))
                    <option value = "{{$cat->id}}" selected>{{$cat->name}}</option>
                   
                    @else
                    <option value = "{{$cat->id}}">{{$cat->name}}</option>
                    @endelse
                    @endif
                    @endforeach                           
                  </select>
                  <input for ="dropdown"  class=" btn-primary" type="submit" name="submit" value="Select" style="margin: 2px;position:relative;">            
    </form>
    
    <!-- search form -->
    <form action="search" method="post" style=" float:right">
    @csrf
          <input type="text" name="search" style="margin: 2px;position:relative;left:0%;" placeholder="Search" required>
          <input for="search" class=" btn-primary" type="submit" name="create" value="Search" style="margin:2px;position:relative;">
    </form> 
</div><br><br><br><br><br> --}}
<div class="container">
  <h1>Product List</h1>
  @foreach ($product as $prod )
  <hr>
    Name:{{$prod->name}}<br>
    Category:
    @foreach ($prod->category as $cat )
    {{"|"}}
    {{ $cat->name }} 
    {{"|"}}
    @endforeach
    <br>
    Size:
    @foreach ($prod->size as $size )
    {{"|"}}
    {{$size->productSize}}   
    {{"|"}}
    @endforeach
    <br>
    Price:{{$prod->price}} <br>
    Image: 
    @foreach ($prod->image->sortByDesc('primary') as $img )
    @if ($img->primary == 1)
    <img src="{{ URL($img->dir) }}" alt="Product Image" style = "height: 140px;width:140px;">
    @else
    <img src="{{ URL($img->dir) }}" alt="Product Image" style = "height: 120px;width:120px;">
    @endif
      
    @endforeach 
    <hr> 
  @endforeach


</div>

</x-layout>