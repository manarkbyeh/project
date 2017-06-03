@extends('layouts.app') @section('content')
<div class="container">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="well">
        <dl class="dl-horizontal">
          <h1>{{$news->title}}</h1>

        </dl>
        <dl class="dl-horizontal">

          <p> {{$news->text}}</p>
        </dl>
        <hr>
        <div class="row">
          <div class="success"></div>
          <script>
            formajax("deletenews", "deletenewsbtn", '{{url("news")}}');
          </script>

          {{ Form::open(['route'=>['news.destroy',$news->id],"id"=>"deletenews",'method'=>'Delete'])}}

          <div class="row">
            <div class="col-md-6">


              {{Form::submit('yes delete this Article',["class" => 'btn colorred btn-block btn-sm'])}}
            </div>
            <div class="col-md-6">

              {!! Html::linkRoute('news.index','cancel',array($news->id),array('class'=>'btn colorblue btn-block btn-sm deletenewsbtn')) !!}

            </div>
          </div>
          {{Form::close()}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection