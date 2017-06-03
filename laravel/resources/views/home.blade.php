@extends('layouts.app') @section('content')
<div class="container">
  <div class="row">

    <!-- video -->
    <div class="video_container">
      <video autoplay loop muted>
        <source src="{{ asset('videos/antwerpen.mp4') }}" type="video/mp4">
      </video>
      <div class="video_overlay"></div>
    </div>


    <!-- title -->
    <div class="title_container">
      <div class="title_div">
        <h1>A-Cademie</h1>
        <h2>STUDEREN IN ANTWERPEN</h2>
      </div>
    </div>
    
    <!-- artikels -->
    <div class="content_container left_container">
      <a href="{{ url('/testimonials') }}">
        <div class="img_div">
          <img src="{{ asset('images/home/01.jpg') }}" alt="studenten in Antwerpen">
        </div>
        <div class="text_div">
          <h3>ERVARINGEN</h3>
          <p>Leer de Antwerpenaren kennen: wie ze zijn en wat ze doen.</p>
        </div>
      </a>
    </div><!--
--><div class="content_container">
      <a href="{{ url('/richtingen') }}">
        <div class="img_div">
          <img src="{{ asset('images/home/02.jpg') }}" alt="UKarel De Grote">
        </div>
        <div class="text_div">
          <h3>STUDIES</h3>
          <p>Scholen, opleidingen, en alle andere info over jouw studies..</p>
        </div>
      </a>
    </div><!-- **************** GAME ****************
--><div class="game_container">
        <a href="{{ url('/game') }}">
          <div class="img_div">
            <img src="{{ asset('images/game/bg.jpg') }}" alt="game background">
          </div>
          <div class="text_div">
            <h3>GAME</h3>
            <p>A-Notas is het spel voor op je mobieltje waarmee je Antwerpen doorrent om je notas terug te vinden!</p>
          </div>
        </a>
    </div><!-- **************************************
--><div class="content_container left_container">
      <a href="{{ url('/news') }}">
        <div class="img_div">
          <img src="{{ asset('images/home/03.jpg') }}" alt="drie studenten">
        </div>
        <div class="text_div">
          <h3>NIEUWS</h3>
          <p>Alles wat er gebeurt in het studentenleven van Antwerpen.</p>
        </div>
      </a>
    </div><!--
--><div class="content_container">
      <a href="{{ url('/contact') }}">
        <div class="img_div">
          <img src="{{ asset('images/home/04.jpg') }}" alt="studenten in Antwerpen">
        </div>
        <div class="text_div">
          <h3>CONTACT</h3>
          <p>Vragen? Commentaar? Suggesties? Laat het ons weten!</p>
        </div>
      </a>
    </div>

  </div>
</div>
@endsection