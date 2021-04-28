@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row col-12 justify-content-center">
            <p class="lead text-center col-12">Latest News</p>
            @auth
              @if(Auth::user()->type == 'manager')
                <div class="col-12 text-center">
                  <a class="btn btn-primary" href="/addNewNews" role="button">Add New News</a>
                </div>
              @endif
            @endauth

            @if($news)
              @foreach($news as $new)
                <div class="col-md-4 py-3">
                  <div class="card">
                    <!-- <img class="card-img-top" src="{{ asset('storage/'.$new->images) }}" alt="Card image cap"> -->
                    <div class="card-body">
                      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                          @if(file_exists($new->images))
                            @foreach(File::Files($new->images) as $key => $var)
                              <div class="carousel-item @if($key == array_key_first(File::Files($new->images))) active @endif">
                                <img class="d-block w-100 rounded" src="{{ $var }}" style="height: 250px;" alt="First slide">
                              </div>
                            @endforeach
                          @endif
                        </div>
                      </div>
                      <h5 class="card-title pt-2">{{$new->header}}</h5>
                      <p>{{$new->title}}</p>
                      <p class="text-truncate" style="height: 23px">{{$new->content}}</p>
                      <a href="showNews/{{$new->id}}" class="btn btn-primary">Go To</a>
                      @auth
                        @if(Auth::user()->type == 'manager')
                          <form id="deleteNews-form" action="deleteNews/{{$new->id}}" method="POST" class="d-inline">
                              @csrf
                              <button class="btn btn-danger" type="submit" onclick="return confirm()">{{ __('Delete') }}</button>
                          </form>
                        @endif
                      @endauth
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
        </div>

        <div class="row col-12 justify-content-center">
            <p class="lead text-center col-12 py-3">The teaching staff</p>
            @auth
              @if(Auth::user()->type == 'manager')
                <div class="col-12 text-center">
                  <a class="btn btn-primary" href="/addNewTeacher" role="button">Add New Teacher</a>
                </div>
              @endif
            @endauth

            @if($teachers)
              @foreach($teachers as $teacher)
                <div class="col-md-3 m-3">
                    <div class="card m-auto" style="width: 18rem;">
                    <img class="card-img-top" alt="100%x180" style="height: 180px; width: 100%; display: block;" src="{{ asset('storage/'.$teacher->avatar) }}" data-holder-rendered="true">
                    <div class="card-body">
                      <h4 class="card-title">{{$teacher->name}}</h4>
                      <h5 class="card-title">{{$teacher->section}}</h5>
                      <p class="card-text m-0"><i class="fas fa-calendar-day"></i> {{$teacher->birthday}}</p>
                      <p class="card-text m-0"><i class="far fa-envelope"></i> {{$teacher->email}}</p>
                      <p class="card-text m-0"><i class="fas fa-mobile-alt"></i> {{$teacher->mobile}}</p>
                      <a class="card-text m-0" target="_blank" href="https://www.facebook.com/{{$teacher->facebook}}"><i class="fab fa-facebook-square"></i> {{$teacher->facebook}}</a>
                      <p class="card-text m-0">{{$teacher->description}}</p>
                      <br>
                      <a class="btn btn-primary" href="/showStudent/{{$teacher->id}}">Show</a>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
