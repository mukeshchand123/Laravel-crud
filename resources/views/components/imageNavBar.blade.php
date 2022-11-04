<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/welcome">PHP|CRUD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="../../fetch">Product</a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="../../../category/fetch">Category</a>
        </li>
        
        
        <li class="nav-item">
          <a class="nav-link" href="../deleted">Deleted Image</a>
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

  {{$slot}}