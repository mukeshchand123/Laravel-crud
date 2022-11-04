<x-layout>

<x-imageNavBar>
</x-imageNavBar>  


<div class="container">
  @if(Session::has('msg'))
                    <div class="alert alert-success">{{Session::get('msg')}}</div>
                    @endif

    <div class ="container" >

    <table align="center" border="1px" width="1000px" style="  text-align: center;">
<tr>
 
   <tr> <th colspan="8" ><h2>Product table</h2></th></tr>
    <th ><h2>S.n</h2></th>
   
    <th><h2>Product-Name</h2></th>
    <th><h2>Image</h2></th>
    <th><h2>Dir</h2></th>
    <th><h2>primary</h2></th>
   
    <th><h2>Action</h2></th>

    
</tr>
@foreach($image as $pro )



        <tr>
            <td> {{$pro->id}}</td>
            <td>{{ $pro->product->name}}</td>
            <td>{{$pro->name}}</td>
            <td><img src="{{ URL($pro->dir) }}" alt="Product Image" style = "height: 80px;width:80px;"> </td>
            <td>{{$pro->primary}}</td>
         
          
            @if($pro->primary)
            <td>Primary Image</td>
            @else
             <td><a href="../delete/{{$pro->id}}"  onclick=\"return confirm('Are you sure you want to delete?');\">Delete  <a href="../primary/{{$pro->id}}"  onclick=\"return confirm('Are you sure you want to Make this image primary?');\">Make Primary</td> 
            @endif    
        </tr>     


@endforeach
</table>
</div>

</x-layout>