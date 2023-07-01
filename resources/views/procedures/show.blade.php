@extends('layouts.dashboard')

@section('scripts')
<script src='{{ asset('js/alerts.js') }}'></script>
@endsection

@section('content')
@if (isset($procedure))
   <div class='row'>
      <div class='col-12 col-md-9'>
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Detalles de la entrega</h3>
            </div>

            <div class="card-body">
               <div class="row">
                  <div class="col-12">
                     <div class="row">
                        <div class="col-12 col-sm-3">
                           <div class="info-box bg-light">
                              <div class="info-box-content">
                                 <span class="info-box-text text-center text-muted">Origen</span>

                                 <span class="info-box-number text-center text-muted mb-0">{{ $procedure->fromOffice->name }}</span>
                              </div>
                           </div>
                        </div>

                        <div class="col-12 col-sm-3">
                           <div class="info-box bg-light">
                              <div class="info-box-content">
                                 <span class="info-box-text text-center text-muted">Destino</span>

                                 <span class="info-box-number text-center text-muted mb-0">{{ $procedure->toOffice->name }}</span>
                              </div>
                           </div>
                        </div>

                        <div class="col-12 col-sm-3">
                           <div class="info-box bg-light">
                              <div class="info-box-content">
                                 <span class="info-box-text text-center text-muted">Fecha</span>

                                 <span class="info-box-number text-center text-muted mb-0">{{ date_format(date_create($procedure->date), 'd/m/Y') }}</span>
                              </div>
                           </div>
                        </div>

                        <div class="col-12 col-sm-3">
                           <div class="info-box bg-light">
                              <div class="info-box-content">
                                 <span class="info-box-text text-center text-muted">Usuario</span>

                                 <span class="info-box-number text-center text-muted mb-0">{{ $procedure->user->name }}</span>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-12">
                           <h4>Productos</h4>

                           @foreach ($procedure->procedureLines as $line)
                              <div class="post">
                                 <div class='row'>
                                    <div class='col-8'>
                                       <div class="w-100 h-100 d-flex flex-column justify-content-center">
                                          <span class="d-block">
                                             <a href="#"><b>{{ $line->product->name }}</b></a>
                                          </span>
         
                                          <small class="d-block">{{ $line->product->code }}</small>
                                       </div>
                                    </div>

                                    <div class='col-4'>
                                       <div class='h-100 d-flex align-items-center justify-content-center'>
                                          <p class="mb-0">{{ $line->quantity }}</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.card-body -->
         </div>
      </div>

      <div class='col-12 col-md-3'>
         <div class='card'>
            <form class='card-body d-flex flex-column delete-form' action="{{ route('procedures.destroy', ['id' => $procedure->id]) }}" method="POST">
               @csrf
               @method('DELETE')

               <a href="{{ route('procedures.index') }}" class="btn btn-outline-secondary btn-block">Lista de entregas</a>
               
               <button type="submit" class="btn btn-danger btn-block">Eliminar</button>
            </form>
         </div>
      </div>
   </div>
@else
   @include('components.ui.404')
@endif
@endsection