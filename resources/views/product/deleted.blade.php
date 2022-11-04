<x-layout>

  

  <x-productNavBar>
  </x-productNavBar> 

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


</x-layout>