@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Teacher</div>

                <div class="card-body">
                    <form method="POST" action="/profile/{{$user->id}}" enctype= multipart/form-data>
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @auth
                            @if($user->type == "student")
                                <div class="form-group row">
                                    <label for="section" class="col-md-4 col-form-label text-md-right">{{ __('Section') }}</label>

                                    <div class="col-md-6">
                                        <select class="custom-select my-1 mr-sm-2 form-control @error('section') is-invalid @enderror" id="name" name="section" value="{{ old('section') }}" autocomplete="section" autofocus>
                                            <option value="">Open this select menu</option>
                                            <option @if($user->section == 'First Grade')selected @endif value="First Grade">First Grade</option>
                                            <option @if($user->section == 'Second Grade')selected @endif value="Second Grade">Second Grade</option>
                                            <option @if($user->section == 'Third Grade')selected @endif value="Third Grade">Third Grade</option>
                                            <option @if($user->section == 'Fourth Grade')selected @endif value="Fourth Grade">Fourth Grade</option>
                                            <option @if($user->section == 'Fifth Grade')selected @endif value="Fifth Grade">Fifth Grade</option>
                                            <option @if($user->section == 'Sixth Grade')selected @endif value="Sixth Grade">Sixth Grade</option>
                                        </select>

                                        @error('section')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @elseif($user->type == "teacher")
                            <div class="form-group row">
                                <label for="section" class="col-md-4 col-form-label text-md-right">{{ __('Section') }}</label>

                                <div class="col-md-6">
                                    <input id="section" type="text" class="form-control @error('section') is-invalid @enderror" name="section" value="{{$user->section}}" autocomplete="section" autofocus>

                                    @error('section')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @endif
                        @endauth

                        <div class="form-group row">
                            <label for="Avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control-file @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" autocomplete="avatar" autofocus>

                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <p class="col-md-4 mr-3"></p>
                            <div class="alert alert-warning" role="alert">
                                If you didn`t want to change the avatar leave it empty!
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Avatar" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <div class="form-check form-check-inline pt-2">
                                  <input @if($user->gender == 'male') checked @endif class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male">
                                  <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input @if($user->gender == 'female') checked @endif class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female">
                                  <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>

                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Avatar" class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>

                          <div class="col-md-6">
                            <input class="form-control" type="date" id="example-date-input" name="birthday" value="{{$user->birthday}}">
                          </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="facebook" class="col-md-4 col-form-label text-md-right">{{ __('Facebook Username') }}</label>

                            <div class="col-md-6">
                                <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{$user->facebook}}" autocomplete="facebook">

                                @error('facebook')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Phone') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="mobile" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{$user->mobile}}" required autocomplete="mobile">

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                            <p class="col-md-4 mr-3"></p>
                            <div class="alert alert-warning" role="alert">
                              If you didn`t want to change the password leave it empty!
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea autocomplete="description" class="form-control @error('description') is-invalid @enderror" id="description"name="description">{{$user->description}}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
