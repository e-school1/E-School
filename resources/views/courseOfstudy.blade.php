@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @auth
              @if(Auth::user()->type == 'teacher')
                <div class="col-12 text-center pb-3">
                  <a class="btn btn-primary" href="/addCourseOfStudy" role="button">Add New Course</a>
                </div>
              @endif
            @endauth
            @if($courses)
            <div class="col-12">
                       <table class="table table-striped table-responsive d-lg-table">
                          <thead>
                            <tr>
                              <th scope="col">Header</th>
                              <th scope="col">Title</th>
                              <th scope="col">Class</th>
                              <th scope="col">Provided By</th>
                              <th scope="col">Description</th>
                              <th scope="col">Options</th>
                            </tr>
                          </thead>
                @foreach($courses as $course)
                          <tbody>
                            <tr>
                              <td>{{$course->header}}</td>
                              <td>{{$course->title}}</td>
                              <td>{{$course->class}}</td>
                              <td>{{$course->user->name}}</td>
                              <td>{{$course->description}}</td>
                              <td>
                                <form id="deleteNews-form" action="/download" method="POST" class="d-table-cell">
                                    <input type="text" name="path" class="d-none" value="{{$course->path}}">
                                    @csrf
                                    <button class="btn btn-success" type="submit" onclick="return confirm()">{{ __('Download') }}</button>
                                </form>
                                @auth
                                    @if(Auth::user()->type == 'teacher')
                                        @if(Auth::user()->id == $course->user->id)
                                            <form id="deleteNews-form" action="/deleteCourseOfStudy/{{$course->id}}" method="POST" class="d-table-cell">
                                                @csrf
                                                <button class="btn btn-danger" type="submit" onclick="return confirm()">{{ __('Delete') }}</button>
                                            </form>
                                        @endif
                                    @endif
                                @endauth
                               </td>
                            </tr>
                          </tbody>
                @endforeach
                </table>
              </div>
            @endif
        </div>
    </div>
</div>
@endsection
