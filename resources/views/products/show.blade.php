@extends('layouts.dashboard')

@section('custom-head')
   <link rel='stylesheet' href='{{ asset('css/modal.css') }}'>
   <link rel='stylesheet' href='{{ asset('css/stocks-modal.css') }}'>
@endsection

@section('scripts')
   <script src='{{ asset('js/modal.js') }}'></script>
   <script src='{{ asset('js/alerts.js') }}'></script>
@endsection

@section('content')
@if (isset($product))
   <div class='row'>
      <div class='col-12 col-md-9'>
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Detalles del producto</h3>
            </div>

            <div class="card-body">
               <div class='row'>
                  <div class='col-12 col-md-6'>
                     <div class="form-group">
                        <label>Nombre</label>

                        <input type="text" class="form-control" value="{{ $product->name }}" disabled>
                     </div>
                  </div>

                  <div class='col-12 col-md-6'>
                     <div class="form-group">
                        <label>Código</label>

                        <input type="text" class="form-control" value="{{ $product->code }}" disabled>
                     </div>
                  </div>
               </div>

               <p class="text-center text-primary border-bottom"><b>Stock</b></p>

               <div class='row'>
                  @foreach ($offices as $office)
                     <div class='col-12 col-md'>
                        <div class="form-group">
                           <label class="d-block text-center">{{ $office->name }}</label>

                           <input type="text" class="form-control text-center" value="{{ collect($product->stocks)->firstWhere('office_id', $office->id)?->stock ?? '-' }}" disabled>
                        </div>

                        <div class='row mb-3'>
                           <div class='col'>
                              <button class='btn btn-warning btn-block open-modal-btn' data-modal-id='stock-modal-{{ $office->id }}'>Editar stock</button>
                           </div>
                           
                           @if (isset(collect($product->stocks)->firstWhere('office_id', $office->id)?->stock))
                              <div class='col'>
                                 <button class='btn btn-success btn-block open-modal-btn' data-modal-id='increase-stock-modal-{{ $office->id }}'>Agregar stock</button>
                              </div>
                           @endif
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
            <!-- /.card-body -->
         </div>
      </div>

      <div class='col-12 col-md-3'>
         <div class='card'>
            <form class='card-body d-flex flex-column delete-form' action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST">
               @csrf
               @method('DELETE')

               <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-block">Lista de productos</a>

               <button type="button" class="btn btn-outline-primary btn-block open-modal-btn" data-modal-id="procedure-modal">Mover stock</button>

               <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-warning btn-block">Editar</a>
               
               <button type="submit" class="btn btn-danger btn-block">Eliminar</button>
            </form>
         </div>
      </div>
   </div>

   {{-- Update stock modals --}}
   @foreach ($offices as $office)
      <div class='modal-container {{ old('office_id', null) == $office->id ? 'show' : '' }}' id="stock-modal-{{ $office->id }}">
         <form class="modal-content stocks-modal" action="{{ route('stocks.store') }}" method="POST">
            @csrf
            @method('POST')

            <input type='hidden' name="product_id" value="{{ $product->id }}">
            <input type='hidden' name="office_id" value="{{ $office->id }}">

            <div class="modal-header">
               <h4 class="modal-title">Actualizar stock</h4>
      
               <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
            </div>
      
            <div class="modal-body">
               <div class='row'>
                  <div class='col-12'>
                     <div class="form-group">
                        <label for="stock-{{ $office->name }}">Oficina: {{ $office->name }}</label>

                        <input
                           type="text"
                           class="form-control @if($errors->has('stock')) is-invalid @endif"
                           id="stock-{{ $office->name }}"
                           name="stock"
                           value="{{ old('stock', collect($product->stocks)->firstWhere('office_id', $office->id)?->stock ?? '0') }}"
                        >

                        @error('stock')
                           <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                     </div>
                  </div>
               </div>
            </div>
      
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default modal-close-btn" data-dismiss="modal">Cerrar</button>

               <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
         </form>
      </div>
   @endforeach
   {{-- End: Update stock modals --}}

   {{-- Increase stock modals --}}
   @foreach ($product->stocks as $stock)
      <div class='modal-container {{ old('stock_id', null) == $stock->id ? 'show' : '' }}' id="increase-stock-modal-{{ $stock->office_id }}">
         <form class="modal-content stocks-modal" action="{{ route('stocks.update') }}" method="POST">
            @csrf
            @method('PUT')

            <input type='hidden' name="stock_id" value="{{ $stock->id }}">

            <div class="modal-header">
               <h4 class="modal-title">Incrementar stock</h4>
      
               <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
            </div>
      
            <div class="modal-body">
               <div class='row'>
                  <div class='col-12'>
                     <div class="form-group">
                        <label for="stock-{{ $stock->id }}">Oficina: {{ $stock->office->name }}</label>

                        <input
                           type="text"
                           class="form-control @if($errors->has('stock')) is-invalid @endif"
                           id="stock-{{ $stock->id }}"
                           name="stock"
                           value="{{ old('stock', '') }}"
                        >

                        @error('stock')
                           <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                     </div>
                  </div>
               </div>
            </div>
      
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default modal-close-btn" data-dismiss="modal">Cerrar</button>

               <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
         </form>
      </div>
   @endforeach
   {{-- End: Increase stock modals --}}

   {{-- Procedure model --}}
   <div class='modal-container {{ $errors->hasAny('from_office_id', 'to_office_id', 'products.0.product_id', 'products.0.quantity') ? 'show' : '' }}' id="procedure-modal">
      <form class="modal-content stocks-modal" action="{{ route('procedures.store') }}" method="POST">
         @csrf
         @method('POST')

         <input type='hidden' name="single" value="1">

         <input type='hidden' name="products[0][product_id]" value="{{ $product->id }}">

         <div class="modal-header">
            <h4 class="modal-title">Mover stock</h4>
   
            <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
   
         <div class="modal-body">
            <div class='row'>
               <div class='col-12 col-md-6'>
                  <div class="form-group">
                     <label for="from_office_id">Desde</label>
   
                     <select
                        class="form-control text-center @if($errors->has('from_office_id')) is-invalid @endif"
                        name="from_office_id"
                        id="from_office_id"
                     >
                        <option value='' disabled {{ old('from_office_id', '') == '' ? 'selected' : '' }}>Seleccione una sucursal</option>

                        @foreach ($product->stocks as $stock)
                           <option value='{{ $stock->office_id }}' {{ old('from_office_id', '') == $stock->office_id ? 'selected' : '' }}>{{ $stock->office->name }}</option>
                        @endforeach
                     </select>

                     @error('from_office_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                     @enderror
                  </div>
               </div>

               <div class='col-12 col-md-6'>
                  <div class="form-group">
                     <label for="to_office_id">Hasta</label>
   
                     <select
                        class="form-control text-center @if($errors->has('to_office_id')) is-invalid @endif"
                        name="to_office_id"
                        id="to_office_id"
                     >
                        <option value='' disabled {{ old('to_office_id', '') == '' ? 'selected' : '' }}>Seleccione una sucursal</option>

                        @foreach ($offices as $office)
                           <option value='{{ $office->id }}' {{ old('to_office_id', '') == $office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                        @endforeach
                     </select>

                     @error('to_office_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                     @enderror
                  </div>
               </div>

               <div class='col-12'>
                  <div class="form-group">
                     <label for="procedure-quantity">Cantidad</label>

                     <input
                        type="text"
                        class="form-control @if($errors->has('products.0.quantity')) is-invalid @endif"
                        id="procedure-quantity"
                        name="products[0][quantity]"
                        value="{{ old('products.0.quantity', '') }}"
                     >

                     @error('products.0.quantity')
                        <span class="error invalid-feedback">{{ $message }}</span>
                     @enderror
                  </div>
               </div>
            </div>
         </div>
   
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default modal-close-btn" data-dismiss="modal">Cerrar</button>

            <button type="submit" class="btn btn-primary">Guardar</button>
         </div>
      </form>
   </div>
   {{-- End: Procedure model --}}
@else
   @include('components.ui.404')
@endif
@endsection