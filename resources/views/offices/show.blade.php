@extends('layouts.dashboard')

@section('content')
<div class='row'>
   <div class='col-12 col-md-9'>
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Detalles de la sucursal</h3>
         </div>

         <div class="card-body">
            <div class='row'>
               <div class='col-12'>
                  <div class="form-group">
                     <label>Nombre</label>

                     <input type="text" class="form-control" value="PINTUMOCA" disabled>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.card-body -->
      </div>
   </div>

   <div class='col-12 col-md-3'>
      <div class='card'>
         <div class='card-body d-flex flex-column gap-3'>
            <a href="{{ route('offices.index') }}" class="btn btn-outline-secondary btn-block">Lista de sucursales</a>

            <a href="#" class="btn btn-warning btn-block">Editar</a>
            
            <a href="#" class="btn btn-danger btn-block">Eliminar</a>
         </div>
      </div>
   </div>
</div>
@endsection