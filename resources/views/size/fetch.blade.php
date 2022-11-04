<x-layout>

<x-sizeNavBar>
</x-sizeNavBar> 

<div class = "container">
@if(Session::has('message'))
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                    @endif
    <table  border="1px" align="center" width="800px" style="text-align: center;">
      <tr>
          <tr> <th colspan="8" ><h2>Size table</h2></th></tr>
             <th ><h2>S.n</h2></th>
             <th ><h2>userid</h2></th>
             <th><h2>Product Sizes</h2></th>
             
             <th><h2>Action</h2></th>
      </tr>
  @foreach($data as $size )
        <tr>
            <td> {{$size->id}}</td>
            <td>{{$size->userid}}</td>
            <td>{{$size->productSize}}</td>
            
            
             <td><a href="delete/{{$size->id}}"  onclick=\"return confirm('Are you sure you want to delete?');\">Delete <a href="edit/{{$size->id}}">Update </td> 
        </tr>     
     
   @endforeach

</tablw>
</div>


</x-layout>