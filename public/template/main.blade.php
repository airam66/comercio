<!DOCTYPE html>
<html lang="es"
<head>
    <meta charset="UTF-8">
    <title>Panel de Administracion</title>
   
  <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.css')}}"> 
  <link rel="stylesheet" href="{{asset('plugins/chosen/chosen.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/trumbowyg/ui/trumbowyg.css')}}">

<style>
body{width:80%;
margin:auto;}
</style>

</head>

<body>
  @include('admin.template.partials.nav') 

 
   <section class="section-admin">

  
  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">@yield('title','default')</h3>
   </div>
  <div class="panel-body">
  @include('flash::message')
  @include('admin.template.partials.errors')

  @yield('content')
   </div>
   </div>
    </section>


   <script src= "{{asset('plugins/jquery/js/jquery-3.2.1.js')}}"></script>
   <script src= "{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
   <script src="{{asset('plugins/chosen/chosen.jquery.js')}}"></script>
   <script src="{{asset('plugins/trumbowyg/trumbowyg.js')}}"></script>

   @yield('js')
      

</body>
 </html>