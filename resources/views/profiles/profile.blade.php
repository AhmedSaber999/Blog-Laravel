@extends('layouts.app')
<style type="text/css">
    .avatar{
        border-radius: 100%;
        width: 100px; 
    }
</style>
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
       
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Profile</div>
                
                <div class="card-body">
                    @if($profile)
                        <div class="col-md-4">
                            <img src="{{$profile->profile_pic}}" class="avatar"/>
                            <dt> {{$profile->name}}</dt>    
                            <dt> {{$profile->description}}</dt>    
                        </div>
                    @endif
                    <form method="POST" action="UpdateProfile" enctype = "multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('Name') }}" required  autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required  autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>
                        
                            <div class="custom-file col-md-6">
                                <input type="file" class="custom-file-input" name="profile_pic" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose</label>
                            </div>
                            @if($errors->has('profile_pic'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('profile_pic') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @if($profile)
                                        {{ __('Update Profile') }} 
                                    @else
                                        {{ __('Add Profile') }} 
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
