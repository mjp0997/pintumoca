@extends('layouts.dashboard')

@section('custom-head')
   <link rel='stylesheet' href='{{ asset('css/sales-create.css') }}'>
   <link rel='stylesheet' href='{{ asset('css/sales-modal.css') }}'>

   <meta name="products-link" content="{{ route('products.api-index') }}" id="products-api-link">
@endsection

@section('scripts')
<script src='{{ asset('js/procedures-dynamic-form.js') }}'></script>
@endsection

@section('content')
<div class='row'>
   <div class='col-12 col-md-9'>
      <form class="card" action="{{ route('procedures.store') }}" method="POST">
         @csrf
         @method('POST')

         <div class="card-header">
            <h3 class="card-title">Crear entrega</h3>
         </div>

         @if (count(old('products', [])) > 0)
            <input type='hidden' disabled id="old-products" value="{{ json_encode(old('products')) }}">
         @endif


         @if ($errors->any())
            <input type='hidden' disabled id="errors" value="{{ json_encode((array) $errors) }}">
         @endif

         <div class="card-body">
            <div class='row'>
               @if (!isset(Auth::user()?->office_id))
                  <div class='col-12 col-md'>
                     <div class="form-group">
                        <label for="from_office_id">Origen</label>

                        <select
                           class="form-control text-center @if($errors->has('from_office_id')) is-invalid @endif"
                           name="from_office_id"
                           id="from_office_id"
                        >
                           <option value='' disabled {{ old('from_office_id', '') == '' ? 'selected' : '' }}>Seleccione una sucursal</option>
                           
                           @foreach ($offices as $office)
                              <option value='{{ $office->id }}' {{ old('from_office_id', '') == $office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                           @endforeach
                        </select>

                        @error('from_office_id')
                           <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                     </div>
                  </div>
               @else
                  <input type='hidden' id="from_office_id" name='from_office_id' value="{{ Auth::user()->office_id }}">
               @endif

               <div class='col-12 col-md'>
                  <div class="form-group">
                     <label for="to_office_id">Destino</label>

                     <select
                        class="form-control text-center @if($errors->has('to_office_id')) is-invalid @endif"
                        name="to_office_id"
                        id="to_office_id"
                     >
                        <option value='' disabled {{ old('to_office_id', '') == '' ? 'selected' : '' }}>Seleccione una sucursal</option>
                        
                        @foreach ($offices as $office)
                           @if ($office->id !== Auth::user()?->office_id)
                              <option value='{{ $office->id }}' {{ old('to_office_id', '') == $office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                           @endif
                        @endforeach
                     </select>

                     @error('to_office_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                     @enderror
                  </div>
               </div>

               <div class='col-12 col-md'>
                  <div class="form-group">
                     <label for="date">Fecha</label>

                     <input
                        type="date"
                        class="form-control @if($errors->has('date')) is-invalid @endif"
                        name="date"
                        value="{{ old('date', '') }}"
                        autocomplete="off"
                        placeholder="Ingrese la fecha de la entrega"
                        id="date"
                     >

                     @error('date')
                        <span class="error invalid-feedback">{{ $message }}</span>
                     @enderror
                  </div>
               </div>
            </div>

            <hr class="my-5">

            <div class="row">
               <div class="col-12">
                  <div class='d-flex justify-content-between align-items-center mb-3'>
                     <div class='d-flex flex-column'>
                        <h4 class="mb-0 @if($errors->has('cart')) text-danger is-invalid @endif">Productos</h4>

                        @error('cart')
                           <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                     </div>

                     <button type="button" class="btn btn-sm btn-success open-modal-btn" data-modal-id='product-modal'>
                        <i class='fas fa-plus'></i>
                        Agregar
                     </button>
                  </div>

                  <div class='d-flex flex-column' id='cart-container'>
                     {{-- <div class="sale-row">
                        <div class='row'>
                           <div class='col-12 col-md-5'>
                              <div class="w-100 h-100 d-flex flex-column justify-content-center">
                                 <span class="d-block">
                                    <a href="#"><b>IMPERCOAT PLUS BLANCO</b></a>
                                 </span>
   
                                 <small class="d-block">FA0-20410001</small>
   
                                 <small class="d-block mb-3 mb-md-0 text-right text-md-left">stock: <b>12</b></small>

                                 <input type='hidden' name='cart[][product_id]' value="">
                              </div>
                           </div>
   
                           <div class='col-12 col-md-7'>
                              <div class='row h-100'>
                                 <div class='col-6 col-md'>
                                    <div class='h-100 d-flex align-items-center justify-content-center'>
                                       <div class="form-group mb-0">
                                          <label class="mb-0 d-block text-center">Cantidad</label>
                     
                                          <input
                                             type="text"
                                             class="form-control text-center"
                                             name="cart[][quantity]"
                                             autocomplete="off"
                                             placeholder="Cantidad"
                                          >
                                       </div>
                                    </div>
                                 </div>
   
                                 <div class='col-6 col-md-2 d-flex mt-3 mt-md-0'>
                                    <button type="button" class='btn btn-danger btn-block my-md-auto'>
                                       <i class='fas fa-trash'></i>
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> --}}
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
            <a href="{{ route('procedures.index') }}" class="btn btn-outline-secondary btn-block">Lista de entregas</a>
         </div>
      </div>
   </div>
</div>

<div class='modal-container sales-modal-container' id="product-modal">
   <div class="modal-content sales-modal">
      <div class="modal-header">
         <h4 class="modal-title">Listado de productos</h4>

         <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
         </button>
      </div>

      <div class="modal-body d-flex flex-column">
         <form class='row' id="filter-form">
            <div class='col'>
               <div class="d-flex">
                  <div class="form-group flex-grow-1">
                     <label for="filter">Buscar</label>
      
                     <input
                        type="text"
                        class="form-control"
                        name="filter"
                        autocomplete="off"
                        placeholder="Ingrese el nombre o el código del producto"
                        id="filter"
                     >
                  </div>
               </div>
            </div>

            <div class='col-2 d-flex'>
               <button type="submit" class="btn btn-primary btn-block mt-auto mb-3">
                  <i class='fas fa-search'></i>
               </button>
            </div>

            <div class='col-2 d-flex'>
               <button type="button" class="btn btn-outline-secondary btn-block mt-auto mb-3" id="filter-clear">
                  <i class='fas fa-times'></i>
               </button>
            </div>
         </form>

         <div class="card-body table-responsive p-0 flex-grow-1 sales-body">
            <table class="table table-hover text-nowrap">
               <thead>
                  <tr>
                     <th>Nombre</th>

                     <th>Código</th>

                     <th style="width: 100px"></th>
                  </tr>
               </thead>

               <tbody id="products-container">
                  {{-- <tr>
                     <td class="align-middle">IMPERCOAT PLUS BLANCO</td>

                     <td class="align-middle">FA0-20410001</td>

                     <td>
                        <button type="button" class="btn btn-primary btn-block">
                           <i class="fas fa-plus"></i>
                        </button>
                     </td>
                  </tr> --}}
               </tbody>
            </table>
         </div>
      </div>

      <div class="modal-footer justify-content-between">
         <button type="button" class="btn btn-default modal-close-btn" data-dismiss="modal">Cerrar</button>
      </div>
   </div>
</div>
@endsection