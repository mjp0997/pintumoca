@extends('layouts.dashboard')

@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Listado de usuarios</h3>

            <div class="card-tools">
               <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                     <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                     </button>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.card-header -->

         <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
               <thead>
                  <tr>
                     <th>Nombre</th>
                     <th>Sucursal</th>
                     <th>Correo</th>
                  </tr>
               </thead>

               <tbody>
                  <tr>
                     <td>183</td>
                     <td>John Doe</td>
                     <td>11-7-2014</td>
                  </tr>

                  <tr>
                     <td>219</td>
                     <td>Alexander Pierce</td>
                     <td>11-7-2014</td>
                  </tr>

                  <tr>
                     <td>657</td>
                     <td>Bob Doe</td>
                     <td>11-7-2014</td>
                  </tr>

                  <tr>
                     <td>175</td>
                     <td>Mike Doe</td>
                     <td>11-7-2014</td>
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