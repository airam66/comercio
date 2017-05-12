<!DOCTYPE html>
<html lang="es"
<head>
    <meta charset="UTF-8">
    <title>Panel de Administracion</title>
   
   <link href="plugins/nicebootstrap/css/style.css" rel="stylesheet"/>

</head>

<body class="login-img3-body">
    
   <div nav class="navbar navbar-inverse">
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

        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else



                        
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
        </ul>


    @if(Auth::user())
      <ul class="nav navbar-nav">
         <li><a href="#">Inicio</a></li>
        <li><a href="{{ route('users.index')}}">Usuarios</a></li>
        <li><a href="{{ route('categories.index')}}">Categorias</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Articulos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        <li><a href="#">Tag</a></li>
        <li><a href="#">Imagenes</a></li>
      </ul>
     








       
       
      

      @endif
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

 
   <section class="section-admin">

  
  <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">@yield('title','default')</h3>
   </div>
  <div class="panel-body">
 

  @yield('content')
   </div>
   </div>
   	
<script src= "{{asset('plugins/jquery/js/jquery-3.2.1.js')}}"></script>
   <script src= "{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

   </section>

    

</body>
 </html>