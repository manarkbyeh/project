<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>A-Cademie</title>

  <!-- Styles -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css
">

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <link href="{{ asset('css/awesomplete.css') }}" rel="stylesheet">
  <!--looo-->
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <!-- Google fonts - Open Sans-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,300,700,400italic">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <!-- owl carousel-->
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.css')}}">
  <link rel="stylesheet" href="{{ asset('css/owl.theme.css')}}">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="{{asset('css/style.default.css')}}" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="{{asset('css/custom.css')}}">

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/parsley.css') }}" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <link href="{{ asset('css/awesomplete.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('style/css/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('style/css/Simple-Line-Icons-Webfont/simple-line-icons.css')}}" />
  <link rel="stylesheet" href="{{asset('style/css/et-line-font/et-line-font.css')}}">
  <!-- Magnific Popup -->
  <link rel="stylesheet" href="{{asset('style/css/magnific-popup.css')}}">
  <!-- Responsive Devices Styles -->
  <link rel="stylesheet" media="screen" href="{{asset('style/css/responsive-leyouts.css')}}" type="text/css" />
  <!-- Mega Menu -->
  <link rel="stylesheet" href="{{asset('style/js/megamenu/stylesheets/screen.css')}}">
  <!-- Animations -->
  <link href="{{asset('style/js/animations/css/animations.min.css')}}" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" href="{{asset('style/js/form/css/sky-forms.css')}}" type="text/css" media="all">
  <link href="{{ asset('css/katriena.css') }}" rel="stylesheet">
  <!-- Scripts -->


  <!-- Scripts -->
  <!-- Javascript files-->


  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/jquery.cookie.js') }}">
  </script>
  <script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
  <script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
  <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>


  <script src="{{asset('js/parsley.min.js') }}"></script>
  <script src="{{asset('js/awesomplete.min.js') }}"></script>



  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.0/masonry.pkgd.min.js">
  </script>
  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
  <script>
    function formajax(idd, classs, redirect = null) {
      $(document).on('click', '.' + classs, function() {
        var url = $('#' + idd).attr('action');
        $.ajax({
          url: url,
          dataType: 'json',
          type: 'post',
          //data: $('#' + idd).serialize(), FormData(jQuery('form')[0])
          data: new FormData($('#' + idd)[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
          contentType: false, // The content type used when sending data to the server.
          cache: false, // To unable request pages to be cached
          processData: false,
          beforeSend: function() {
            $('.loading').removeClass('hidden');
          },
          success: function(data) {
            $('.loading').addClass('hidden');
            if (data.status == 'error') {
              $.each(data.message, function(key, val) {
                $('#' + key).attr('data-toggle', 'tooltip');
                $('#' + key).attr('title', val);
                $('#' + key).attr('data-placement', 'top');
                $('#' + key).addClass('has-warning');
                $('#' + key).tooltip('show');
              });
            } else {
              $('.success').addClass('alert');
              $('.success').addClass('alert-success');
              $('.success').html(data.message);
              $('#' + idd).find('input:text, input:password, input:file, select, textarea').val('');
              if (redirect != null) {
                window.location.replace(redirect);
              }

            }
          }
        });
        return false;
      });
    }
  </script>


  <!-- fonts -->

  <style type="text/css">
    @font-face {
      font-family: Atall;
      src: url('{{ asset('fonts/a-tall.ttf') }}');
    }
  </style>
  <style type="text/css">
    @font-face {
      font-family: Aregular;
      src: url('{{ asset('fonts/a-regular.ttf') }}');
    }
  </style>
  <style type="text/css">
    @font-face {
      font-family: Asmall;
      src: url('{{ asset('fonts/a-small.ttf') }}');
    }
  </style>
  <style type="text/css">
    @font-face {
      font-family: Asun;
      src: url('{{ asset('fonts/a-sun.ttf') }}');
    }
  </style>
</head>

<body>

  <div id="app">
    <div class="container-fluid">
      <div class="row">
        <nav class="nav_div">
          <div class="container">
            <div class="row">
              <a href="{{ url('/') }}">
                <img src="{{ asset('logo/a_logo.svg') }}" alt="Antwerpen logo" class="logo_img">
              </a>

              <div class="nav_elements">
                <a href="{{ url('/') }}" class="<?php echo ($_SERVER['REQUEST_URI'] == '/' ? 'active_nav' : '');?>">
HOME
</a>

                <a href="{{ url('/news') }}" class="<?php echo ($_SERVER['REQUEST_URI'] == '/news' ? 'active_nav' : '');?>">
NIEUWS
</a>

                <a href="{{ url('/richtingen') }}" class="<?php echo ($_SERVER['REQUEST_URI'] == '/richtingen' ? 'active_nav' : '');?>">
OPLEIDINGEN
</a>

                <a href="{{ url('/game') }}" class="<?php echo ($_SERVER['REQUEST_URI'] == '/game' ? 'active_nav' : '');?>">
GAME
</a>

                <a href="{{ url('/testimonials') }}" class="<?php echo ($_SERVER['REQUEST_URI'] == '/testimonials' ? 'active_nav' : '');?>">
ERVARINGEN
</a>

                <a href="{{ url('/contact') }}" class="<?php echo ($_SERVER['REQUEST_URI'] == '/contact' ? 'active_nav' : '');?>">
CONTACT
</a>
              </div>


              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (!Auth::guest())
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
{{ Auth::user()->name }} <span class="caret"></span>
</a>

                  <ul class="dropdown-menu" role="menu">
                    <li>
                      <a href="{{ route('logout') }}" onclick="event.preventDefault();
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

            </div>
          </div>
        </nav>
        <div class="row">

          @if(Session::has('success'))
          <div class="alert alert-success col-md-8 col-md-offset-2" role="alert">
            <strong>Success:</strong> {{Session::get('success')}}
          </div>
          @endif @if(count($errors)>0)
          <div class="alert alert-danger col-md-8 col-md-offset-2" role="alert">
            <strong>Error:</strong>
            <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }} </li>
              @endforeach
            </ul>
          </div>
          @endif @yield('content')
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>