@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$semester}} semester resault for Ali Salah</div>

                <div class="card-body">
                    <form method="POST" action="/give{{$semester}}Semester/{{$student->id}}">
                        @csrf

                        <div class="form-group row" id="subject">
                            <label for="name1" class="col-md-3 col-form-label text-md-right">{{ __('Subject 1') }}</label>
                            <div class="col-md-3">
                                <input id="name1" type="text" class="form-control @error('name1') is-invalid @enderror" name="name1" value='' autocomplete="name1" autofocus placeholder="Name">

                                @error('name1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <input id="degree1" type="text" class="form-control @error('degree1') is-invalid @enderror" name="degree1" value='' autocomplete="degree1" autofocus placeholder="Degree">

                                @error('degree1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <p class="pt-2">/</p>
                            <div class="col-md-2">
                                <input id="of1" type="text" class="form-control @error('of1') is-invalid @enderror" name="of1" value='' autocomplete="of1" autofocus placeholder="Of">

                                @error('of1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-6 offset-md-4">
                                <a onclick="newSubject()" class="btn btn-primary">
                                    {{ __('New Subject') }}
                                </a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="finalresault" class="col-md-4 col-form-label text-md-right">{{ __('Final resault') }}</label>

                            <div class="col-md-6">
                                <input id="finalresault" type="text" class="form-control @error('finalresault') is-invalid @enderror" name="finalresault" value="{{ old('finalresault') }}" required autocomplete="finalresault" autofocus>

                                @error('finalresault')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('Note') }}</label>

                            <div class="col-md-6">
                                <textarea autocomplete="note" class="form-control @error('note') is-invalid @enderror" id="note"name="note"></textarea>

                                @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Give Resault') }}
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
