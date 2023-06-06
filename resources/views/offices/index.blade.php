@extends('layouts.dashboard')

@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Listado de sucursales</h3>
         </div>
         <!-- /.card-header -->

         <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
               <thead>
                  <tr>
                     <th>Nombre</th>

                     <th style="width: 100px"></th>
                  </tr>
               </thead>

               <tbody>
                  @foreach ($offices as $office)
                     <tr>
                        <td class="align-middle">{{ $office->name }}</td>

                        <td>
                           <form class="btn-group" action="{{ route('offices.destroy', ['id' => $office->id]) }}" method="POST">
                              @csrf
                              @method('DELETE')

                              <a href="{{ route('offices.show', ['id' => $office->id]) }}" class="btn btn-default">
                                 <i class="fas fa-eye"></i>
                              </a>

                              <a href="{{ route('offices.edit', ['id' => $office->id]) }}" class="btn btn-info">
                                 <i class="far fa-edit"></i>
                              </a>

                              <button type="submit" class="btn btn-danger">
                                 <i class="fas fa-trash-alt"></i>
                              </button>
                           </form>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         <!-- /.card-body -->

         {{ $offices->links() }}
      </div>
      <!-- /.card -->
   </div>
</div>
@endsection