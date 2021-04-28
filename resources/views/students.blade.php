@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="row col-12 pb-2 justify-content-center">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link" href="/studentsByClass/First Grade">First grade</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/studentsByClass/Second Grade">Second grade</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/studentsByClass/Third Grade">Third grade</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">More</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/studentsByClass/Fourth Grade">Fourth grade</a>
              <a class="dropdown-item" href="/studentsByClass/Fifth Grade">Fifth grade</a>
              <a class="dropdown-item" href="/studentsByClass/Sixth Grade">Sixth grade</a>
            </div>
          </li>
        </ul>
      </div>
      <div class="row col-9 col-md-8">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search by E-Mail" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
            </div>
          </div>
        </div>
      @if(empty($students->toArray()))
        <div class="row col-12 text-center">
          <i class="fas fa-search m-auto" style="opacity: 0.2; font-size: 30vw"></i>
          <br>
          <div class="col-12">
            <p class="lead" style="opacity: 0.2; font-size: 3vw">No thing found.</p>
          </div>
        </div>
      @endif

        @if($students)
        <div class="col-12 row justify-content-center">
          @foreach($students as $student)
            <div class="col-md-3 m-3">
                <div class="card m-auto" style="width: 18rem;">
                <img class="card-img-top" alt="100%x180" style="height: 180px; width: 100%; display: block;" src="{{ asset('storage/'.$student->avatar) }}" data-holder-rendered="true">
                <div class="card-body">
                  <h4 class="card-title">{{$student->name}}</h4>
                  <h5 class="card-title">{{$student->section}}</h5>
                  <p class="card-text m-0"><i class="fas fa-calendar-day"></i> {{$student->birthday}}</p>
                  <p class="card-text m-0"><i class="far fa-envelope"></i> {{$student->email}}</p>
                  <p class="card-text m-0"><i class="fas fa-mobile-alt"></i> {{$student->mobile}}</p>
                  <a class="card-text m-0" target="_blank" href="https://www.facebook.com/{{$student->facebook}}"><i class="fab fa-facebook-square"></i> {{$student->facebook}}</a>
                  <p class="card-text m-0">{{$student->description}}</p>
                  <br>
                  <a class="btn btn-primary" href="/showStudent/{{$student->id}}">Show</a>
                </div>
              </div>
            </div>
          @endforeach
          </div>
        @endif
    </div>
</div>
@endsection
