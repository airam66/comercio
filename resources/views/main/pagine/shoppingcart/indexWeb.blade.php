@extends('layouts.my_template')

@section('content')
		      <div class="mi_letter text-center">
                  <h3>Mis carritos confirmados</h3>
                  <img src="{{ asset('images/line.png')}}" alt=""> 
		      </div>
	@if($orders->isNotEmpty()) 
		<div class="box-body">              
		 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
		       
		        <thead>
		            <tr>
		                <th class="text-center">N° Pedido</th>
		                <th>Fecha de Pedido</th>
		                <th>Fecha de Entrega</th>
		                <th>Estado</th>
		                <th>Total</th>
		                <th>Saldo</th>
		                <th></th>
		                   
		            </tr>
		        </thead>       
				<tbody>
		   @foreach ($orders as $order) 
		       <tr role="row" class="odd">
		            <td class="text-center">{{$order->id}}</td>
		            <td>{{$order->created_at->format('d/m/Y')}}</td>
		            <td>{{substr($order->delivery_date,0,10)}}</td>
		            <td>{{ucfirst($order->status)}}</td>
		            <td>$ {{$order->total}}</td>   
		            <th>$ {{$order->total-$order->totalPayments()}}</th>                     
		        </tr>
		   @endforeach

		     </tbody>
		    </table>
		</div>
	@else
	<div>
		Ud. no posee Pedidos pedidos confirmado
	</div>
	@endif
	@if($shoppingcarts->isNotEmpty()) 
			 <div class="mi_letter text-center">
                  <h3>Mis carritos a confirmados</h3>
                  <img src="{{ asset('images/line.png')}}" alt=""> 
		      </div>
		<div class="box-body">              
		 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
		       
		        <thead>
		            <tr>
		                <th class="text-center">N° Pedido</th>
		                <th>Fecha de Pedido</th>
		                <th>Fecha de Entrega</th>
		                <th>Estado</th>
		                <th>Total</th>
		                <th>Para confirmar</th>
		                <th></th>
		                   
		            </tr>
		        </thead>       
				<tbody>
		   @foreach ($shoppingcarts as $cart) 
		       <tr role="row" class="odd">
		            <td class="text-center">{{$cart->id}}</td>
		            <td>{{$cart->created_at->format('d/m/Y')}}</td>
		            <td>{{substr($cart->delivery_date,0,10)}}</td>
		            @if($cart->status=='confirmar')
		            	<td> A confirmar</td>
		            @endif
		            <td>$ {{$cart->total}}</td>   
		            <td> {{6-$dateNow->diff($cart->created_at)->days}} Días</td>                     
		        </tr>
		   @endforeach

		     </tbody>
		    </table>
		</div>
	@else
	<div>
		Ud. no posee Pedidos pedidos a confirmado
	</div>
	@endif

@endsection