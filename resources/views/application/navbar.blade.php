<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('extensions.index') }}">Extensions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('jobs.index') }}">Jobs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('orders.index') }}">Orders</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <div class="input-group">
          <input type="search" class="form-control" placeholder="By name, address, phone...">
          <button class="btn btn-primary" type="button" id="button-addon2">Search</button>
        </div>
      </form>
    </div>
  </div>
</nav>
<br>
