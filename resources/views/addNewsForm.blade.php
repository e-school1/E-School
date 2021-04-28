@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New News</div>

                <div class="card-body">
                    <form method="POST" action="@if(!empty($news)) /addNewNews/{{$news->id}} @else /addNewNews @endif" enctype= multipart/form-data>
                        @csrf

                        <div class="form-group row">
                            <label for="header" class="col-md-4 col-form-label text-md-right">{{ __('Header') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('header') is-invalid @enderror" name="header" value="@if(!empty($news->header)) {{$news->header}} @endif" required autocomplete="header" autofocus>

                                @error('header')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="@if(!empty($news->title)) {{$news->title}} @endif" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                            <div class="col-md-6">
                                <textarea aria-label="With textarea" id="name" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" required autocomplete="content" autofocus>@if(!empty($news->content)) {{$news->content}} @endif</textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="images.*" class="col-md-4 col-form-label text-md-right">{{ __('images') }}</label>

                            <div class="col-md-6">
                                <input id="images.*" type="file" multiple class="form-control-file @error('images.*') is-invalid @enderror" name="images[]" value="{{ old('images.*') }}" autocomplete="images.*" autofocus>

                                @error('images.*')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @if(!empty($news))
                                <p class="col-md-4 mr-3"></p>
                                <div class="alert alert-warning" role="alert">
                                    If you didn`t want to change the images leave it empty!
                                </div>
                            @endif
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @if(!empty($news))
                                        {{ __('Update') }}
                                    @else
                                        {{ __('Add') }}
                                    @endif
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
