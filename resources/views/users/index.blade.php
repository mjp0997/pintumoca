@extends('layouts.dashboard')

@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Listado de usuarios</h3>
         </div>
         <!-- /.card-header -->

         <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
               <thead>
                  <tr>
                     <th>Nombre</th>

                     <th>Sucursal</th>

                     <th>Correo</th>

                     <th style="width: 100px;"></th>
                  </tr>
               </thead>

               <tbody>
                  @foreach ($users as $user)
                     <tr>
                        <td class="align-middle">{{ $user->name }}</td>

                        <td class="align-middle">{{ $user->office?->name ?? '-' }}</td>

                        <td class="align-middle">{{ $user->email }}</td>

                        <td>
                           <form action='{{ route('users.destroy', ['id' => $user->id]) }}' method='POST'>
                              @csrf
                              @method('DELETE')

                              <div class="btn-group">
                                 <a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-default">
                                    <i class="fas fa-eye"></i>
                                 </a>
   
                                 <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-info">
                                    <i class="far fa-edit"></i>
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

         {{ $users->links() }}
      </div>
      <!-- /.card -->
   </div>
</div>
@endsection