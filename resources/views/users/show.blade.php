@extends('layouts.dashboard')

@section('content')
@if (isset($user))
   <div class='row'>
      <div class='col-12 col-md-9'>
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Detalles del usuario</h3>
            </div>

            <div class="card-body">
               <div class='row'>
                  <div class='col-12 col-md'>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>

                        <input type="email" class="form-control" placeholder="Enter email" value="{{ $user->name }}" disabled>
                     </div>
                  </div>

                  <div class='col-12 col-md'>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>

                        <input type="email" class="form-control" placeholder="Enter email" value="{{ $user->email }}" disabled>
                     </div>
                  </div>
               </div>

               <div class='row'>
                  <div class='col-12 col-md'>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Rol</label>

                        <input type="email" class="form-control" placeholder="Enter email" value="{{ $user->role->name }}" disabled>
                     </div>
                  </div>

                  <div class='col-12 col-md'>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Sucursal</label>

                        <input type="email" class="form-control" placeholder="Enter email" value="{{ $user->office?->name ?? '-' }}" disabled>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.card-body -->
         </div>
      </div>

      <div class='col-12 col-md-3'>
         <form class='card' action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class='card-body d-flex flex-column gap-3'>
               <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-block">Lista de usuarios</a>

               <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-warning btn-block">Editar</a>
               
               <button type="submit" class="btn btn-danger btn-block">Eliminar</button>
            </div>
         </form>
      </div>
   </div>
@else
   @include('components.ui.404')
@endif
@endsection