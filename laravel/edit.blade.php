@extends('layouts.app')


@section('content')
<div class="container">
 <div class="row">
{!! Form::model($news,['route'=>['news.update',$news->id],'method' => 'PATCH']) !!}

  <div class="col-md-8">
  {{ Form::label('title','Title:')}}
{{ Form::text('title',null,["class" => 'form-control input-lg'])}}
 
 {{ Form::label('text','More explation:',["class" => 'form-space'])}}
{{ Form::textarea('text',null,["class" => 'form-control'])}}

  </div>
  <div class="col-md-4 top-marge">
   <div class="well">
   <dl class="dl-horizontal">
  <dt>create at:</dt>
  <dd>{{date('M j, Y h:ia',strtotime($news->updated_at))}}</dd>
</dl>
   <dl class="dl-horizontal">
  <dt>latst update:</dt>
  <dd>{{date('M j, Y h:ia',strtotime($news->created_at))}}</dd>
</dl>
<hr>
 <div class="row">
 <div class="col-md-6">
 

 {{ Form::submit('update',["class" => 'btn btn-success btn-block btn-sm'])}}
 </div>
   <div class="col-md-6">
  
    {!! Html::linkRoute('news.show','cancel',array($news->id),array('class'=>'btn btn-danger btn-block btn-sm')) !!}
   
   </div>
    </div>
   </div>
   </div>
    </div>
    {!! Form::close() !!}
    </div>
@endsection
