<!DOCTYPE html>
<html lang="es"
<head>
    <meta charset="UTF-8">
    <title>CreaTú</title>
   
  <link rel="stylesheet" href="{{asset('template/bootstrap/css/bootstrap.css')}}"> 
  <link rel="stylesheet" href="{{asset('template/styles.css')}}">


<style>
body{
margin:auto;}
</style>

</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">



    <ul class="nav navbar-nav navbar-right">

        <li><a href="{{ route('index2')}}"><b>INICIO</b></a></li>
        <li><a href="{{ route('aboutUs')}}"><b>SOBRE NOSOTROS</b></a></li>
        <li><a href="{{ route('contactUs')}}"><b>CONTACTO</b></a></li>
        <li><a href="{{route('catalogue')}}"><b>CATÁLOGO</b></a></li>
    </ul>

      <ul class="nav navbar-nav">
         
      </ul>
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> 

  <div class="container text-center" style="height:580px;padding-top:170px;">
      <h2 class="intro" wow-data-delay="0.4s" wow-data-duration="1s">Bienvenido</h2>
  </div>

 
  <!-- <section class="section-admin">

  
  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">@yield('title','default')</h3>
   </div>
  <div class="panel-body">
  @include('flash::message')
 

  @yield('content')
   </div>
   </div>
    </section>-->


   <script src= "{{asset('template/jquery/js/jquery-3.2.1.js')}}"></script>
   <script src= "{{asset('template/bootstrap/js/bootstrap.js')}}"></script>
   


</body>
 </html>