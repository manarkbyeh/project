@extends('layouts.app') @section('content')
<div class="container">
  <div id="all">
    <div class="container-fluid">

      <div class="success"></div>

      <!--   *** PORTFOLIO ***-->
      <div class="col-xs-12 col-sm-8 col-md-12 content-column">

        <script>
          formajax("addtestimonial", "addtestimonialbtn", '{{url("testimonials")}}');
        </script>
        <hr> {!! Form::open(['route' => 'testimonials.store',"id"=>"addtestimonial", 'files'=>true]) !!} {{ Form::label('name','Title:')}} {{ Form::text('name',old('name'),array('class' =>'form-control '))}} {{ Form::label('url','Url:')}} {{ Form::text('url',old('url'),array('class'
        =>'form-control '))}} {{ Form::label('text','Body post:',["class" => 'form-space'])}} {{ Form::textarea('text',old('text'),array('class' =>'form-control'))}} {{ Form::label('image_cover','image post:',["class" => 'form-space'])}} {{ Form::file('image_cover')}}
        {{ Form::submit('verzenden',array('class' =>'btn btn-success addtestimonialbtn btn-lg bottom_buttom btn-block', 'style'=>'margin-top:20px'))}}
        <center><i class="fa fa-spinner fa-spin fa-2x loading hidden"></i></center>
        {!! Form::close() !!}


      </div>
    </div>
    <!--   *** PORTFOLIO END ***
-->
  </div>

</div>
@endsection