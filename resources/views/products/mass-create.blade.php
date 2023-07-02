@extends('layouts.dashboard')

@section('scripts')
   <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

   <script>
      $(function () {
         bsCustomFileInput.init();
      });
   </script>

   <script src='{{ asset('js/mass-dynamic-list.js') }}'></script>
@endsection

@section('content')
<div class='row'>
   <div class='col-12 col-md-9'>
      <form class="card" action="{{ route('products.mass-read') }}" method="POST" enctype="multipart/form-data">
         @csrf
         @method('POST')

         <input type='hidden' name='route' value="mass-create">

         <div class="card-header">
            <h3 class="card-title">Cargar productos</h3>
         </div>

         <div class="card-body">
            <div class='row'>
               <div class='col-12 col-md'>
                  <div class="form-group">
                     <label for="import">Archivo</label>

                     <div class="input-group">
                        <div class="custom-file">
                           <input
                              type="file"
                              class="custom-file-input  @if($errors->has('import')) is-invalid @endif"
                              name="import"
                              id="import"
                              required
                           >

                           <label class="custom-file-label" for="import">Seleccionar archivo</label>
                        </div>
                     </div>

                     @error('import')
                        <span class="error invalid-feedback d-block">{{ $message }}</span>
                     @enderror
                  </div>
               </div>
            </div>
         </div>
         <!-- /.card-body -->

         <div class='card-footer'>
            <div class='d-flex justify-content-end'>
               <button type="submit" class="btn btn-primary">Cargar archivo</button>
            </div>
         </div>
      </form>

      @if (session('products'))
         <form class="card" action="{{ route('products.mass-store') }}" method="POST">
            @csrf
            @method('POST')

            <div class="card-header">
               <h3 class="card-title">Listado de productos</h3>
            </div>

            <div class="card-body table-responsive p-0" style="max-height: 400px;">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th>Código</th>

                        <th style="width: 200px;">Nombre</th>

                        @foreach (session('offices') as $office)
                           <th class="text-center">{{ $office }}</th>
                        @endforeach
   
                        <th style="width: 100px;"></th>
                     </tr>
                  </thead>
   
                  <tbody>
                     @foreach (session('products') as $product)
                        <tr class="products-list-element @if ($product['total_stock'] == 0) bg-warning @endif">
                           <input type='hidden' name="products[{{ $loop->index }}][code]" value="{{ $product['code'] }}">
                           <input type='hidden' name="products[{{ $loop->index }}][name]" value="{{ $product['name'] }}">
                           @foreach (session('offices') as $office)
                              <input type='hidden' name="products[{{ $loop->parent->index }}][offices][{{ $office }}]" value="{{ $product['offices'][$office] ?? 0 }}">
                           @endforeach

                           <td class="align-middle">{{ $product['code'] }}</td>

                           <td class="align-middle" style="width: 200px;">{{ $product['name'] }}</td>

                           @foreach (session('offices') as $office)
                              <td class="align-middle text-center">{{ $product['offices'][$office] ?? 0 }}</td>
                           @endforeach
      
                           <td class="align-middle">
                              <div class="btn-group">
                                 <button type="button" class="btn btn-danger btn-action-delete">
                                    <i class="fas fa-trash-alt"></i>
                                 </button>
                              </div>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
               
            </div>
            <!-- /.card-body -->

            <div class='card-footer'>
               <div class='d-flex justify-content-between'>
                  <div class="form-check d-flex align-items-center">
                     <input
                        type="checkbox"
                        class="form-check-input"
                        id="all_products"
                        name="all_products"
                        checked
                     >

                     <label class="form-check-label" for="all_products">Crear registros sin stock</label>
                  </div>
                   
                  <button type="submit" class="btn btn-primary">Guardar productos</button>
               </div>
            </div>
         </form>
      @endif
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