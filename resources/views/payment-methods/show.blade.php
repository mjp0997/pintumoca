@extends('layouts.dashboard')

@section('scripts')
<script src='{{ asset('js/alerts.js') }}'></script>
@endsection

@section('content')
@if (isset($method))
   <div class='row'>
      <div class='col-12 col-md-9'>
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Detalles del método de pago</h3>
            </div>

            <div class="card-body">
               <div class='row'>
                  <div class='col-12'>
                     <div class="form-group">
                        <label>Nombre</label>

                        <input type="text" class="form-control" value="{{ $method->name }}" disabled>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.card-body -->
         </div>
      </div>

      <div class='col-12 col-md-3'>
         <div class='card'>
            <form class='card-body d-flex flex-column delete-form' action="{{ route('payment-methods.destroy', ['id' => $method->id]) }}" method="POST">
               @csrf
               @method('DELETE')
               <a href="{{ route('payment-methods.index') }}" class="btn btn-outline-secondary btn-block">Lista de métodos de pago</a>

               <a href="{{ route('payment-methods.edit', ['id' => $method->id]) }}" class="btn btn-warning btn-block">Editar</a>
               
               <button type="submit" class="btn btn-danger btn-block">Eliminar</button>
            </form>
         </div>
      </div>
   </div>
@else
   @include('components.ui.404')
@endif
@endsection