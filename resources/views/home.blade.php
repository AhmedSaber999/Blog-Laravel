@extends('layouts.app')
<style type="text/css">
    .avatar{
        /* border-radius: 100%; */
        width: 400px; 
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="modal" id="deleteModel" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Delete post</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="delete-post" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input  name="post_id" id="post_id" value="" hidden/>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
       

            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($posts) > 0)
                        @foreach ($posts as $post)
                            <div class="form-group">
                                <dt>{{$post->post_title}}</dt>
                                <img src="{{$post->post_image}}" class="avatar"/>
                                <p>{{$post->post_body}}</p>
                                <cite>Posted on: {{date('M j, Y H:i'), strtotime($post->update_at)}}</cite>

                                <ul class="nav nav-pills">
                                    <li role="presentation">
                                        <a href="/post-view/{{$post->id}}" class="btn btn-outline-info">View
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="/post-edit/{{$post->id}}" class="btn btn-outline-primary">Edit
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <button onclick="displyModel({{$post->id}})" class="btn btn-outline-danger">Delete</button>
                                    </li>
                                </ul>
                                <hr>
                            </div>
                        @endforeach    
                    @else
                        No posts founded
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    <script>
        function displyModel(id){
            $("#deleteModel").modal('show');
            $("#post_id").val(id);
            console.log($("#post_id").val());
        }
    </script>
