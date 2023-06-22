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
   <div class='col-12 col-md'>
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Filtros</h3>
         </div>
         <!-- /.card-header -->

         <form class="card-body" action="{{ route('sales.index') }}" method="GET">
            <div class='row'>
               <div class='col-12 col-md'>
                  <div class="form-group">
                     <label for="date">Por fecha</label>

                     <input
                        type="date"
                        id="date"
                        class="form-control"
                        name="date"
                        value="{{ request()->get('date', '') }}"
                        placeholder="Ingrese el nombre o el código de un producto"
                     >
                  </div>
               </div>

               <div class='col-12 col-md'>
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

               <div class='col-12 col-md'>
                  <div class="form-group">
                     <label for="user_id">Usuario</label>
                     
                     <select
                        class="form-control select2 text-center @if($errors->has('user_id')) is-invalid @endif"
                        style="width: 100%;"
                        name="user_id"
                        id="user_id"
                     >
                        <option value='' {{ request()->get('user_id', '') == '' ? 'selected' : '' }}>Todos</option>
                        
                        @foreach ($users as $user)
                           <option value='{{ $user->id }}' {{ request()->get('user_id', '') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>

               <div class='col-12 col-md'>
                  <div class="form-group">
                     <label for="client">Cliente</label>

                     <input
                        type="text"
                        id="client"
                        class="form-control"
                        name="client"
                        value="{{ request()->get('client', '') }}"
                        placeholder="Ingrese el nombre del cliente"
                        autocomplete="off"
                     >
                  </div>
               </div>

               <div class='col-12 col-md-3'>
                  <div class='row h-100'>
                     <div class='col-6 d-flex'>
                        <button type="submit" class="btn btn-success btn-block mt-auto mb-3">Buscar</button>
                     </div>

                     <div class='col-6 d-flex'>
                        <a href='{{ route('sales.index') }}' class="btn btn-outline-secondary btn-block mt-auto mb-3">Limpiar</a>
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
            <h3 class="card-title">Listado de ventas</h3>
         </div>
         <!-- /.card-header -->

         <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
               <thead>
                  <tr>
                     <th>Fecha</th>

                     <th>Sucursal</th>
                     
                     <th>Usuario</th>
                     
                     <th>Total</th>

                     <th style="width: 100px"></th>
                  </tr>
               </thead>

               <tbody>
                  @if (count($sales) > 0)
                     @foreach ($sales as $sale)
                        <tr>
                           <td class="align-middle">{{ date_format(date_create($sale->date), 'd/m/Y') }}</td>

                           <td class="align-middle">{{ $sale->office->name }}</td>
                           
                           <td class="align-middle">{{ $sale->user->name }}</td>
                           
                           <td class="align-middle">$ {{ $sale->total }}</td>

                           <td>
                              <div class="btn-group">
                                 <a href="{{ route('sales.show', ['id' => $sale->id]) }}" class="btn btn-default">
                                    <i class="fas fa-eye"></i>
                                 </a>

                                 <a href="{{ route('sales.edit', ['id' => $sale->id]) }}" class="btn btn-info">
                                    <i class="far fa-edit"></i>
                                 </a>

                                 <button type="button" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                 </button>
                              </div>
                           </td>
                        </tr>
                     @endforeach
                  @else
                     <tr>
                        <td colspan="{{ 5 }}" class="text-center text-muted h2 p-5">No se han encontrado resultados...</td>
                     </tr>
                  @endif
               </tbody>
            </table>
         </div>
         <!-- /.card-body -->

         {{ $sales->appends(request()->input())->links() }}
      </div>
      <!-- /.card -->
   </div>
</div>
@endsection