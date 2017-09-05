@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info text-center">
          
          <h1> <b>Bienvenido al panel de administración</b></h1>
       
          <!-- /.box-body -->
        </div>
      <div class="box box-info">
        <div class="row text-center">
        <h3> <b>Accesos rapidos</b></h3>
        </div>
        <div class="row text-center">
          <div class="col-md-6 text-center">
            <a href="{{route('products.index')}}" id="ProductIndex"><button><img src="{{ asset('images/main/list.png')}}" width="150" height="150"><br> Lista de productos</button></a>
          </div>
          <div class="col-md-5 text-center">
            <a href="{{route('invoices.create')}}" id="sales"><button><img src="{{ asset('images/main/sale.png')}}" width="150" height="150"><br> Nueva venta</button></a>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-6 text-center">
            <a href="{{route('orders.create')}}" id="orders"><button><img src="{{ asset('images/main/truck.png')}}" width="150" height="150"><br> Nuevo pedido</button></a>
          </div>
          <div class="col-md-5 text-center">
            <a href="{{route('calendar')}}" target="_blank" id="calendar"><button><img src="{{ asset('images/main/calendar.png')}} " width="150" height="150"><br> Calendario</button></a>
          </div>
        </div>
      </div>
           
        <!-- /.box -->

      </div>
    </div>
  </div>
@endsection
