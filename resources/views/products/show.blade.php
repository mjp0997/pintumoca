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
               <div class='col-12 col-md-6'>
                  <div class="form-group">
                     <label>Nombre</label>

                     <input type="text" class="form-control" value="MPERCOAT PLUS BLANCO" disabled>
                  </div>
               </div>

               <div class='col-12 col-md-6'>
                  <div class="form-group">
                     <label>Código</label>

                     <input type="text" class="form-control" value="FA0-20410001" disabled>
                  </div>
               </div>
            </div>

            <p class="text-center text-primary border-bottom"><b>Stock</b></p>

            <div class='row'>
               <div class='col-12 col-md'>
                  <div class="form-group">
                     <label class="d-block text-center">PINTUMOCA</label>

                     <input type="text" class="form-control text-center" value="10" disabled>
                  </div>
               </div>

               <div class='col-12 col-md'>
                  <div class="form-group">
                     <label class="d-block text-center">PINTUMOCA</label>

                     <input type="text" class="form-control text-center" value="10" disabled>
                  </div>
               </div>

               <div class='col-12 col-md'>
                  <div class="form-group">
                     <label class="d-block text-center">PINTUMOCA</label>

                     <input type="text" class="form-control text-center" value="10" disabled>
                  </div>
               </div>
            </div>

            <p class="mb-0">TODO</p>

            <ul>
               <li>Editar stock (Botón bajo el input de cada stock)</li>
               <li>Incrementar stock (Botón bajo el input de cada stock)</li>
               <li>Mover stock</li>
            </ul>
         </div>
         <!-- /.card-body -->
      </div>
   </div>

   <div class='col-12 col-md-3'>
      <div class='card'>
         <div class='card-body d-flex flex-column gap-3'>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-block">Lista de productos</a>

            <a href="#" class="btn btn-warning btn-block">Editar</a>
            
            <a href="#" class="btn btn-danger btn-block">Eliminar</a>
         </div>
      </div>
   </div>
</div>
@endsection