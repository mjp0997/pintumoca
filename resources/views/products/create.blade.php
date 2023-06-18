@extends('layouts.dashboard')

@section('content')
<div class='row'>
   <div class='col-12 col-md-9'>
      <form class="card" action="{{ route('products.store') }}" method="POST">
         @csrf
         @method('POST')

         <div class="card-header">
            <h3 class="card-title">Crear producto</h3>
         </div>

         <div class="card-body">
            <div class='row'>
               <div class='col-12 col-md-6'>
                  <div class="form-group">
                     <label for="name">Nombre</label>

                     <input
                        type="text"
                        class="form-control @if($errors->has('name')) is-invalid @endif"
                        name="name"
                        value="{{ old('name', '') }}"
                        autocomplete="off"
                        placeholder="Ingrese el nombre del producto"
                        id="name"
                     >

                     @error('name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                     @enderror
                  </div>
               </div>

               <div class='col-12 col-md-6'>
                  <div class="form-group">
                     <label for="code">Código</label>

                     <input
                        type="text"
                        class="form-control @if($errors->has('code')) is-invalid @endif"
                        name="code"
                        value="{{ old('code', '') }}"
                        autocomplete="off"
                        placeholder="Ingrese el código del producto"
                        id="code"
                     >

                     @error('code')
                        <span class="error invalid-feedback">{{ $message }}</span>
                     @enderror
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
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-block">Lista de productos</a>
         </div>
      </div>
   </div>
</div>
@endsection