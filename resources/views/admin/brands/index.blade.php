@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
<h2 class="box-title col-md-5">Marcas encontradas</h2>
      

        
                   <!-- search name form -->
        <form route='admin.brands.index'  method="GET" class="col-md-3 col-md-offset-4 ">
            <div class="input-group">
              <input type="text" name="name" class="form-control" placeholder="Nombre..."> 
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
          <!-- /.search form -->
        <input type ='button' class="btn btn-warning"  value = 'Agregar' onclick="location.href = '{{ route('brands.create') }}'"/> 

</div>
<div class="box-body">              

 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
              
                <th>Nombre</th>
               <th>Estado</th>
               
            </tr>
        </thead>
     
       
<tbody>
   @foreach($brands as $brand) 

          @if ($brand->status!='inactivo')
            <tr role="row" class="odd">
          @else
            <tr role="row" class="odd" style="background-color: rgb(255,96,96);">
          @endif
           
            <td>{{$brand->name}}</td>
            <td>{{$brand->status}}</td>

            

                       
        </tr>
  @endforeach
</tbody>
    </table>




</div>

</div>
@endsection