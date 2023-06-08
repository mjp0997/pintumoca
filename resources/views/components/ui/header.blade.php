<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
      <li class="nav-item">
         <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
         <a href="{{ route('home') }}" class="nav-link">Inicio</a>
      </li>
   </ul>

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
      <li class="nav-item">
         <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
         </a>
      </li>

      <li class="nav-item">
         <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
         </a>
      </li>
   </ul>
</nav>
<!-- /.navbar -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
   <!-- Control sidebar content goes here -->
   <div class="h-100 d-flex flex-column p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>

      <form action='{{ route('logout') }}' class="mt-auto" method="POST">
         @csrf
         @method('POST')
         
         <button type="submit" class="btn btn-danger btn-block">Cerrar sesión</button>
      </form>
   </div>
</aside>
<!-- /.control-sidebar -->