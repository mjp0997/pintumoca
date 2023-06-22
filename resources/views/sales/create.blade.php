@extends('layouts.dashboard')

@section('custom-head')
   <link rel='stylesheet' href='{{ asset('css/sales-create.css') }}'>
   <link rel='stylesheet' href='{{ asset('css/sales-modal.css') }}'>

   <meta name="methods-link" content="{{ route('payment-methods.api-index') }}" id="methods-api-link">
   <meta name="currencies-link" content="{{ route('currencies.api-index') }}" id="currencies-api-link">
   <meta name="products-link" content="{{ route('products.api-index') }}" id="products-api-link">
@endsection

@section('scripts')
   <script src='{{ asset('js/debounce.js') }}'></script>
   <script src='{{ asset('js/products-dynamic-form.js') }}'></script>
   <script src='{{ asset('js/payments-dynamic-form.js') }}'></script>
@endsection

@section('content')
<div class='row'>
   <div class='col-12 col-md-9'>
      <form class="card" action="{{ route('sales.store') }}" method="POST">
         @csrf
         @method('POST')

         <div class="card-header">
            <h3 class="card-title">Reportar venta</h3>
         </div>

         @if (count(old('cart', [])) > 0)
            <input type='hidden' disabled id="old-cart" value="{{ json_encode(old('cart')) }}">
         @endif

         @if (count(old('payments', [])) > 0)
            <input type='hidden' disabled id="old-payments" value="{{ json_encode(old('payments')) }}">
         @endif

         @if ($errors->any())
            <input type='hidden' disabled id="errors" value="{{ json_encode((array) $errors) }}">
         @endif

         <div class="card-body">
            <div class='row'>
               <div class='col-12 col-md'>
                  <div class="form-group mb-md-0">
                     <label for="client_name">Nombre del cliente (Opcional)</label>

                     <input
                        type="text"
                        class="form-control"
                        name="client_name"
                        autocomplete="off"
                        placeholder="Ingrese el nombre del cliente"
                        id="client_name"
                     >
                  </div>
               </div>

               @if(!isset(Auth::user()->office_id))
                  <div class='col-12 col-md'>
                     <div class="form-group mb-md-0">
                        <label for="office_id">Sucursal</label>

                        <select
                           class="form-control text-center @if($errors->has('office_id')) is-invalid @endif"
                           name="office_id"
                           id="office_id"
                        >
                           <option value='' disabled {{ old('office_id', '') == '' ? 'selected' : '' }}>Seleccione una sucursal</option>
                           
                           @foreach ($offices as $office)
                              <option value='{{ $office->id }}' {{ old('office_id', '') == $office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                           @endforeach
                        </select>

                        @error('office_id')
                           <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                     </div>
                  </div>
               @else
                  <input
                     type='hidden'
                     name="office_id"
                     value="{{ Auth::user()->office_id }}"
                     id="office_id"
                  >
               @endif
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
                                          <label class="mb-0 d-block text-center">Precio</label>
                     
                                          <input
                                             type="text"
                                             class="form-control text-center"
                                             name="cart[][price]"
                                             autocomplete="off"
                                             placeholder="Precio"
                                          >
                                       </div>
                                    </div>
                                 </div>
   
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
                                 
                                 <div class='col-6 col-md mt-3 mt-md-0'>
                                    <div class='h-100 d-flex align-items-center justify-content-center'>
                                       <p class="mb-0"><b class="sales-total">500</b></p>
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

            <hr class="my-5">

            <div class="row">
               <div class="col-12">
                  <div class='d-flex justify-content-between mb-3'>
                     <h4 class="mb-0">Pagos</h4>

                     <button type="button" class="btn btn-sm btn-success" id="add-payment-btn">
                        <i class='fas fa-plus'></i>
                        Agregar
                     </button>
                  </div>

                  <div class='d-flex flex-column' id="payments-container">
                     {{-- <div class="sale-row">
                        <div class='row'>
                           <div class='col-12 col-md-5'>
                              <div class="form-group mb-md-0">
                                 <label class="mb-0 d-block text-center">Método de pago</label>
   
                                 <select class="form-control text-center">
                                    <option>Mercantil</option>
                                    <option>Mercantil</option>
                                    <option>Mercantil</option>
                                    <option>Mercantil</option>
                                    <option>Mercantil</option>
                                 </select>
                              </div>
                           </div>
   
                           <div class='col-12 col-md-7'>
                              <div class='row'>
                                 <div class='col'>
                                    <div class="form-group mb-0">
                                       <label class="mb-0 d-block text-center">Divisa</label>
         
                                       <select class="form-control text-center">
                                          <option>Dólares</option>
                                          <option>Bolívares</option>
                                       </select>
                                    </div>
                                 </div>
   
                                 <div class='col'>
                                    <div class="form-group mb-0">
                                       <label class="mb-0 d-block text-center">Monto</label>
                  
                                       <input
                                          type="text"
                                          class="form-control text-center"
                                          name="name"
                                          autocomplete="off"
                                          placeholder="Monto"
                                       >
                                    </div>
                                 </div>
   
                                 <div class="col-2 d-flex">
                                    <button type="button" class="btn btn-danger btn-block mt-auto">
                                       <i class="fas fa-trash"></i>
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
            <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary btn-block">Lista de ventas</a>
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