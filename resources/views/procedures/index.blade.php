@extends('layouts.dashboard')

@section('scripts')
<script src='{{ asset('js/alerts.js') }}'></script>
@endsection

@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Listado de entregas</h3>
         </div>
         <!-- /.card-header -->

         <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
               <thead>
                  <tr>
                     <th>Fecha</th>

                     <th>Desde</th>

                     <th>Hasta</th>

                     <th>Usuario</th>

                     <th style="width: 100px"></th>
                  </tr>
               </thead>

               <tbody>
                  @foreach ($procedures as $procedure)
                     <tr>
                        <td class="align-middle">{{ date_format(date_create($procedure->date), 'd/m/Y') }}</td>

                        <td class="align-middle">{{ $procedure->fromOffice->name }}</td>

                        <td class="align-middle">{{ $procedure->toOffice->name }}</td>

                        <td class="align-middle">{{ $procedure->user->name }}</td>

                        <td>
                           <form class="delete-form" action="{{ route('procedures.destroy', ['id' => $procedure->id]) }}" method="POST">
                              @csrf
                              @method('DELETE')

                              <div class="btn-group w-100">
                                 <a href="{{ route('procedures.show', ['id' => $procedure->id]) }}" class="btn btn-default">
                                    <i class="fas fa-eye"></i>
                                 </a>
   
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
         <!-- /.card-body -->

         {{ $procedures->links() }}
      </div>
      <!-- /.card -->
   </div>
</div>
@endsection