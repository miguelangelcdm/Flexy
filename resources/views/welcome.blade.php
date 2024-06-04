<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <div id="wrapper">
    <div id="content">
      <!-- Start header -->
      <header class="header-nav-center active-blue" id="myNavbar">
        <div class="container">
          <!-- navbar -->
          <nav class="navbar navbar-expand-lg navbar-light px-sm-0">
            <a class="" href="../../index.html" >
              <img class="logo" src="{{ asset('img/flexy.png') }}" alt="logo" style="height: auto; width: 100px" />

            </a>
            <button class="navbar-toggler menu ripplemenu" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <svg viewBox="0 0 64 48">
                <path d="M19,15 L45,15 C70,15 58,-2 49.0177126,7 L19,37"></path>
                <path d="M19,24 L45,24 C61.2371586,24 57,49 41,33 L32,24"></path>
                <path d="M45,33 L19,33 C-8,33 6,-2 22,14 L45,37"></path>
              </svg>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mx-auto nav-pills">
                <li class="nav-item">
                  <a class="nav-link" href="#Products">Productos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#Features">Características</a>
                </li>
            
              </ul>
              <div class="nav_account btn_demo3">
                <a href="#Products" class="btn btn_sm_primary c-dark effect-letter rounded-8">
                  Descargar
                </a>
              </div>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>
        <!-- end container -->
      </header>
      <!-- End header -->

      <!-- Stat main -->
      <main data-spy="scroll" data-target="#navbar-example2" data-offset="0">
        <!-- Start Banner Section -->
        <section class="demo_1 banner_section banner_demo8">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-lg-5 order-2 order-lg-1">
                <div class="banner_title">
                  <h1>
                    Ahorra grande en cada orden<br>
                    <span class="c-purple">Dinero. Tiempo</span>
                  </h1>
                  <p>
                    En flexy encontrarás: grandes marcas
                    Envios gratis. Probadores virtuales.
                    Y mucho más
                    <span class="c-aquamarine">Gratis</span> las 24 horas del dia.
                  </p>
                  <div class="subscribe_phone">
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <input type="text" class="form-control rounded-8" placeholder="Ingresa tu número de telefono" />
                        </div>
                        <div class="button--click">
                          <button type="button" class="btn btn_app btn_xl_primary scale c-gradient">
                            Obten la app
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-7 mx-auto order-1 order-lg-1">
                <div class="ill_appMobile">
                  <img class="ill_app" src="{{ asset('img/app/c_app.svg') }}" />
                  <img class="ill_bg" src="{{ asset('img/app/background.svg') }}" />
                  <img class="ill_user" src="{{ asset('img/app/user.svg') }}" />
                  <a href="#" class="btn btn_lg_primary effect-letter try_it bg-gold c-dark rounded-8">Pruéba la app gratis</a>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Banner -->

        <!-- Start Services -->
        <section class="services_section service_demo5 padding-t-12">
          <div class="container">
            <div class="row justify-content-md-center">
              <div class="col-md-8 col-lg-6 text-center">
                <div class="title_sections">
                  <div class="before_title">
                    <span>Nuestros</span>
                    <span class="c-gold">Servicios</span>
                  </div>
                  <h2>Servicios exclusivos que ofrecemos</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-lg-4 beta">
                <div class="items_serv" data-aos="fade-up" data-aos-delay="0">
                  <div class="media">
                    <div class="item-img">
                      <img src="{{ asset('img/icons/Miso-soup.svg') }}" alt="" />
                    </div>
                    <div class="media-body my-auto">
                      <h3>Explora miles de prendas, desde la comodidad de tu hogar.</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 beta">
                <div class="items_serv selected" data-aos="fade-up" data-aos-delay="100">
                  <div class="media">
                    <div class="item-img">
                      <img src="{{asset('img/icons/Direction.svg')}}" alt="" />
                    </div>
                    <div class="media-body">
                      <h3>Despreocupate de tallas equivocadas, prendas incorrectas.</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 beta">
                <div class="items_serv" data-aos="fade-up" data-aos-delay="200">
                  <div class="media">
                    <div class="item-img">
                      <img src="{{ asset('img/icons/Thunder-white.svg') }}" alt="" />
                    </div>
                    <div class="media-body">
                      <h3>Servicio al cliente las 24h del dia, los 7 dias a la semana.</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Services -->

        <!-- Start feature_app -->
        <section class="feature_app feature_demo2 margin-t-12 padding-t-12" id="Products">
          <div class="container">
            <div class="row justify-content-md-center">
              <div class="col-md-10 col-lg-6 text-center">
                <div class="title_sections">
                  <div class="before_title">
                    <span>Flexy.</span>
                    <span class="c-gold">Explora</span>
                  </div>
                  <h2>Empieza una nueva experiencia con Flexy.</h2>
                  <p>
                    Miles de productos, marcas, proveedores, ofertas, descuentos y muchos
                  </p>
                  <div class="z_apps">
                    <a href="#" target="_blank" class="item__app bg_apple mb-3 mb-sm-0" style="text-decoration: none">

                      <div class="media" style="justify-content: center; align-items:center">
                        {{-- <i class="tio apple icon"></i> --}}
                        <img src="{{ asset('img/icons/Icon.svg') }}" alt="" style="margin-right: 0.5rem">
                        <div class="media-body">
                          <div class="txt">
                            <span>Available on the</span>
                            <h4>App Store</h4>
                          </div>
                        </div>
                      </div>
                    </a>
                    <a href="#" target="_blank" class="item__app bg_google" style="text-decoration: none">
                       <div class="media" style="justify-content: center; align-items:center">
                        <img src="{{ asset('img/icons/Google.svg') }}" alt="" style="margin-right: 0.5rem">
                        <div class="media-body">
                          <div class="txt">
                            <span>Get it on</span>
                            <h4>Google Play</h4>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row d-flex">
              <div class="col-md-6 col-lg-4 d-none d-sm-block order-1 order-sm-1">
                <div class="item_box item_one">
                  <div class="img_bbo">
                    <img src="{{ asset('img/p1.png') }}" />
                  </div>
                  <h3>Casacas</h3>
                  <p class="c-blue">
                    Desde $14
                  </p>
                </div>
                <div class="item_box item_two">
                  <div class="img_bbo">
                    <img src="{{ asset('img/p2.png') }}" />
                  </div>
                  <h3>Zapatillas</h3>
                  <p class="c-green">
                    Desde $27
                  </p>
                </div>
                <div class="item_box item_three">
                  <div class="img_bbo">
                    <img src="{{ asset('img/p3.png') }}" />
                  </div>
                  <h3>Zapatillas</h3>
                  <p class="c-red">
                    Desde $22
                  </p>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 order-3 order-sm-2" data-aos="fade-up" data-aos-delay="0">
                <div class="app_mobile">
                  <img class="apoo" src="{{ asset('img/flexy_landing.png') }}" />
                </div>
              </div>
              <div class="col-md-6 col-lg-4 d-none d-sm-block order-2 order-sm-3">
                <div class="item_box item_four">
                  <div class="img_bbo">
                    <img src="{{ asset('img/p4.png') }}" />
                  </div>
                  <h3>SweatShirts</h3>
                  <p class="c-aquamarine">
                    Desde $25
                  </p>
                </div>
                <div class="item_box item_five">
                  <div class="img_bbo">
                    <img src="{{ asset('img/p5.png') }}" />
                  </div>
                  <h3>Branch Special</h3>
                  <p class="c-blue">
                    $14
                  </p>
                </div>
                <div class="item_box item_six">
                  <div class="img_bbo">
                    <img src="{{ asset('img/p6.png') }}" />
                  </div>
                  <h3>Pantalones deportivos</h3>
                  <p class="c-orange">
                    Desde $29
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. feature_app -->

        <!-- Start logos 3 -->
        <section class="logos_section logos_demo3 padding-py-5 text-center">
          <div class="container">
            <h3 class="margin-b-4">
              Marcas presentes en Flexy
            </h3>
            <div class="row justify-content-md-center">
              <div class="col-md-12">
                <div class="items_loog">
                  <div class="item-client mb-3 mb-lg-0">
                    <img width="130" src="{{ asset('img/UA.png') }}" alt="" />
                  </div>
                  <div class="item-client mb-3 mb-lg-0">
                    <img width="130" src="{{ asset('img/Puma.png') }}" alt="" />
                  </div>
                  <div class="item-client mb-3 mb-lg-0">
                    <img width="130" src="{{ asset('img/Nike.png') }}" alt="" />
                  </div>
                  <div class="item-client mb-3 mb-lg-0">
                    <img width="130" src="{{ asset('img/Reebok.png') }}" alt="" />
                  </div>
                  <div class="item-client mb-3 mb-lg-0">
                    <img width="130" src="{{ asset('img/Adidas.png') }}" alt="" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <div id="trigger2"></div>
        <!-- Section Service -->
        <section class="serv_app padding-t-12">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="amo_pic">
                  <img id="animate2" src="{{ asset('img/virtualtry.jpeg') }}" style="border-radius: 60px"/>
                </div>
              </div>
              <div class="col-lg-5 my-auto mx-auto">
                <div class="title_sections mb-0">
                  <div class="before_title">
                    <span>Probadores</span>
                    <span class="c-gold">Virtuales</span>
                  </div>
                  <h2>Sin salir de casa. Todo en un solo lugar</h2>
                  <p>
                    Olvidate de los probadores llenos o no disponibles, cientos de horas sin encontrar la prenda que busca. Decenas de tiendas.
                  </p>
                  <a href="#" class="btn btn_lg_primary effect-letter rounded-8 margin-t-4 bg-gold c-dark">
                    Pruebala gratis</a>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. serv_app -->

        <div id="trigger3"></div>
        <!-- Section Service -->
        <section class="serv_app padding-t-12">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-5 my-auto order-2 order-lg-1">
                <div class="title_sections mb-0">
                  <div class="before_title">
                    <span>Ahorra</span>
                    <span class="c-gold">Tiempo</span>
                  </div>
                  <h2>Con sugerencias presonalizadas para tí.</h2>
                  <p>
                   Olvidate de scrollear diversos productos en diversos marketplaces. Tenemos lo que de VERDAD estas buscando, sabemos lo que de verdad estas buscando
                  <div class="app_smartphone margin-t-4">
                    <div class="btn--app mb-3 d-block">
                      <a class="media" href="#" target="_blank">
                        <div class="icon dark">
                          {{-- <i class="tio apple"></i> --}}
                          <img src="{{ asset('img/icons/Apple.svg') }}" alt="">
                        </div>
                        <div class="media-body txt">
                          <div>
                            <span class="c-light">Descargar</span>
                          </div>
                          <h4 class="c-dark">Google Store</h4>
                        </div>
                      </a>
                    </div>
                    <div class="btn--app">
                      <a class="media" href="#" target="_blank">
                        <div class="icon blue">
                          <img src="{{ asset('img/icons/Google.svg') }}" alt="">
                        </div>
                        <div class="media-body txt">
                          <div>
                            <span class="c-light">Descargar</span>
                          </div>
                          <h4 class="c-dark">App Store</h4>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 mx-auto mb-4 mb-lg-0 order-1 order-lg-1">
                <div class="amo_pic">
                  <img id="animate3" src="{{ asset('img/parati.jpeg') }}" style="border-radius:50px" />
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. serv_app -->

        <!-- feature_dem3 -->
        <section class="feature_dem3 padding-t-12 margin-t-12" id="Features">
          <div class="container">
            <div class="row justify-content-center text-center">
              <div class="col-md-8 col-lg-6">
                <div class="title_sections">
                  <div class="before_title">
                    <span>Nuestras</span>
                    <span class="c-gold">Caracteristicas</span>
                  </div>
                  <h2>Porque escoger nuestra app</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-lg-4 Oitem margin-b-5">
                <div class="item_feth" data-aos="fade-up" data-aos-delay="0">
                  <div class="media">
                    <div class="icon_fr">
                      <img src="{{ asset('img/icons/Dial-numbers.svg') }}" />
                    </div>
                    <div class="media-body">
                      <div class="za_tzt">
                        <h3>Catálogo</h3>
                        <p>
                          Accede a una variedad de marcas de ropa en una sola aplicación, facilitando tus compras y ahorrándote tiempo
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 Oitem margin-b-5">
                <div class="item_feth" data-aos="fade-up" data-aos-delay="100">
                  <div class="media">
                    <div class="icon_fr">
                      <img src="{{ asset('img/icons/Crown.svg') }}" />
                    </div>
                    <div class="media-body">
                      <div class="za_tzt">
                        <h3>Probador de realidad aumentada</h3>
                        <p>
                          Prueba la ropa virtualmente con nuestro probador de realidad aumentada y elige el ajuste perfecto sin salir de casa.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 Oitem margin-b-5">
                <div class="item_feth" data-aos="fade-up" data-aos-delay="200">
                  <div class="media">
                    <div class="icon_fr">
                      <img src="{{ asset('img/icons/Cloud-upload.svg') }}" />
                    </div>
                    <div class="media-body">
                      <div class="za_tzt">
                        <h3>Almacenamiento en la nube</h3>
                        <p>
                          Guarda tus preferencias y estilos favoritos en la nube para acceder a ellos en cualquier momento y lugar.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 Oitem">
                <div class="item_feth" data-aos="fade-up" data-aos-delay="0">
                  <div class="media">
                    <div class="icon_fr">
                      <img src="{{ asset('img/icons/Settings-white.svg') }}" />
                    </div>
                    <div class="media-body">
                      <div class="za_tzt">
                        <h3>Personalizacion</h3>
                        <p>
                          Personaliza tu experiencia de compra con recomendaciones basadas en tus preferencias y estilos anteriores.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 Oitem">
                <div class="item_feth" data-aos="fade-up" data-aos-delay="100">
                  <div class="media">
                    <div class="icon_fr">
                      <img src="{{ asset('img/icons/Pen&ruller.svg') }}" />
                    </div>
                    <div class="media-body">
                      <div class="za_tzt">
                        <h3>Navegación intutitiva</h3>
                        <p>
                          Disfruta de una navegación intuitiva y fluida diseñada para mejorar tu experiencia de usuario y hacer tus compras más agradables.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 Oitem">
                <div class="item_feth" data-aos="fade-up" data-aos-delay="200">
                  <div class="media">
                    <div class="icon_fr">
                      <img src="{{ asset('img/icons/Headphones-white.svg') }}" />
                    </div>
                    <div class="media-body">
                      <div class="za_tzt">
                        <h3>Equipo de soporte al cliente</h3>
                        <p>
                          Recibe asistencia inmediata a través de nuestro soporte al cliente disponible 24/7, asegurando una experiencia de compra sin problemas.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. feature_dem3 -->

        <!-- Start FAQ -->
        <section class="faq_demo2 faq_demo4 padding-t-12" id="FAQ">
          <div class="container">
            <div class="row justify-content-md-center">
              <div class="col-md-8 col-lg-6 text-center">
                <div class="title_sections">
                  <div class="before_title">
                    <span>Preguntas</span>
                    <span class="c-gold">Frecuentes</span>
                  </div>
                  <h2>Aún tienes <br />dudas?</h2>
                </div>
              </div>
            </div>
            <div class="row justify-content-md-center">
              <div class="col-md-10 col-lg-5 pr-lg-5">
                <div class="item_list">
                  <h4>
                    <span class="hline"></span>Cómo utilizo el probador de realidad aumentada?
                  </h4>
                  <p>
                    Puedes probarte ropa virtualmente usando la cámara de tu dispositivo. Simplemente selecciona una prenda, activa el probador de realidad aumentada y mira cómo te queda en tiempo real.
                  </p>
                </div>
                <div class="item_list">
                  <h4>Qué marcas están disponibles en la aplicación?</h4>
                  <p>
                   Nuestra aplicación agrupa una amplia variedad de marcas reconocidas y emergentes de ropa para ofrecerte la mejor selección de productos.
                  </p>
                </div>
                <div class="item_list">
                  <h4>Cómo guardo mis preferencias de ropa?</h4>
                  <p>
                    Tus preferencias se guardan automáticamente en la nube cada vez que haces una selección o compras un producto. Puedes acceder a ellas en cualquier momento desde tu perfil.
                  </p>
                </div>
              </div>
              <div class="col-md-10 col-lg-5">
                <div class="item_list">
                  <h4>Puedo personalizar mis recomendaciones?</h4>
                  <p>
                    Sí, nuestra aplicación utiliza algoritmos avanzados para personalizar las recomendaciones basadas en tu historial de compras y preferencias. También puedes ajustar tus preferencias manualmente en la configuración.
                  </p>
                </div>
                <div class="item_list">
                  <h4>Cómo contacto con el servicio al cliente?</h4>
                  <p>
                    Puedes contactar con nuestro servicio al cliente a través del chat en la aplicación o enviando un correo electrónico a soporte@miapp.com. Estamos disponibles 24/7 para ayudarte.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End FAQ -->

        <!-- Start Statistic -->
        {{-- <section class="padding-t-12 section_state state_demo2" id="Statistic">
          <!-- particle background -->
          <div id="particles-js"></div>
          <div class="container">
            <div id="triggerBlur"></div>
            <div class="row justify-content-center text-center">
              <div class="col-md-8 col-lg-6">
                <div class="title_sections">
                  <div class="before_title">
                    <span>Clients</span>
                    <span class="c-gold">Trust</span>
                  </div>
                  <h2>Trust us and feel free to try our service</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="bb_qgency_state">
                  <div class="number_state">
                    <div class="txt">
                      185 000
                    </div>
                  </div>
                  <div class="blur_item"></div>
                  <div class="content_state">
                    <div class="row justify-content-md-center">
                      <div class="col-md-2">
                        <div class="it__em">
                          <div class="icon">
                            <img src="{{ asset('img/icons/1f469.png') }}" />
                          </div>
                          <div class="info_txt">
                            <h4>25 000</h4>
                            <p>
                              Followers from all countries of the world
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="it__em">
                          <div class="icon">
                            <img src="{{ asset('img/icons/2665.png') }}" />
                          </div>
                          <div class="info_txt">
                            <h4>130 000</h4>
                            <p>
                              Likes and encouragement
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="it__em">
                          <div class="icon">
                            <img src="{{ asset('img/icons/1f58c.png') }}" />
                          </div>
                          <div class="info_txt">
                            <h4>7 200</h4>
                            <p>
                              Agency designs from 2012
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="it__em">
                          <div class="icon">
                            <img src="{{ asset('img/icons/1f647-2640.png') }}" />
                          </div>
                          <div class="info_txt">
                            <h4>15 320</h4>
                            <p>
                              Discussions and business requests
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="users_profile">
                    <img src="{{ asset('img/persons/02.png') }}" />
                    <img src="{{ asset('img/persons/02.png') }}" />
                    <img src="{{ asset('img/persons/02.png') }}" />
                    <img src="{{ asset('img/persons/02.png') }}" />
                    <img src="{{ asset('img/persons/02.png') }}" />
                    <img src="{{ asset('img/persons/02.png') }}" />
                    <img src="{{ asset('img/persons/02.png') }}" />
                  </div>
                  <div class="link_state">
                    <a href="#" class="btn btn_xl_primary btn_join bg-gold c-dark effect-letter rounded-8 mb-3 mb-sm-0">
                      Join The Agency</a>
                    <a href="#" class="btn btn_xl_primary btn_touch rounded-8">
                      <img src="{{ asset('img/icons/1f607.png') }}" />
                      Get a touch
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section> --}}
      </main>
      <!-- end main -->

      <!-- [id] content -->
      <footer class="footer_short bg-white padding-t-12">
        <div class="container">
          <div class="row justify-content-md-center text-center">
            <div class="col-md-8">
              <a class="c-dark" href="mobile-app.html">
                <img src="{{ asset('img/Flexy.png') }}" alt="" style="height: auto; width: 100px">
              </a>
              <div class="social--media">
                <a href="#" class="btn so-link flex justify-center items-center">
                  {{-- <i class="tio appstore"></i> --}}
                  <img src="{{ asset('img/icons/Apple.svg') }}" alt="">
                </a>
                <a href="#" class="btn so-link flex justify-center items-center">
                  <img src="{{ asset('img/icons/x.png') }}" alt="">
                </a>
                <a href="#" class="btn so-link flex justify-center items-center">
                  <img src="{{ asset('img/icons/Google.svg') }}" alt="">
                </a>
                <a href="#" class="btn so-link flex justify-center items-center">
                  {{-- <i class="tio twitter"></i> --}}
                  <img src="{{ asset('img/icons/insta.png') }}" alt="">
                </a>
                <a href="#" class="btn so-link flex justify-center items-center">
                  {{-- <i class="tio facebook_square"></i> --}}
                  <img src="{{ asset('img/icons/fb.svg') }}" alt="">
                </a>
              </div>
              <div class="other--links">
                <a href="#">Legal</a>
                <a href="#">Soporte</a>
                <a href="#">API</a>
                <a href="#">Politica de privacidad</a>
                <a href="#">Politica de Cookies</a>
              </div>
              <div class="opyright">
                <p>
                  © 2024
                  <a href="https://themeforest.net/user/orinostu" target="_blank">Flexy App.</a>
                  Todos los derechos reservados
                </p>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>

    <!-- Back to top with progress indicator-->
    <div class="prgoress_indicator">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
    </div>

    <!-- Tosts -->
    {{-- <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
      <div class="toast toast_demo" id="myTost" role="alert" aria-live="assertive" aria-atomic="true" data-animation="true" data-autohide="false">
        <div class="toast-body">
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <i class="tio clear"></i>
          </button>
          <h5>Hi there 👋</h5>
          <p>We are glad you joined us <a href="#">Join us</a></p>
        </div>
      </div>
    </div> --}}
    <!-- End. Toasts -->

    <!-- Start Section Loader -->
    {{-- <section class="loading_overlay">
          <div class="loader_logo">
            <img class="logo" src="img/logo.svg" />
          </div>
        </section> --}}
    <!-- End. Loader -->
  </div>
  <!-- End. wrapper -->
</body>

</html>
