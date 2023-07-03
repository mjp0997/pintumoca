@extends('layouts.dashboard')

@section('scripts')
<script src='{{ asset('js/alerts.js') }}'></script>
@endsection

@section('content')
<div class='row'>
   <div class='col-12 col-md'>
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Filtros</h3>
         </div>
         <!-- /.card-header -->

         <form class="card-body" action="{{ route('products.index') }}" method="GET">
            <div class='row'>
               <div class='col'>
                  <div class="form-group">
                     <label for="search">Buscar</label>

                     <input
                        type="text"
                        id="search"
                        class="form-control"
                        name="search"
                        value="{{ request()->get('search', '') }}"
                        placeholder="Ingrese el nombre o el código de un producto"
                     >
                  </div>
               </div>

               @if (Helper::role_is_allowed(Auth::user()->role->name, 'admin'))
                  <div class='col'>
                     <div class="form-group">
                        <label for="office_id">Sucursal</label>

                        <select
                           class="form-control text-center @if($errors->has('office_id')) is-invalid @endif"
                           name="office_id"
                           id="office_id"
                        >
                           <option value='' {{ request()->get('office_id', '') == '' ? 'selected' : '' }}>Todas</option>

                           @foreach ($offices as $office)
                              <option value='{{ $office->id }}' {{ request()->get('office_id', '') == $office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               @endif

               <div class='col-12 col-md-3'>
                  <div class='row h-100'>
                     <div class='col-6 d-flex'>
                        <button type="submit" class="btn btn-success btn-block mt-auto mb-3">Buscar</button>
                     </div>

                     <div class='col-6 d-flex'>
                        <a href='{{ route('products.index') }}' class="btn btn-outline-secondary btn-block mt-auto mb-3">Limpiar</a>
                     </div>
                  </div>
               </div>
            </div>
         </form>
         <!-- /.card-body -->
      </div>
   </div>
</div>

<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Listado de productos</h3>
         </div>
         <!-- /.card-header -->

         <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
               <thead>
                  <tr>
                     <th>Nombre</th>

                     <th>Código</th>

                     @foreach ($offices as $office)
                        @if (request()->get('office_id', '') != '')
                           @if (request()->get('office_id') == $office->id)
                              <th class="text-center">{{ $office->name }}</th>
                           @endif
                        @else
                           <th class="text-center">{{ $office->name }}</th>
                        @endif
                     @endforeach

                     <th style="width: 100px"></th>
                  </tr>
               </thead>

               <tbody>
                  @if (count($products) > 0)
                     @foreach ($products as $product)
                        <tr>
                           <td class="align-middle">{{ $product->name }}</td>

                           <td class="align-middle">{{ $product->code }}</td>

                           @foreach ($offices as $office)
                              @if (request()->get('office_id', '') != '')
                                 @if (request()->get('office_id') == $office->id)
                                    <td class="align-middle text-center">{{ collect($product->stocks)->firstWhere('office_id', $office->id)?->stock ?? '-' }}</td>
                                 @endif
                              @else
                                 <td class="align-middle text-center">{{ collect($product->stocks)->firstWhere('office_id', $office->id)?->stock ?? '-' }}</td>
                              @endif
                           @endforeach

                           <td>
                              <form class="delete-form" action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST">
                                 @csrf
                                 @method('DELETE')
                                 
                                 <div class="btn-group w-100">
                                    <a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-default">
                                       <i class="fas fa-eye"></i>
                                    </a>
   
                                    @if (Helper::role_is_allowed(Auth::user()->role->name, 'admin'))
                                       <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-info">
                                          <i class="far fa-edit"></i>
                                       </a>
                                    @endif
   
                                    @if (Helper::role_is_allowed(Auth::user()->role->name, 'admin'))
                                       <button type="submit" class="btn btn-danger">
                                          <i class="fas fa-trash-alt"></i>
                                       </button>
                                    @endif
                                 </div>
                              </form>
                           </td>
                        </tr>
                     @endforeach
                  @else
                     <tr>
                        <td colspan="{{ 3 + count($offices) }}" class="text-center text-muted h2 p-5">No se han encontrado resultados...</td>
                     </tr>
                  @endif
               </tbody>
            </table>
         </div>
         <!-- /.card-body -->

         {{ $products->appends(request()->input())->links() }}
      </div>
      <!-- /.card -->
   </div>
</div>
@endsection