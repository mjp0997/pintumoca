@extends('layouts.dashboard')

@section('head')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
   $(function() {
      $('.select2').select2();
   });
</script>
@endsection

@section('content')
<div class='row'>
   <div class='col-12 col-md-9'>
      <form class="card">
         <div class="card-header">
            <h3 class="card-title">Crear usuario</h3>
         </div>

         <div class="card-body">
            <div class='row'>
               <div class='col-12 col-md-6'>
                  <div class="form-group">
                     <label for="name">Nombre</label>

                     <input
                        type="text"
                        class="form-control"
                        name="name"
                        autocomplete="off"
                        placeholder="Ingrese el nombre del usuario"
                        id="name"
                     >
                  </div>
               </div>

               <div class='col-12 col-md-6'>
                  <div class="form-group">
                     <label for="office_id">Sucursal</label>
                     
                     <select
                        class="form-control select2"
                        style="width: 100%;"
                        name="office_id"
                        id="office_id"
                     >
                        <option disabled selected>Seleccione una sucursal</option>
                        <option>Alaska</option>
                        <option>California</option>
                        <option>Delaware</option>
                        <option>Tennessee</option>
                        <option>Texas</option>
                        <option>Washington</option>
                     </select>
                  </div>
               </div>
            </div>

            <div class='row'>
               <div class='col-12 col-md-6'>
                  <div class="form-group">
                     <label for="email">Email</label>

                     <input
                        type="email"
                        class="form-control"
                        name="email"
                        autocomplete="off"
                        placeholder="Ingrese el correo del usuario"
                        id="email"
                     >
                  </div>
               </div>

               <div class='col-12 col-md-6'>
                  <div class="form-group">
                     <label for="password">Contraseña</label>

                     <input
                        type="password"
                        class="form-control"
                        name="password"
                        autocomplete="off"
                        placeholder="Ingrese la contraseña del usuario"
                        id="password"
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
            <a href="#" class="btn btn-outline-secondary btn-block">Lista de usuarios</a>
         </div>
      </div>
   </div>
</div>
@endsection