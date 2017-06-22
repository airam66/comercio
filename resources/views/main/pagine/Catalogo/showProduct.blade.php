@extends('layouts.my_template')
   
@section('content') 

<div class="content-wrap centering">
      <div class="mi_letter text-center">
                  <h1>Nuestros productos</h1>
                  <img src="{{ asset('images/line.png')}}" alt=""> 
      </div>
                     
       <div class="row">  
          <div class="col-md-3">
             @include('main.pagine.Catalogo.aside')
           
           </div> 

          <div class="col-md-9">
               
             <div >   
            <!-- works -->

           
           <div class="content-wrap centering">
	   
		<div class="card product-show text-left" >
		   
          
			<h1> {{$product->name}} </h1>
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<img src="{{ asset('images/products/'.$product->extension)  }}" width="300" height="300">
				</div>
				<div class="col-sm-6 col-xs-12 text-center">
				<p >
					<strong>Descripción</strong>

				</p>
				<p >
					{{$product->description}}
				</p>
				<p><b> Marca:</b>{{$product->brand->name}}</p>
				
				</div>
			</div>
		</div>
     </div>
      
       </div>
              
          </div> 
          <div class="text-center">
           
          </div>
        </div>  

        <div class="text-center">
        <img src="{{ asset('images/line.png')}}" alt=""> 
        </div>
</div>
 
@endsection