<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="index3.html" class="brand-link text-center">
      <span class="brand-text font-weight-light">PINTUMOCA</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <a href="#" class="w-100 text-center">Alexander Pierce</a>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item {{ request()->is('sales*') ? 'menu-open' : '' }}">
               <a href="#" class="nav-link {{ request()->is('sales*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-receipt"></i>

                  <p>
                     Ventas
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>

               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('sales.index') }}" class="nav-link {{ request()->is('sales') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>

                        <p>Listado</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ route('sales.create') }}" class="nav-link {{ request()->is('sales/create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>

                        <p>Crear</p>
                     </a>
                  </li>
               </ul>
            </li>

            <li class="nav-item {{ request()->is('products*') ? 'menu-open' : '' }}">
               <a href="#" class="nav-link {{ request()->is('products*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-boxes"></i>

                  <p>
                     Productos
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>

               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('products.index') }}" class="nav-link {{ request()->is('products') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>

                        <p>Listado</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ route('products.create') }}" class="nav-link {{ request()->is('products/create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>

                        <p>Crear</p>
                     </a>
                  </li>
               </ul>
            </li>

            <li class="nav-item {{ request()->is('users*') ? 'menu-open' : '' }}">
               <a href="#" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-users"></i>

                  <p>
                     Usuarios
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>

               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>

                        <p>Listado</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ route('users.create') }}" class="nav-link {{ request()->is('users/create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>

                        <p>Crear</p>
                     </a>
                  </li>
               </ul>
            </li>

            <li class="nav-item {{ request()->is('offices*') ? 'menu-open' : '' }}">
               <a href="#" class="nav-link {{ request()->is('offices*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-building"></i>

                  <p>
                     Sucursales
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>

               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('offices.index') }}" class="nav-link {{ request()->is('offices') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>

                        <p>Listado</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ route('offices.create') }}" class="nav-link {{ request()->is('offices/create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>

                        <p>Crear</p>
                     </a>
                  </li>
               </ul>
            </li>

            <li class="nav-item {{ request()->is('payment-methods*') ? 'menu-open' : '' }}">
               <a href="#" class="nav-link {{ request()->is('payment-methods*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-money-check-alt"></i>

                  <p>
                     Métodos de pago
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>

               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('payment-methods.index') }}" class="nav-link {{ request()->is('payment-methods') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>

                        <p>Listado</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ route('payment-methods.create') }}" class="nav-link {{ request()->is('payment-methods/create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>

                        <p>Crear</p>
                     </a>
                  </li>
               </ul>
            </li>
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>