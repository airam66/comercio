@extends('layouts.my_template')

@section('content')
      <div class="mi_letter text-center">
                  <h3>Mi Carrito</h3>
       <img src="{{ asset('images/line.png')}}" alt=""> 
      <br>
      Señor/a {{\Auth::user()->name}} Ud. pose 6 dia desde el dia de la fecha para acercarse a nuestrad direccion y confirmar su compra. Muchas Gracias.<br>


@if($dateNow->diff($user->updated_at)->days>0)
    {!! Form::model(Auth::user(),['route'=>'webUsers.changeDatas', 'method'=>'PUT','files'=>true])!!}
        <center>
              <div class="row">              
            <div class="col-md-6" >
               <h3>Confirmar información</h3>
               <hr> 
               
              {!! Field::text('name',$user->name)!!}
              
              <label> Localidad</label><br>
              {!! Form::select('location',['Rosario de Lerma'=>'Rosario de Lerma','Salta'=>'Salta','San Lorenzo'=>'San Lorenzo','Cerrillos'=>'Cerrillos','Chicoana'=>'Chicoana','La Merced'=>'La Merced'],$client->location,['class'=>'form-control chosen-select'])!!} 
            
               {!! Field::text('address',$client->address)!!}
             
              {!! Field::number('phone',$client->phone)!!}
              
               {!! Field::email('email',Auth::user()->email,['disabled'])!!}
         
              <div class="form-group">
              <input class="btn btn-success" type="submit" value="Guardar cambios" id="Confirmar">
              </div>
          
               </div> 
        </div>
        </center>
            {!! Form::close() !!}
@else
			<div class="form-group">
            <a href="{{route('my_order.pdf')}}" target="_blank" > 
            <button  type="button" class="btn btn-primary "  ><i class="fa fa-print"></i>Imprimir comprobante PDF</button>
            </a>
           </div>
           <br><br>
      </div>
@endif
@endsection
