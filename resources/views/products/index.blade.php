@extends('layouts.dashboard')

@section('content')
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
                        <th class="text-center">{{ $office->name }}</th>
                     @endforeach

                     <th style="width: 100px"></th>
                  </tr>
               </thead>

               <tbody>
                  @foreach ($products as $product)
                     <tr>
                        <td class="align-middle">{{ $product->name }}</td>

                        <td class="align-middle">{{ $product->code }}</td>

                        @foreach ($offices as $office)
                           <td class="align-middle text-center">{{ collect($product->stocks)->firstWhere('office_id', $office->id)?->stock ?? '-' }}</td>
                        @endforeach

                        <td>
                           <form class="btn-group" action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST">
                              @csrf
                              @method('DELETE')

                              <a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-default">
                                 <i class="fas fa-eye"></i>
                              </a>

                              <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-info">
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

         {{ $products->links() }}
      </div>
      <!-- /.card -->
   </div>
</div>
@endsection