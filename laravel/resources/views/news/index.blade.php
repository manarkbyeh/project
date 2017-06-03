@extends('layouts.app') @section('content')
<div class="container">
  <h2 class="page_title">Nieuws</h2>
  <div class="row">
    @if(Auth::check() && Auth::user()->roles >1)
    <div class="col-xs-4 col-xs-offset-8">
      <div class="well">
        <script>
          function myFunction() {
            var num = document.getElementById("mySelect").value,
              path = "{{route('news.search',0)}}";
            location.href = path.substr(0, path.length - 1) + num;
          }
        </script>
        <div class="form-group">
          <label for="sel1">Select Option:</label>
          <select class="form-control" id='mySelect' onchange="myFunction()">
            <option value='1' <?php if(@$search==1 ) echo 'selected'; ?>>All</option>
            <option value='2' <?php if(@$search==2 ) echo 'selected'; ?>>Not-Active</option>
            <option value='3' <?php if(@$search==3 ) echo 'selected'; ?>>Active</option>
          </select>
        </div>
      </div>
    </div>
    @endif @if(Auth::check() && Auth::user()->roles ==1)
    <div class="col-xs-4 col-xs-offset-8">
      <div class="well">
        <a href="{{route('news.create')}}" class="btn colorblue btn-block fa fa-plus-circle">&nbsp; Add New News</a>
      </div>
    </div>

    @endif
  </div>
  <div class="row news_div">
    <div id="all">
      <div class="container-fluid">

        <div class="col-xs-12 col-sm-8 col-md-12 content-column">

          <div class="row">
            @foreach($news as $n)
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 masonry-item">

              <div class="box-masonry">
                <a href="@if(array_key_exists('id',$n)) {{route('news.show',$n['id'])}} @else {{$n['url']}} @endif" title="" class="box-masonry-image with-hover-overlay with-hover-icon" @if(!array_key_exists( 'id',$n)) target="_blank" @endif>

                  <img src="@if(preg_match('/^http|^https/i',$n['pic']))
{{$n['pic']}} @else {{url('/images/posts_images/'.$n['pic'])}}@endif" alt="" class="img-responsive">
                </a>
                <div class="box-masonry-text   @if(array_key_exists('id',$n) && $n['active']== 0) orange @endif">
                  <h4><a href="@if(array_key_exists('id',$n)) {{route('news.show',$n['id'])}} @else {{$n['url']}} @endif" target="_blank">{{substr($n['title'],0,25)}} {{strlen($n['title']) > 25 ?"....":""}}</a></h4>
                  <div class="box-masonry-desription">
                    {{ strip_tags(substr($n['text'],0,90)) }} {{ strlen($n['text']) > 90 ?"....":"" }}
                  </div>
                </div>
              </div>
            </div>
            @endforeach


          </div>

        </div>

      </div>
    </div>
  </div>
</div>


@endsection