@extends('layouts.dashboard')

@section('head')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom-select2.css') }}">
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
      <form class="card" action="{{ route('users.update', ['id' => $user->id]) }}" method="POST">
         @csrf
         @method('PUT')
         
         <div class="card-header">
            <h3 class="card-title">Editar usuario</h3>
         </div>

         <div class="card-body">
            <div class='row'>
               <div class='col-12 col-md'>
                  <div class="form-group">
                     <label for="name">Nombre</label>

                     <input
                        type="text"
                        class="form-control @if($errors->has('name')) is-invalid @endif"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        autocomplete="off"
                        placeholder="Ingrese el nombre del usuario"
                        id="name"
                     >

                     @error('name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                     @enderror
                  </div>
               </div>

               <div class='col-12 col-md'>
                  <div class="form-group">
                     <label for="email">Email</label>

                     <input
                        type="email"
                        class="form-control @if($errors->has('email')) is-invalid @endif"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        autocomplete="off"
                        placeholder="Ingrese el correo del usuario"
                        id="email"
                     >

                     @error('email')
                        <span class="error invalid-feedback">{{ $message }}</span>
                     @enderror
                  </div>
               </div>

               <div class='col-12 col-md'>
                  <div class="form-group">
                     <label for="password">Contraseña (Actualizar)</label>

                     <input
                        type="password"
                        class="form-control @if($errors->has('password')) is-invalid @endif"
                        name="password"
                        value="{{ old('password', '') }}"
                        autocomplete="off"
                        placeholder="Ingrese la contraseña del usuario"
                        id="password"
                     >

                     @error('password')
                        <span class="error invalid-feedback">{{ $message }}</span>
                     @enderror
                  </div>
               </div>
            </div>

            <div class='row'>
               <div class='col-12 col-md'>
                  <div class="form-group">
                     <label for="office_id">Sucursal</label>
                     
                     <select
                        class="form-control select2 text-center @if($errors->has('office_id')) is-invalid @endif"
                        style="width: 100%;"
                        name="office_id"
                        id="office_id"
                     >
                        <option value='' disabled {{ old('office_id', $user->office_id) == '' ? 'selected' : '' }}>Seleccione una sucursal</option>
                        
                        @foreach ($offices as $office)
                           <option value='{{ $office->id }}' {{ old('office_id', $user->office_id) == $office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                        @endforeach
                     </select>

                     @error('office_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                     @enderror
                  </div>
               </div>

               <div class='col-12 col-md'>
                  <div class="form-group mb-md-0">
                     <label for="role_id">Rol</label>

                     <select
                        class="form-control text-center @if($errors->has('role_id')) is-invalid @endif"
                        name="role_id"
                        id="role_id"
                     >
                        <option value='' disabled {{ old('role_id', $user->role_id) == '' ? 'selected' : '' }}>Seleccione un rol</option>
                        
                        @foreach ($roles as $role)
                           <option value='{{ $role->id }}' {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->display_name }}</option>
                        @endforeach
                     </select>

                     @error('role_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                     @enderror
                  </div>
               </div>
            </div>
         </div>
         <!-- /.card-body -->

         <div class='card-footer'>
            <div class='d-flex justify-content-end'>
               <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
         </div>
      </form>
   </div>

   <div class='col-12 col-md-3'>
      <div class='card'>
         <div class='card-body d-flex flex-column gap-3'>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-block">Lista de usuarios</a>
         </div>
      </div>
   </div>
</div>
@endsection