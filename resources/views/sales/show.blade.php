@extends('layouts.dashboard')

@section('custom-head')
   <link rel='stylesheet' href='{{ asset('css/sales-create.css') }}'>
   <link rel='stylesheet' href='{{ asset('css/payments-modal.css') }}'>
@endsection

@section('scripts')
   <script src='{{ asset('js/alerts.js') }}'></script>
@endsection

@section('content')
   @if (isset($sale))
      <div class='row'>
         <div class='col-12 col-md-9'>
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Detalles de la venta</h3>
               </div>

               <div class="card-body">
                  <div class="row">
                     <div class="col-12 col-sm-4">
                        <div class="info-box bg-light mb-md-0">
                           <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Total</span>

                              <span class="info-box-number text-center text-muted mb-0">$ {{ $sale->total }}</span>
                           </div>
                        </div>
                     </div>

                     <div class="col-12 col-sm-4">
                        <div class="info-box bg-light mb-md-0">
                           <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Fecha</span>

                              <span class="info-box-number text-center text-muted mb-0">{{ date_format(date_create($sale->date), 'd/m/Y') }}</span>
                           </div>
                        </div>
                     </div>

                     <div class="col-12 col-sm-4">
                        <div class="info-box bg-light mb-md-0">
                           <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Sucursal</span>

                              <span class="info-box-number text-center text-muted mb-0">{{ $sale->office->name }}</span>
                           </div>
                        </div>
                     </div>
                  </div>

                  <hr class="my-4" style="margin-left: -1.25rem; margin-right: -1.25rem;">

                  <div class="row">
                     <div class="col-12">
                        <h4 class="text-center">Productos</h4>

                        @foreach ($sale->lines as $line)
                           <div class="sale-row">
                              <div class='row'>
                                 <div class='col-8 col-md-5'>
                                    <div class="w-100 h-100 d-flex flex-column justify-content-center">
                                       <span class="d-block">
                                          <a href="#"><b>{{ $line->product->name }}</b></a>
                                       </span>
      
                                       <small class="d-block">{{ $line->product->code }}</small>
                                    </div>
                                 </div>

                                 <div class='col'>
                                    <div class='row h-100'>
                                       <div class='col-12 col-md'>
                                          <div class='h-100 d-flex align-items-center justify-content-center'>
                                             <p class="mb-0">$ {{ $line->price }}</p>
                                          </div>
                                       </div>

                                       <div class='col-12 col-md'>
                                          <div class='h-100 d-flex align-items-center justify-content-center'>
                                             <p class="mb-0">{{ $line->quantity }}</p>
                                          </div>
                                       </div>
                                       
                                       <div class='col-12 col-md'>
                                          <div class='h-100 d-flex align-items-center justify-content-center'>
                                             <p class="mb-0"><b>$ {{ $line->subtotal }}</b></p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @endforeach
                     </div>
                  </div>

                  <hr class="my-4" style="margin-left: -1.25rem; margin-right: -1.25rem;">

                  <div class='row'>
                     <div class="col-12 col-md-6">
                        <h4 class="text-center">Facturación</h4>

                        <div class="d-flex justify-content-between text-muted">
                           <p class="mb-0">Ejecutivo:</p>
                           
                           <b class="ml-auto">{{ $sale->user->name }}</b>
                        </div>

                        @if (isset($sale->client))
                           <div class="d-flex justify-content-between text-muted">
                              <p class="mb-0">Cliente:</p>
                              
                              <b class="ml-auto">{{ $sale->client->name }}</b>
                           </div>
                        @endif
                     </div>

                     <div class='col-12 d-md-none'>
                        <hr class="my-4" style="margin-left: -1.25rem; margin-right: -1.25rem;">
                     </div>

                     <div class='col-12 col-md-6'>
                        <h4 class="text-center">Pagos</h4>

                        <ul class="list-unstyled">
                           @foreach ($sale->payments as $line)
                              <li>
                                 <div class='d-flex justify-content-between'>
                                    <p class="btn-link text-secondary mb-0">{{ $line->paymentMethod->name }}</p>

                                    <b class="text-secondary">$ {{ $line->dollars_amount }}</b>
                                 </div>
                              </li>
                           @endforeach

                           <li class="border-top mt-3 pt-3">
                              <div class='d-flex justify-content-between'>
                                 <p class="btn-link text-secondary mb-0">Deuda pendiente</p>

                                 <b>$ {{ $sale->debt }}</b>
                              </div>

                              <div class='d-flex justify-content-between'>
                                 <p class="btn-link text-secondary mb-0">Conversión</p>

                                 <b>Bs {{ number_format($sale->debt * $dollar_rate, 2) }}</b>
                              </div>
                           </li>
                        </ul>

                        <div class="text-center mt-5 mb-3">
                           @if ($sale->debt > 0)
                              <button type="button" class="btn btn-primary open-modal-btn" data-modal-id='payments-create-modal'>Agregar pago</button>
                           @endif

                           <button type="button" class="btn btn-secondary open-modal-btn" data-modal-id='payments-modal'>Ver pagos</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.card-body -->
            </div>
         </div>

         <div class='col-12 col-md-3'>
            <div class='card'>
               <form class='card-body d-flex flex-column delete-form' action="{{ route('products.destroy', ['id' => $sale->id]) }}" method="POST">
                  @csrf
                  @method('DELETE')
   
                  <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary btn-block">Lista de ventas</a>
                  
                  <button type="submit" class="btn btn-danger btn-block">Eliminar</button>
               </form>
            </div>
         </div>
      </div>

      {{-- Modal agregar pago --}}
      <div class='modal-container {{ $errors->hasAny('payment_id', 'currency_id', 'amount') ? 'show' : '' }}' id="payments-create-modal">
         <form class="modal-content payments-modal" action="{{ route('sale-payments.store') }}" method="POST">
            @csrf
            @method('POST')

            <input type='hidden' name="sale_id" value="{{ $sale->id }}">

            <div class="modal-header">
               <h4 class="modal-title">Reportar pago</h4>
      
               <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
            </div>
      
            <div class="modal-body">
               <div class='row'>
                  <div class='col-12 col-md'>
                     <div class="form-group mb-md-0">
                        <label for="payment_id">Método de pago</label>

                        <select
                           class="form-control text-center @if($errors->has('payment_id')) is-invalid @endif"
                           name="payment_id"
                           id="payment_id"
                        >
                           <option value='' disabled {{ old('payment_id', '') == '' ? 'selected' : '' }}>Seleccione un método de pago</option>
                           
                           @foreach ($payment_methods as $method)
                              <option value='{{ $method->id }}' {{ old('payment_id', '') == $method->id ? 'selected' : '' }}>{{ $method->name }}</option>
                           @endforeach
                        </select>

                        @error('payment_id')
                           <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                     </div>
                  </div>

                  <div class='col-12 col-md'>
                     <div class="form-group mb-md-0">
                        <label for="currency_id">Divisa</label>

                        <select
                           class="form-control text-center @if($errors->has('currency_id')) is-invalid @endif"
                           name="currency_id"
                           id="currency_id"
                        >
                           <option value='' disabled {{ old('currency_id', '') == '' ? 'selected' : '' }}>Seleccione una divisa</option>
                           
                           @foreach ($currencies as $currency)
                              <option value='{{ $currency->id }}' {{ old('currency_id', '') == $currency->id ? 'selected' : '' }}>{{ $currency->name }}</option>
                           @endforeach
                        </select>

                        @error('currency_id')
                           <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                     </div>
                  </div>

                  <div class='col-12 col-md'>
                     <div class="form-group mb-md-0">
                        <label for="amount">Monto</label>
   
                        <input
                           type="text"
                           class="form-control text-center @if($errors->has('amount')) is-invalid @endif"
                           name="amount"
                           value="{{ old('amount', '') }}"
                           autocomplete="off"
                           placeholder="Ingrese el monto"
                           id="amount"
                        >

                        @error('amount')
                           <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                     </div>
                  </div>
               </div>
            </div>
      
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default modal-close-btn" data-dismiss="modal">Cerrar</button>

               <button type="submit" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
         </form>
      </div>
      {{-- End: Modal agregar pago --}}

      {{-- Modal listar pagos --}}
      <div class='modal-container' id="payments-modal">
         <div class="modal-content payments-list-modal">
            <div class="modal-header">
               <h4 class="modal-title">Reportar pago</h4>
      
               <button type="button" class="close modal-close-btn" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
            </div>
      
            <div class="modal-body table-responsive p-0">
               <table class="table table-hover text-nowrap">
                  <thead>
                     <tr>
                        <th>Fecha</th>

                        <th class="text-center">Cambio</th>

                        <th>Método de pago</th>
   
                        <th>Divisa</th>

                        <th class="text-center">Monto</th>

                        <th class="text-center">Monto en dólares</th>
   
                        <th style="width: 100px"></th>
                     </tr>
                  </thead>
   
                  <tbody>
                     @foreach ($sale->payments as $line)
                        <tr>
                           <td class="align-middle">{{ date_format($line->created_at, 'd/m/Y') }}</td>

                           <td class="align-middle text-center">{{ $line->dollar_rate }}</td>

                           <td class="align-middle">{{ $line->paymentMethod->name }}</td>
      
                           <td class="align-middle">{{ $line->currency->name }}</td>

                           <td class="align-middle text-center">$ {{ $line->formated_amount }}</td>

                           <td class="align-middle text-center">$ {{ $line->dollars_amount }}</td>
      
                           <td>
                              <form class="delete-form" action="{{ route('sale-payments.destroy', ['id' => $line->id]) }}" method="POST">
                                 @csrf
                                 @method('DELETE')

                                 <div class="w-100 btn-group">
                                    <button type="submit" class="btn btn-danger">
                                       <i class="fas fa-trash-alt"></i>
                                    </button>
                                 </div>
                              </form>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
      
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default modal-close-btn" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
      </div>
      {{-- End: Modal listar pagos --}}
   @else
      @include('components.ui.404')
   @endif
@endsection

@section('scripts')
   <script src='{{ asset('js/modal.js') }}'></script>
@endsection