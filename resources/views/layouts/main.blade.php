<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Creatu</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{asset('css/my_style.css')}}">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="shortcut icon" type="image/x-ico" href="{{ asset('images/logoss.ico') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/flat/blue.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker-bs3.css')}}">


    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
   
    <link rel="stylesheet" href="{{asset('bower_components/EasyAutocomplete/dist/easy-autocomplete.css')}}">
    

    <link rel="stylesheet" href="{{asset('plugins/chosen/chosen.css')}}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script> 
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Crea</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Cotillon</b>CreaTu</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">      
             
                
              <!-- User Account: style can be found in dropdown.less -->

                  <!-- Authentication Links -->
                 @if (Auth::guest())

                 @else
                   
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                </a>

                                <ul class="dropdown-menu">

                                <!-- User image -->
                                  <li class="user-header">
                                   <img src="dist/img/default-50x50.gif" class="img-circle" alt="User Image">
                                    <p>
                                      {{ Auth::user()->name }}
                                       <small>Miembro desde {{Auth::user()->created_at}}</small>
                                   </p>
                                   </li>
                                <!-- Menu footer-->
                                    <li class="user-footer">
                                      <div class="pull-left">
                                      <a href="{{route('users.editPassword')}}" class="btn btn-default btn-flat">Perfil</a>
                                     </div>
                                    <div class="pull-right">

                                       <a href="{{ route('logout') }}" class="btn btn-default btn-flat" id="logout"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Salir
                                       </a>

                                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="submit" value="logout" style="display: none;">
                                       </form>



                                    
                                    </div>     
                                   </li>
                                   
                                 </ul>
                              </li> 
                  @endif   
                 
  
                </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
               <p>{{ Auth::user()->name }}</p>
             <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
          </div>
          
          <ul class="sidebar-menu">
            <li class="header">MENU PRINCIPAL</li>

            <li class="treeview">
              <a href="#">
                 <i class="fa fa-gift"></i>
                 <span>Productos</span> <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu">
                <li class="active"><a href="{{route('categories.index')}}"><i class="fa fa-circle-o"></i> Lista de categorias</a></li>
                <li class="active"><a href="{{route('events.index')}}"><i class="fa fa-circle-o"></i> Lista de eventos</a></li>
                <li class="active"><a href="{{route('lines.index')}}"><i class="fa fa-circle-o"></i> Lista de lineas</a></li>
                <li class="active"><a href="{{route('brands.index')}}"><i class="fa fa-circle-o"></i> Lista de marcas</a></li>
                <li class="active"><a href="{{route('products.index')}}"><i class="fa fa-circle-o"></i> Lista de productos</a></li>

                 <li class="active"><a href="{{route('craftProducts')}}"><i class="fa fa-circle-o"></i> Stock Productos Personalizados</a></li>
                 <li class="active"><a href="{{route('updateStockCreate')}}"><i class="fa fa-circle-o"></i> Stock materiales</a></li>


                <li class="active"><a href="{{route('porcentages.create')}}"><i class="fa fa-circle-o"></i> Porcentajes de ventas</a></li>
               <!-- <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>-->
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                 <i class="fa fa-money"></i>
                 <span>Ventas</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                <li class="active"><a href="{{route('invoices.index')}}"><i class="fa fa-circle-o"></i> Lista de ventas</a></li>
               <!-- <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>-->
            </ul>
            </li>
            <li class="treeview">
              <a href="#">
                 <i class="glyphicon glyphicon-shopping-cart"></i>
                 <span>Compras</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                <li class="active"><a href="{{route('purchases.index')}}"><i class="fa fa-circle-o"></i> Lista de Ordenes de Compras</a></li>
                <li class="active"><a href="{{route('purchasesInvoice.index')}}"><i class="fa fa-circle-o"></i> Lista de Facturas de Compras</a></li>
               <!-- <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>-->
            </ul>
            </li>
            <li class="treeview">
              <a href="#">
                 <i class="fa fa-truck"></i>
                 <span>Pedidos</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li class="active"><a href="{{route('orders.index')}}"><i class="fa fa-circle-o"></i>Lista de pedidos</a></li>
                  </ul>
            </li>
            <li class="treeview">
              <a href="#">
                 <i class="fa fa-user"></i>
                 <span>Personas</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                <li class="active"><a href="{{route('clients.index')}}"><i class="fa fa-circle-o"></i>Lista de clientes</a></li>
                <li class="active"><a href="{{route('providers.index')}}"><i class="fa fa-circle-o"></i> Lista de proveedores</a></li>
                <li class="active"><a href="{{route('providersproducts.create')}}"><i class="fa fa-circle-o"></i> Proveedores por productos</a></li>
               <!-- <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>-->
            </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                 <i class="fa fa-user"></i>
                 <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                <li class="active"><a href="{{route('users.create')}}"><i class="fa fa-circle-o"></i>Lista de usuarios</a></li>
            </ul>
            </li>

            
            <li class="treeview">
              <a href="#">
                 <i class="fa fa-fw fa-database"></i>
                 <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                <li class="active"><a href="{{route('pdfReport')}}"><i class="fa fa-circle-o"></i> Productos</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                 <i class="fa fa-laptop"></i>
                 <span>Pagina Web</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
               <ul class="treeview-menu">
                <li class="active"><a href="{{route('carrusel.index')}}"><i class="fa fa-circle-o"></i> Lista de imagenes</a></li>
              

              </ul>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <!-- < <section class="content-header">
          <h1>
           Panel de Control
           
          </h1>
        </section>-->

        <!-- Main content -->
        <section class="content">

        @include('flash::message')  
         <!--@include('partials.errors')-->
             
        @yield('content')

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer no-print">
        <div class="pull-right hidden-xs">
          <b>Desarrollado por GYMSoftware</b> 
        </div>
        <strong>Copyright &copy; 2017. Todos los derechos reservados</strong> 
      </footer>

      <!-- Control Sidebar -->
       
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>

    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
   

    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{asset('plugins/morris/morris.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/knob/jquery.knob.js')}}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
   <!--mydateranguepincker-->

          <!-- Include Required Prerequisites -->
      
      <script type="text/javascript" src="{{asset('plugins/daterangepicker/moment.min.js')}}"></script>
      
 
      <!-- Include Date Range Picker -->
     
      <link rel="stylesheet" type="text/css" href="{{asset('plugins/daterangepicker/daterangepicker-bs3.css')}}" />

    <!-- datepicker -->
    <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
     



    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/app.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}}"></script>
    <!--fechas-->
  

    <!--fin fechas-->
  
    <script src="{{asset('bower_components/EasyAutocomplete/dist/jquery.easy-autocomplete.js')}}"></script>

    <script src="{{asset('plugins/chosen/chosen.jquery.js')}}"></script>
   
    
    @yield('js')
    @stack('scripts')
    
    <script>
      function baseUrl(url){
        return "{{url('')}}/"+url;
      }
    </script>
  </body>
</html>
