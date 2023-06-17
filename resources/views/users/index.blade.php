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
                  <tr>
                     <td class="align-middle">John Doe</td>

                     <td class="align-middle">PINTUMOCA</td>

                     <td class="align-middle">john.doe@extension.com</td>

                     <td>
                        <div class="btn-group">
                           <a href="{{ route('users.show', ['id' => 1]) }}" class="btn btn-default">
                              <i class="fas fa-eye"></i>
                           </a>

                           <a href="{{ route('users.edit', ['id' => 1]) }}" class="btn btn-info">
                              <i class="far fa-edit"></i>
                           </a>

                           <button type="button" class="btn btn-danger">
                              <i class="fas fa-trash-alt"></i>
                           </button>
                        </div>
                     </td>
                  </tr>
                  
                  <tr>
                     <td class="align-middle">John Doe</td>

                     <td class="align-middle">PINTUMOCA</td>

                     <td class="align-middle">john.doe@extension.com</td>

                     <td>
                        <div class="btn-group">
                           <a href="{{ route('users.show', ['id' => 1]) }}" class="btn btn-default">
                              <i class="fas fa-eye"></i>
                           </a>

                           <a href="{{ route('users.edit', ['id' => 1]) }}" class="btn btn-info">
                              <i class="far fa-edit"></i>
                           </a>

                           <button type="button" class="btn btn-danger">
                              <i class="fas fa-trash-alt"></i>
                           </button>
                        </div>
                     </td>
                  </tr>

                  <tr>
                     <td class="align-middle">John Doe</td>

                     <td class="align-middle">PINTUMOCA</td>

                     <td class="align-middle">john.doe@extension.com</td>

                     <td>
                        <div class="btn-group">
                           <a href="{{ route('users.show', ['id' => 1]) }}" class="btn btn-default">
                              <i class="fas fa-eye"></i>
                           </a>

                           <a href="{{ route('users.edit', ['id' => 1]) }}" class="btn btn-info">
                              <i class="far fa-edit"></i>
                           </a>

                           <button type="button" class="btn btn-danger">
                              <i class="fas fa-trash-alt"></i>
                           </button>
                        </div>
                     </td>
                  </tr>

                  <tr>
                     <td class="align-middle">John Doe</td>

                     <td class="align-middle">PINTUMOCA</td>

                     <td class="align-middle">john.doe@extension.com</td>

                     <td>
                        <div class="btn-group">
                           <a href="{{ route('users.show', ['id' => 1]) }}" class="btn btn-default">
                              <i class="fas fa-eye"></i>
                           </a>

                           <a href="{{ route('users.edit', ['id' => 1]) }}" class="btn btn-info">
                              <i class="far fa-edit"></i>
                           </a>

                           <button type="button" class="btn btn-danger">
                              <i class="fas fa-trash-alt"></i>
                           </button>
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <!-- /.card-body -->

         <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
               <li class="page-item"><a class="page-link" href="#">«</a></li>
               <li class="page-item"><a class="page-link" href="#">1</a></li>
               <li class="page-item"><a class="page-link" href="#">2</a></li>
               <li class="page-item"><a class="page-link" href="#">3</a></li>
               <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
         </div>
      </div>
      <!-- /.card -->
   </div>
</div>
@endsection