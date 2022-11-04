<x-layout>
<div>
  <x-welcomeNavBar>
  </x-welcomeNavBar> 
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

</x-layout>