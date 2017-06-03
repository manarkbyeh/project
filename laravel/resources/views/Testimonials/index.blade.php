@extends('layouts.app') @section('content')
<div class="container">
  <h2 class="page_title erv_title">Ervaringen</h2>
  
  @foreach($testimonials as $testimonial)

          <div class="clearfix"></div>

                  <div class="cource-box">
                    <div class="row cource-text">
                      <div class="col-lg-4 col-md-4 image_box img_erv"> <a href="{{$testimonial->url}}" target="_blank"><img src="{{url('/images/posts_images/'.$testimonial->image_cover)}}" alt="" class="img-responsive"></a> </div>

                      <div class="col-lg-8 col-md-8">
                        <h4><a href="{{$testimonial->url}}" target="_blank">{{$testimonial->name}}</a></h4>
                        <p>
                          {{$testimonial->text}}</p>

                        <a href="{{$testimonial->url}}" class="btn btn-small" target="_blank">Read More</a>
                      </div>
                    </div>
                  </div>

  @endforeach

</div>
@endsection