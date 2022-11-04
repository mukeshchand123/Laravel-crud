<x-layout>
<x-productNavBar>
</x-productNavBar> 

<!-- forms -->
<div class="container">
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
</div><br><br><br><br><br>

    <div class ="container" >

    <table align="center" border="1px" width="1000px" style="  text-align: center;">
<tr>
 
   <tr> <th colspan="8" ><h2>Product table</h2></th></tr>
    <th ><h2>S.n</h2></th>
    <th ><h2>userid</h2></th>
    <th><h2>Product-Name</h2></th>
    <th><h2>Product-Category</h2></th>
    <th><h2>Product-Size</h2></th>
    <th><h2>Product-Price</h2></th>
    <th><h2>Product-Image</h2></th>
    <th><h2>Image Manager</h2></th>
    <th><h2>Action</h2></th>

    
</tr>
@foreach($product as $pro )
@foreach($pro->category as $cat)
@foreach($pro->size as $value)
@foreach($pro->image as $img)
@if($search!='' && in_array($cat->id,$search) &&  $searchAll==''&& $img->primary==1 )
        <tr>
            <td> {{$pro->id}}</td>
            <td>{{$pro->userid}}</td>
            <td>{{$pro->name}}</td>
            <td>{{$cat->name}}</td>
            <td>{{$value->productSize}}</td>
            <td>{{$pro->price}}</td>
            {{-- <td><td>{{$img->dir}} </td> </td> --}}
            <td><img src="{{ URL($img->dir) }}" alt="Product Image" style = "height: 80px;width:80px;"> </td>
            <td><a href="../product/image/fetch/{{$pro->id}}">AllImage</td>
             <td><a href="delete/{{$pro->id}}"  onclick=\"return confirm('Are you sure you want to delete?');\">Delete <a href="update/{{$pro->id}}">Update </td> 
        </tr>     
@endif 
    

@if($search=='' && $searchAll!='' && $img->primary==1  )
        <tr>
            <td> {{$pro->id}}</td>
            <td>{{$pro->userid}}</td>
            <td>{{$pro->name}}</td>
            <td>{{$cat->name}}</td>
            <td>{{$value->productSize}}</td>
            <td>{{$pro->price}}</td>
            <td><img src="{{ URL($img->dir) }}" alt="Product Image" style = "height: 80px;width:80px;"> </td>
            <td><a href="../../product/image/fetch/{{$pro->id}}">AllImage</td>
            
             <td><a href="delete/{{$pro->id}}"  onclick=\"return confirm('Are you sure you want to delete?');\">Delete <a href="update/{{$pro->id}}">Update </td> 
        </tr>     
@endif
@if($search=='' && $searchAll=='' && $img->primary==1  )
<tr>
            <td> {{$pro->id}}</td>
            <td>{{$pro->userid}}</td>
            <td>{{$pro->name}}</td>
            <td>{{$cat->name}}</td>
            <td>{{$value->productSize}}</td>
            <td>{{$pro->price}}</td>
            <td><img src="{{ URL($img->dir) }}" alt="Product Image" style = "height: 80px;width:80px;"> </td>
            <td><a href="/product/image/fetch/{{$pro->id}}">AllImage</td>
            
             <td><a href="delete/{{$pro->id}}"  onclick=\"return confirm('Are you sure you want to delete?');\">Delete <a href="update/{{$pro->id}}">Update </td> 
        </tr>
@endif      
@endforeach
@endforeach
@endforeach
@endforeach
<h2><a href="/product/productlist">Product list</a></h2><br>
</table>

</div>



</x-layout>
