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
               

              <div>
                @if(empty($products))
                   <p>No hay datos para mostrar</p>
                @else
                  @foreach($products as $product)
                   <div class="card product mystyle">
                     <div>
                       @if($product->extension!=null)
             
                          <img src="{{ asset('images/products/'.$product->extension)  }}"  width="160" height="150" >
            
                       @endif
                      </div>
                    <div >
                       <h4 class="text-center" style="height: 30px;">{{$product->name}}</h4>
                          <div class="text-right" >
                            <!--href="{{ route('catalogueShow.show', $product->id ) }}"-->
                            <a  href="{{ route('catalogueShow.show', $product->id ) }}" >
                               <img src="{{ asset('images/informacion3.png ') }}" width="45" height="45"  > 
                            </a>
                          </div>
                    </div>
                   </div>
                  @endforeach
               @endif
             </div>
          </div> 
          <div class="text-center">
           {!!$products->links()!!} 
          </div>
        </div>  

        <div class="text-center">
        <img src="{{ asset('images/line.png')}}" alt=""> 
        </div>
</div>


@endsection