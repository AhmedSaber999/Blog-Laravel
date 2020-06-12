@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div> 
            @endforeach
            @endif
    
            @if(session('response'))
                <div class="alert alert-success">{{session('response')}}</div> 
            @endif
    
            @if(session('danger'))
                <div class="alert alert-danger">{{session('danger')}}</div> 
            @endif

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Post</div>
                <div class="card-body">
                

                    <form method="POST" action="addPost" enctype = "multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                            <div class="col-md-6">
                                <textarea id="body" type="text" class="form-control @error('title') is-invalid @enderror" name="body" required autocomplete="body">
                                </textarea>    
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>    
                        <div class="form-group row" >
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                            <div class="col-md-6">
                                <select  name="category" id="category" class="form-control"  required>
                                    <option selected="selected" disabled>{{__('choose')}}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{__($category->category_name)}}</option>
                                    @endforeach    
                                </select>
                            </div>
                          </div>
                          
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Post Image') }}</label>
                        
                            <div class="custom-file col-md-6">
                                <input type="file" class="custom-file-input" name="image" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose</label>
                                @if($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Share') }}
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
