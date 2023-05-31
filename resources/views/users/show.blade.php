@extends('layouts.dashboard')

@section('content')
<div class='row'>
   <div class='col-12 col-md-9'>
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Detalles del usuario</h3>
         </div>

         <div class="card-body">
            <div class='row'>
               <div class='col-12 col-md-4'>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Nombre</label>

                     <input type="email" class="form-control" placeholder="Enter email" value="Alexander Pierce" disabled>
                  </div>
               </div>

               <div class='col-12 col-md-4'>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Email</label>

                     <input type="email" class="form-control" placeholder="Enter email" value="apierce@gmail.com" disabled>
                  </div>
               </div>

               <div class='col-12 col-md-4'>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Sucursal</label>

                     <input type="email" class="form-control" placeholder="Enter email" value="PINTUMOCA" disabled>
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
            <a href="#" class="btn btn-outline-secondary btn-block">Lista de usuarios</a>

            <a href="#" class="btn btn-warning btn-block">Editar</a>
            
            <a href="#" class="btn btn-danger btn-block">Eliminar</a>
         </div>
      </div>
   </div>
</div>
@endsection