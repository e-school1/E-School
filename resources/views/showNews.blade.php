@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row col-12 justify-content-center">
            @if($new)
                <div class="col-md-9 py-3">
                  <div class="card">
                    <!-- <img class="card-img-top" src="{{ asset('storage/'.$new->images) }}" alt="Card image cap"> -->
                    <div class="card-body text-center">
                      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                          @foreach(File::Files($new->images) as $key => $var)
                            <div class="carousel-item @if($key == array_key_first(File::Files($new->images))) active @endif">
                              <img class="d-block w-100 rounded" src="/{{ $var }}" style="height: 300px;" alt="First slide">
                            </div>
                          @endforeach
                        </div>
                      </div>
                      <h3 class="card-title pt-2">{{$new->header}}</h3>
                      <h4>{{$new->title}}</h4>
                      <h5>{{$new->content}}</h5>
                      @auth
                        @if(Auth::user()->type == 'manager')
                          <form id="deleteNews-form" action="deleteNews/{{$new->id}}" method="POST" class="d-inline">
                              @csrf
                              <button class="btn btn-danger" type="submit" onclick="return confirm()">{{ __('Delete') }}</button>
                          </form>
                          <a class="btn btn-primary" href="/updateNews/{{$new->id}}">Update</a>
                        @endif
                      @endauth
                    </div>
                  </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
