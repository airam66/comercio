<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>

<meta charset="UTF-8"/>

<title>CreaTu</title>

<meta name="description" content="Onepage Multipurpose Bootstrap HTML Template">

<meta name="author" content="">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/font-awesome.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/theme.css')}}">

<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>

</head>
<body>
<!--wrapper start-->
<div class="wrapper" id="wrapper">
     
<!--header-->
    <header>

    <div class="banner row"  style=""id="banner">        
        <div class="parallax text-center " style="background-image: url((../img/logo8.jpg)">
            <div class="parallax-pattern-overlay " >
                <div class="container  text-center" style="height:550px; padding-top:170px;">
                <a  target="_blank" href="{{route('catalogue')}}">
                    <button class="btn btn-default btn-log">Ver Catalogo</button>
                </a>
                    <h2 class="intro wow zoomIn" wow-data-delay="0.4s" wow-data-duration="0.9s">Bienvenido</h2>
                </div>
            </div>
        </div>
    </div>  
    <div class="menu">
        <div class="navbar-wrapper">
            <div class="container">
                <div class="nav-wrapper">
                    <div class="navbar navbar-inverse navbar-static-top">
                        <div class="container">
                            <div class="navArea">
                                <div class="navbar-collapse collapse">
                                    <ul class="nav navbar-nav">
                                        <li class="menuItem active"><a href="#main">Inicio</a></li>
                                        <li class="menuItem"><a href="#aboutus">Sobre Nosotros</a></li>
                                        <li class="menuItem "><a href="#contact">Contacto</a></li>
                                      <!--<li class="menuItem "><a href="{{route('catalogue')}}">Catalogo</a></li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    </header>

    <div class="container page-styling">
    <div class="header-wrapper">
      <div class="site-name">
        <img src="{{ asset('assets/img/cotillon.png')}}" width="290" height="130">
      </div>
     
      </div>
    <section class="main" id="main">  
      <div class="banner">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="{{asset('assets/img/recuerdo.jpg')}}" alt="" class="">
      <div class="carousel-caption">
          <i class="fw-icon-pencil"></i>
        <h2>Corem ipsum</h2>
        <h1>sit amet vivamus</h1>
        <a href="#" class="btn"> more info</a>
      </div>
    </div>
    <div class="item">
      <img src="{{asset('assets/img/regalos.jpg')}}" alt="">
      <div class="carousel-caption">
          <i class="fw-icon-pencil"></i>
        <h2>Corem ipsum</h2>
        <h1>sit amet vivamus</h1>
        <a href="#" class="btn"> more info</a>
      </div>
    </div>
    <div class="item">
      <img src="{{asset('assets/img/2.jpg')}}" alt="">
      <div class="carousel-caption">
          <i class="fw-icon-pencil"></i>
        <h2>Corem ipsum</h2>
        <h1>sit amet vivamus</h1>
        <a href="#" class="btn"> more info</a>
      </div>
    </div>
  </div>

  <!-- Controls 
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>-->
</div>
      </div>
      <div class="content-wrap">
        <div class="main-title">
          <ul class="grid effect-8" id="grid">
            <li ><h1>Veni y lleva lo que más te guste</h1>
          <h4>Tenemos diversos productos personalizados.<br> 
Hace de tu fiesta un recuerdo inolvidable.</h4></li>
          </ul>
          
        </div>
      </div>
      </section>

      <div class="ruler"></div>

    <!--Sobre Nosotros-->

      <section class="aboutus" id="aboutus">
      <div class="content-wrap centering">
        <div class="main-title spacing-bt">
          <ul class="grid effect-8" id="grid">
              <li><h1>Sobre Nosotros</h1>
              </li>
          </ul>  
        </div>  

           <div clas="row">
                <div class="papers text-center">
                    <img src="http://wowthemes.net/demo/leroy/img/dummies/18.jpg" alt=""><br/>
                   
                    <h4 class="notopmarg nobotmarg">CreaTú</h4>
                    <p>
                        Somos una empresa familiar que desde hace ... años se dedica a crear productos personalizados y vender otros productos.
                        Comenzamos este negocio como algo.... 
                        Trabajamos con diferenetes materiales, como ser: papel, goma eva, telgopor, fibrofacil, cartón corrugado, entre otros. Hacemos nuestros productos a medida, de acuerdo  las necesidades y gustos de cada cliente.
                        

                    </p>
                </div>
           </div>
        
      </div>
    </section>

    
      
    
    
    
    <!--feedback-->
   <div class="ruler"></div>
       <!-- Sections -->
        <section id="contact" class="contact">
                     
           <div class="content-wrap centering">
        <div class="main-title spacing-bt">
          <ul class="grid effect-8" id="grid">
              <li><h1>Contactanos</h1>
                  
            </li>
          </ul>  
        </div> 
        
       
        </div>
          

        </section>
  </div>
    
<div class="container">
    <div class="copy-rights">
        Copyright(c) 2017. Todos los derechos reservados<br> 
Desarrollado con <i class="fa fa-heart"></i> por: <b>GymSoftware</b>
    </div>
    </div>


   
    
</div><!--wrapper end-->

<!--Javascripts-->
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/js/modernizr.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/menustick.js')}}"></script>
<script src="{{asset('assets/js/parallax.js')}}"></script>
<script src="{{asset('assets/js/easing.js')}}"></script>
<script src="{{asset('assets/js/wow.js')}}"></script>
<script src="{{asset('assets/js/smoothscroll.js')}}"></script>
<script src="{{asset('assets/js/masonry.js')}}"></script>
<script src="{{asset('assets/js/imgloaded.js')}}"></script>
<script src="{{asset('assets/js/classie.js')}}"></script>
<script src="{{asset('assets/js/colorfinder.js')}}"></script>
<script src="{{asset('assets/js/gridscroll.js')}}"></script>
<script src="{{asset('assets/js/contact.js')}}"></script>
<script src="{{asset('assets/js/common.js')}}"></script>

<script type="text/javascript">
jQuery(function($) {
$(document).ready( function() {
  //enabling stickUp on the '.navbar-wrapper' class
    $('.navbar-wrapper').stickUp({
        parts: {
          0: 'main',
          1: 'aboutus',
          2: 'contact'
        },
        itemClass: 'menuItem',
        itemHover: 'active',
        topMargin: 'auto'
        });
    });
});
</script>
</body>
</html>