@extends('layouts.app') @section('content')

<div class="container">
  <div class="row">



    <div class="col-md-8">
      <div class="row">
        <div class="clearfix"></div>
        <div class="section-lg m-bottom10">
          <div class="container">
            <div class="row">

              <div class="col-lg-12 col-md-12">
                <div class="cource-box">
                  <div class="row cource-text">
                    <div class="col-lg-4 col-md-4 image_box">
                      <a href="#"><img src="{{url('/images/posts_images/'.$news['pic'])}}" alt="" class="img-responsive"></a>
                    </div>
                    <div class="col-lg-8 col-md-8">

                      <span>


<i class="fa fa-calendar-o" aria-hidden="true"></i> {{ date("d M Y", strtotime( $news->created_at ))}}
<i class="fa fa-clock-o" aria-hidden="true"></i> {{ date("g:iA", strtotime( $news->created_at ))}}

</span>

                      <h4><a href="{{ $news->url}}">{{$news->title}}</a></h4>
                      <p>
                        {{$news->text}}</p>




                    </div>
                    <div class="pull-right">
                      @if(Auth::check() && Auth::user()->roles > 0 && Auth::user()->roles == 1)
                      <a href="{{route('news.edit',$news->id)}}" class="btn btn-primary btn-sm">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                      </a>

                      <a href="{{route('news.delete',$news->id)}}" class="btn colorred  btn-sm">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                      </a>
                      @endif @if(Auth::check() && Auth::user()->roles ==2 and $news->active == 0)
                      <span class="btn btn-primary btn-sm jsActive" data-id="{{$news->id}}">
Active
</span> @endif @if(Auth::check() && Auth::user()->roles == 1 and $news->active == 0)
                      <span class="btn btn-default btn-sm">pending</span> @endif
                    </div>

                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
        <script>
          $(document).ready(function() {
            var root = "{{ url('news/')}}" + "/";
            $('span.jsActive').click(function() {
              var id = this.dataset.id,
                self = this;

              $.ajax({
                url: root + id + '/active',
                method: "get"
              }).done(function(msg) {
                if (msg == 'true') {
                  self.parentElement.removeChild(self);
                } else {
                  alert("Try again");
                }
              }).fail(function(jqXHR, textStatus) {
                alert("Try again");
              });

            });

          });
        </script>

        @endsection