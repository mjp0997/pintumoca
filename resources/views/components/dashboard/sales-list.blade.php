<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title">Ventas recientes de hoy</h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body table-responsive p-0">
         <table class="table table-hover text-nowrap">
            <thead>
               <tr>
                  <th>Sucursal</th>
                  
                  <th>Usuario</th>
                  
                  <th class="text-center">Total</th>

                  <th class="text-center">Cantidad</th>

                  <th style="width: 100px"></th>
               </tr>
            </thead>

            <tbody>
               @if (count($sales) > 0)
                  @foreach ($sales as $sale)
                     <tr>
                        <td class="align-middle">{{ $sale->office->name }}</td>
                        
                        <td class="align-middle">{{ $sale->user->name }}</td>
                        
                        <td class="align-middle text-center">$ {{ $sale->total }}</td>
                        
                        <td class="align-middle text-center">{{ $sale->products_quantity }}</td>

                        <td>
                           <div class="btn-group">
                              <a href="{{ route('sales.show', ['id' => $sale->id]) }}" class="btn btn-default">
                                 <i class="fas fa-eye"></i>
                              </a>
                           </div>
                        </td>
                     </tr>
                  @endforeach
               @else
                  <tr>
                     <td colspan="{{ 5 }}" class="text-center text-muted h2 p-5">No se han reportado ventas...</td>
                  </tr>
               @endif
            </tbody>
         </table>
      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</div>