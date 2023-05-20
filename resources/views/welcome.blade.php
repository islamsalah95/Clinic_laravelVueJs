<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>Novena- Health Care &amp; Medical template</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Health Care Medical Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Novena HTML Template v1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- theme meta -->
  <meta name="theme-name" content="novena" />

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.png" />

  <!--
  Essential stylesheets
  =====================================-->
  <link rel="stylesheet" href="http://127.0.0.1:8000/theme/plugins/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="http://127.0.0.1:8000/theme/plugins/icofont/icofont.min.css">
  <link rel="stylesheet" href="http://127.0.0.1:8000/theme/plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="http://127.0.0.1:8000/theme/plugins/slick-carousel/slick/slick-theme.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="http://127.0.0.1:8000/theme/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<body id="top">
        
    
         <div id="app">
            <header-component></header-component>
            <router-view></router-view>

            {{--  <home-component></home-component>  --}}
            <footer-component></footer-component>
        </div>


            <script src="http://127.0.0.1:8000/theme/plugins/jquery/jquery.js"></script>
            <script src="http://127.0.0.1:8000/theme/plugins/bootstrap/bootstrap.min.js"></script>
            <script src="http://127.0.0.1:8000/theme/plugins/slick-carousel/slick/slick.min.js"></script>
            <script src="http://127.0.0.1:8000/theme/plugins/shuffle/shuffle.min.js"></script>
            <script src="http://127.0.0.1:8000/theme/https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA"></script>
            <script src="http://127.0.0.1:8000/theme/plugins/google-map/gmap.js"></script>
            <script src="http://127.0.0.1:8000/theme/js/script.js"></script>

        @vite('resources/js/app.js')
    </body>
</html>




