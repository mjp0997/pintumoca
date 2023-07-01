@extends('layouts.dashboard')

@section('scripts')
<script src='{{ asset('js/alerts.js') }}'></script>
@endsection

@section('content')
@if (isset($office))
   <div class='row'>
      <div class='col-12 col-md-9'>
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Detalles de la sucursal</h3>
            </div>

            <div class="card-body">
               <div class='row'>
                  <div class='col-12'>
                     <div class="form-group">
                        <label>Nombre</label>

                        <input type="text" class="form-control" value="{{ $office->name }}" disabled>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.card-body -->
         </div>
      </div>

      <div class='col-12 col-md-3'>
         <div class='card'>
            <form class='card-body d-flex flex-column delete-form' action="{{ route('offices.destroy', ['id' => $office->id]) }}" method="POST">
               @csrf
               @method('DELETE')

               <a href="{{ route('offices.index') }}" class="btn btn-outline-secondary btn-block">Lista de sucursales</a>

               <a href="{{ route('offices.edit', ['id' => $office->id]) }}" class="btn btn-warning btn-block">Editar</a>
               
               <button type="submit" class="btn btn-danger btn-block">Eliminar</button>
            </form>
         </div>
      </div>
   </div>
@else
   @include('components.ui.404')
@endif
@endsection