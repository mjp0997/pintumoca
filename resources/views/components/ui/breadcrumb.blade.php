<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">{{ $breadcrumb[count($breadcrumb) - 1]['text'] }}</h1>
         </div><!-- /.col -->

         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item">
                  <a href="{{ route('home') }}">Inicio</a>
               </li>

               @foreach ($breadcrumb as $bread)
                  @if ($loop->last)
                     <li class="breadcrumb-item">{{ $bread['text'] }}</li>
                  @else
                     <li class="breadcrumb-item active">
                        <a href="{{ route($bread['route']) }}">{{ $bread['text'] }}</a>
                     </li>   
                  @endif
               @endforeach
            </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->