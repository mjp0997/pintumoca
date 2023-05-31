@extends('layouts.dashboard')

@section('content')
   <div class='row'>
      <div class='col-12'>
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Detalles de la venta</h3>
            </div>

            <div class="card-body">
               <div class="row">
                  <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                     <div class="row">
                        <div class="col-12 col-sm-4">
                           <div class="info-box bg-light">
                              <div class="info-box-content">
                                 <span class="info-box-text text-center text-muted">Total</span>

                                 <span class="info-box-number text-center text-muted mb-0">2300</span>
                              </div>
                           </div>
                        </div>

                        <div class="col-12 col-sm-4">
                           <div class="info-box bg-light">
                              <div class="info-box-content">
                                 <span class="info-box-text text-center text-muted">Cantidad de productos</span>

                                 <span class="info-box-number text-center text-muted mb-0">2000</span>
                              </div>
                           </div>
                        </div>

                        <div class="col-12 col-sm-4">
                           <div class="info-box bg-light">
                              <div class="info-box-content">
                                 <span class="info-box-text text-center text-muted">Sucursal</span>

                                 <span class="info-box-number text-center text-muted mb-0">20</span>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-12">
                           <h4>Productos</h4>

                           <div class="post">
                              <div class='row'>
                                 <div class='col-8 col-md-5'>
                                    <div class="w-100 h-100 d-flex flex-column justify-content-center">
                                       <span class="d-block">
                                          <a href="#"><b>IMPERCOAT PLUS BLANCO</b></a>
                                       </span>
      
                                       <small class="d-block">FA0-20410001</small>
                                    </div>
                                 </div>

                                 <div class='col'>
                                    <div class='row h-100'>
                                       <div class='col-12 col-md'>
                                          <div class='h-100 d-flex align-items-center justify-content-center'>
                                             <p class="mb-0">$ 100</p>
                                          </div>
                                       </div>

                                       <div class='col-12 col-md'>
                                          <div class='h-100 d-flex align-items-center justify-content-center'>
                                             <p class="mb-0">5</p>
                                          </div>
                                       </div>
                                       
                                       <div class='col-12 col-md'>
                                          <div class='h-100 d-flex align-items-center justify-content-center'>
                                             <p class="mb-0"><b>$ 500</b></p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                     <h3 class="text-primary text-center"><i class="fas fa-dollar-sign"></i> FACTURACIÓN</h3>

                     <br>

                     <div class="text-muted">
                        <p class="text-sm">Cliente
                           <b class="d-block">Los pollitos amarillos</b>
                        </p>
                     </div>
      
                     <h5 class="mt-5 text-muted">Pagos</h5>

                     <ul class="list-unstyled">
                        <li>
                           <div class='d-flex justify-content-between'>
                              <p class="btn-link text-secondary mb-0">Banco de Venezuela</p>

                              <b class="text-secondary">$ 300</b>
                           </div>
                        </li>

                        <li>
                           <div class='d-flex justify-content-between'>
                              <p class="btn-link text-secondary mb-0">Banesco</p>

                              <b class="text-secondary">$ 200</b>
                           </div>
                        </li>

                        <li class="border-top mt-3 pt-3">
                           <div class='d-flex justify-content-between'>
                              <p class="btn-link text-secondary mb-0">Deuda pendiente</p>

                              <b>$ 200</b>
                           </div>
                        </li>
                     </ul>

                     <div class="text-center mt-5 mb-3">
                        <a href="#" class="btn btn-primary">Agregar pago</a>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.card-body -->
         </div>
      </div>
   </div>
@endsection