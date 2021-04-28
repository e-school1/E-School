@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       @if($student)
         <div class="card text-center col-11 col-md-8 p-0">
            <div class="card-header">
              {{$student->name}}
            </div>
            <img class="p-2 card-img-top m-auto rounded-circle" alt="100%x180" style="height: 230px; width: 230px; display: block;" src="{{ asset('storage/'.$student->avatar) }}" data-holder-rendered="true">
            <div class="card-body">
                <h4 class="card-title">{{$student->name}}</h4>
                <h5 class="card-title">{{$student->section}}</h5>
                <p class="card-text m-0"><i class="fas fa-calendar-day"></i> {{$student->birthday}}</p>
                <p class="card-text m-0"><i class="fas fa-venus-mars"></i> {{$student->gender}}</p>
                <p class="card-text m-0"><i class="far fa-envelope"></i> {{$student->email}}</p>
                <p class="card-text m-0"><i class="fas fa-mobile-alt"></i> {{$student->mobile}}</p>
                <a class="card-text m-0" target="_blank" href="https://www.facebook.com/{{$student->facebook}}"><i class="fab fa-facebook-square"></i> {{$student->facebook}}</a>
                <p class="card-text m-0">{{$student->description}}</p>
                <br>
                @if($student->type == 'student')
                  <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                      <p class="lead col-8 d-inline">First semester</p>
                      @auth
                        @if(Auth::user()->type == 'manager')
                          <div class="dropdown col-3 float-right">
                            <button class="btn  dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                              @if($student->student && $student->student->firstsemester)
                                <a class="dropdown-item" href="/giveFirstSemester/{{$student->id}}">Edit</a>
                                <form id="deleteTeacher-form" action="/deleteFirstSemester/{{$student->id}}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="dropdown-item" type="submit" onclick="return confirm()">{{ __('Delete') }}</button>
                                </form>
                              @else
                                <a class="dropdown-item" href="/giveFirstSemester/{{$student->id}}">Give Resault</a>
                              @endif
                            </div>
                          </div>
                        @endif
                      @endauth
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Subject</th>
                            <th scope="col">Degree</th>
                          </tr>
                        </thead>
                        @if($student->student && $student->student->firstsemester)
                          <tbody>
                            @foreach(json_decode($student->student->firstsemester) as $var)
                              @if($var->name)
                                <tr>
                                  <td>
                                    {{$var->name}}
                                  </td>
                                  <td>
                                    {{$var->degree}}
                                  </td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        @endif
                      </table>
                      @if($student && $student->student && $student->student->firstsemesterresault)
                        <p class="lead">
                          {{$student->student->firstsemesterresault}}
                        </p>
                      @endif
                      @if($student && $student->student && $student->student->firstsemesternote)
                        <p class="lead small">
                          {{$student->student->firstsemesternote}}
                        </p>
                      @endif
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="lead col-8 d-inline">Second semester</p>
                      @auth
                        @if(Auth::user()->type == 'manager')
                          <div class="dropdown col-3 float-right">
                            <button class="btn  dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                              @if($student->student && $student->student->secondsemester)
                                <a class="dropdown-item" href="/giveSecondSemester/{{$student->id}}">Edit</a>
                                <form id="deleteTeacher-form" action="/deleteSecondSemester/{{$student->id}}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="dropdown-item" type="submit" onclick="return confirm()">{{ __('Delete') }}</button>
                                </form>
                              @else
                                <a class="dropdown-item" href="/giveSecondSemester/{{$student->id}}">Give Resault</a>
                              @endif
                            </div>
                          </div>
                        @endif
                      @endauth
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Subject</th>
                            <th scope="col">Degree</th>
                          </tr>
                        </thead>
                        @if($student->student && $student->student->secondsemester)
                          <tbody>
                            @foreach(json_decode($student->student->secondsemester) as $var)
                              @if($var->name)
                                <tr>
                                  <td>
                                    {{$var->name}}
                                  </td>
                                  <td>
                                    {{$var->degree}}
                                  </td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                        @endif
                      </table>
                      @if($student && $student->student && $student->student->secondsemesterresault)
                        <p class="lead">
                          {{$student->student->secondsemesterresault}}
                        </p>
                      @endif
                      @if($student && $student->student && $student->student->secondsemesternote)
                        <p class="lead small">
                          {{$student->student->secondsemesternote}}
                        </p>
                      @endif
                    </div>
                  </div>
                @endif
                @auth
                  @if(Auth::user()->type == 'manager')
                    <form id="deleteTeacher-form" action="/deleteStudent/{{$student->id}}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger" type="submit" onclick="return confirm()">{{ __('Delete') }}</button>
                    </form>

                    <a class="btn btn-primary" href="/profile/{{$student->id}}">Edit</a>
                  @endif
                @endauth
              </div>
          </div>
        @endif
    </div>
</div>
@endsection