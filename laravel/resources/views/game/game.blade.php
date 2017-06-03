@extends('layouts.app') @section('content')

<div class="container">
    <div class="row">
        <h1 class="page_title">Game</h1>
        
        <div class="content_container left_container game_img_div">
            <img src="{{ asset('images/game/view1.jpg') }}" alt="game screenshot" id="game_img1">
        </div><!--
    --><div class="content_container game_text_div">
            <div class="text_div">
                <h2>A-Notas</h2>
            
                <p>Jij, student van Antwerpen, leefde tot vandaag een gelukkig leven, tot de wind je nota's wegblies! Ren door de stad, en ontwijk obstakels door opzij te gaan, te springen, en te duiken, om je nota's terug te pakken te krijgen!</p>
            </div>
        </div><!--
    --><div class="content_container game_img_div right_container deletable_div">
            <img src="{{ asset('images/game/view2.jpg') }}" alt="game screenshot" id="game_img2">
        </div>
        
    </div>
</div>

@endsection