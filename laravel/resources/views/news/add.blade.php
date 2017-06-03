@extends('layouts.app') @section('content')

<div class="container">

  <div id="all">
    <div class="container-fluid">


      <div class="success"></div>
      <!--   *** PORTFOLIO ***-->
      <div class="col-xs-12 col-sm-8 col-md-12 content-column">
        <h2>Add new News </h2>

        <script>
          formajax("addnews", "addnewsbtn", '{{url("news")}}');
        </script>
        <hr> {!! Form::open(['route' => 'news.store',"id"=>"addnews", 'files'=>true]) !!} {{ Form::label('title','Title:')}} {{ Form::text('title',old('title'),array('class' =>'form-control ','requireds'=>'','maxlength'=>'255'))}} {{ Form::label('text','Body
        post:',["class" => 'form-space'])}} {{ Form::textarea('text',old('text'),array('class' =>'form-control','requireds'=>''))}} {{ Form::label('pic','image post:',["class" => 'form-space'])}} {{ Form::file('pic')}} {{ Form::submit('Verzenden',array('class'
        =>'btn btn-success addnewsbtn btn-lg bottom_buttom btn-block', 'style'=>'margin-top:20px'))}}
        <center><i class="fa fa-spinner fa-spin fa-2x loading hidden"></i></center>
        {!! Form::close() !!}



      </div>

    </div>
  </div>

</div>
@endsection