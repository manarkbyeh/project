@extends('layouts.app') @section('content')
<div class="container">
  <div class="success"></div>
  <div class="row">
    <script>
      formajax("editnews", "editnewsbtn", '{{url("news")}}');
    </script>
    {!! Form::model($news,['route'=>['news.update',$news->id],'method' => 'PATCH',"id"=>"editnews",'files'=>true]) !!}

    <div class="col-md-8">
      {{ Form::label('title','TITLE:')}} {{ Form::text('title',null,["class" => 'form-control input-lg'])}} {{ Form::label('text','BODY POST:',["class" => 'form-space'])}} {{ Form::textarea('text',$value=null,array('class' =>'form-control','required'=>''))}}
      {{ Form::label('pic','image post:',["class" => 'form-space'])}} {{ Form::file('pic')}}

    </div>
    <div class="col-md-4">
      <div class="well">
        <div class="row">
          <div class="col-md-4">


            create at:
          </div>
          <div class="col-md-8">

            {{date('M j, Y h:ia',strtotime($news->updated_at))}}

          </div>
        </div>

        <div class="row">
          <div class="col-md-4">

            update:
          </div>
          <div class="col-md-8">

            {{date('M j, Y h:ia',strtotime($news->created_at))}}

          </div>
        </div>

        <hr>
        <div class="row">
          <div class="col-md-6">
            {{ Form::submit('Verzenden',array('class' =>'btn btn-success btn-block btn-sm editnewsbtn '))}}


          </div>
          <div class="col-md-6">

            {!! Html::linkRoute('news.index','cancel',array($news->id),array('class'=>'btn colorred btn-block btn-sm')) !!}

          </div>
          <center><i class="fa fa-spinner fa-spin fa-2x loading hidden"></i></center>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection