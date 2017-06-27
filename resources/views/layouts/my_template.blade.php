<!DOCTYPE html>

<html lang="es"
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-ico" href="{{ asset('images/logoss.ico') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CreaTú</title>
   
  <link rel="stylesheet" href="{{asset('template/bootstrap/css/bootstrap.css')}}"> 
  <link rel="stylesheet" href="{{asset('template/styles.css')}}">
  

<style>
body{
margin:auto;
}
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

        <li><a href="{{ route('index')}}"><b>INICIO</b></a></li>
        <li><a href="{{ route('aboutUs')}}"><b>SOBRE NOSOTROS</b></a></li>
        <li><a href="{{ route('contactUs')}}"><b>CONTACTO</b></a></li>
        <li><a href="{{route('catalogue')}}"><b>CATÁLOGO</b></a></li>
    </ul>

      <ul class="nav navbar-nav">
         
      </ul>
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> 
  

    <div class="title">
         <img src="{{ asset('images/titulo1.png')}}" width="1350"; height="300"> 
    </div>

    <div class="container-change page-styling">


   @yield('content')     
           
        </div>

    
<div class="container">
    <div class="copy-rights">
        Copyright(c) 2017. Todos los derechos reservados<br> 
Desarrollado por: <b>GymSoftware</b>
    </div>
    </div>


   
    


<!--Javascripts-->
 <script src= "{{asset('template/jquery/js/jquery-3.2.1.js')}}"></script>
 <script src= "{{asset('template/bootstrap/js/bootstrap.js')}}"></script>
   
</body>
</html>