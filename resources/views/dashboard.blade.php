@extends('layouts.dashboard')

@section('scripts')
   <!-- FLOT CHARTS -->
   <script src="{{ asset('plugins/flot/jquery.flot.js') }}"></script>
   <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
   <script src="{{ asset('plugins/flot/plugins/jquery.flot.resize.js') }}"></script>

   {{-- Graphs --}}
   <script src='{{ asset('js/dashboard/charts.js') }}'></script>
@endsection

@section('content')
<div class="row">
   <x-info-box box-class="bg-info" icon-class="fas fa-dollar-sign" title="Dólar BCV" :text="$dollar" />

   <x-info-box box-class="bg-success" icon-class="fas fa-boxes" title="# de ventas de hoy" :text="$sales_quantity" />
   
   <x-info-box box-class="bg-primary" icon-class="fas fa-shopping-cart" title="Ventas del día" text="$ {{ $today_sales }}" />

   <x-info-box box-class="bg-warning" icon-class="fas fa-receipt" title="Pendiente de hoy" text="$ {{ $today_debt }}" />
</div>
<!-- /.row -->

<div class='row'>
   <div class='col-12 col-md-6'>
      <div class="card card-primary card-outline">
         <div class="card-header">
            <h3 class="card-title">
               <i class="far fa-chart-bar"></i>
               # de ventas de hoy
            </h3>
         </div>

         <div class="card-body">
            <div id="sales-by-office" data-data='{{ json_encode($sales_by_office) }}' style="height: 300px;"></div>
         </div>
         <!-- /.card-body-->
      </div>
      <!-- /.card -->
   </div>

   <div class='col-12 col-md-6'>
      <div class="card card-primary card-outline">
         <div class="card-header">
            <h3 class="card-title">
               <i class="far fa-chart-bar"></i>
               Ventas por sucursal
            </h3>
         </div>

         <div class="card-body">
            <div id="total-by-office" data-data='{{ json_encode($total_by_office) }}' style="height: 300px;"></div>
         </div>
         <!-- /.card-body-->
      </div>
      <!-- /.card -->
   </div>
</div>
<!-- /.row -->

<div class='row'>
   <x-sales-list :sales="$last_sales" />
</div>
<!-- /.row -->
@endsection
