@extends('layouts.dashboard')

@section('content')
<div class='row'>
   <div class='col-12 col-md-9'>
      <form class="card">
         <div class="card-header">
            <h3 class="card-title">Crear sucursal</h3>
         </div>

         <div class="card-body">
            <div class='row'>
               <div class='col-12'>
                  <div class="form-group">
                     <label for="name">Nombre</label>

                     <input
                        type="text"
                        class="form-control"
                        name="name"
                        autocomplete="off"
                        placeholder="Ingrese el nombre de la sucursal"
                        id="name"
                     >
                  </div>
               </div>
            </div>
         </div>
         <!-- /.card-body -->

         <div class='card-footer'>
            <div class='d-flex justify-content-end'>
               <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
         </div>
      </form>
   </div>

   <div class='col-12 col-md-3'>
      <div class='card'>
         <div class='card-body d-flex flex-column gap-3'>
            <a href="{{ route('offices.index') }}" class="btn btn-outline-secondary btn-block">Lista de sucursales</a>
         </div>
      </div>
   </div>
</div>
@endsection