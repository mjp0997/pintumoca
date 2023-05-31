<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   @include('components.ui.head')
</head>

<body>
   <div class="wrapper">
      @include('components.ui.header')
   
      @include('components.ui.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         @include('components.ui.breadcrumb')

         <!-- Main content -->
         <div class="content">
            <div class="container-fluid">
               @yield('content')
            </div><!-- /.container-fluid -->
         </div>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      @include('components.ui.footer')
   </div>

   @include('components.ui.scripts')

   @yield('scripts')
</body>
</html>