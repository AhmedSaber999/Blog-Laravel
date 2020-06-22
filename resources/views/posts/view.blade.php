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
                <div class="card-header">Post View</div>
                <div class="card-body">
                
                    <dt>{{$post->post_title}}</dt>
                    <img src="{{$post->post_image}}" class="avatar"/>
                    <p>{{$post->post_body}}</p>
                    <cite>Posted on: {{date('M j, Y H:i'), strtotime($post->update_at)}}</cite>

                    <ul class="nav nav-pills">
                        <li role="presentation">
                            <a href="/post-like/{{$post->id}}">
                                <span class="fa fa-eye">Like</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="/post-dislike/{{$post->id}}">
                                <span class="fa fa-pencil-square-o">Dislike</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="/post-comment/{{$post->id}}">
                                <span class="fa fa-trash">Comment</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
