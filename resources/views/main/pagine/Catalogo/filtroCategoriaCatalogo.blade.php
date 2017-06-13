@extends('layouts.app')

@section('content')
<div class="container space">
 <div class="row">
 <div class="col-md-3">
        @include('main.pagine.Catalogo.aside')
           
  </div>
<!-- -->
  <div class="col-md-9">
    <div class="panel panel-transparent ">
    <!--body-->
      <div class="panel-body">   
            <!-- works -->

			     
			     @foreach($categories as $category)

			        <div class="card product "style="width: 310px;height: 310px;margin-right:10px; margin-bottom:8px;margin-left: 10px;">
                 
                  <div  style="background:url({{ asset('images/categories/'.$category->extension)  }}); height:100%;background-size: 300px 300px; " class="text-center">
                  <a href="{{ route('searchEventCategory', [$category->id ,  $name]) }}">
                    <button type="button"
                    style="margin-top: 200px;"class="btn btn-success">VER
                      PRODUCTOS 
                    </button> 
                    </a>
                  </div>
              </div>
          @endforeach
			
       </div>
    <!--fin del body-->
      </div>
     <!--fin panel transparente-->
    </div>
  </div>
</div>





@endsection