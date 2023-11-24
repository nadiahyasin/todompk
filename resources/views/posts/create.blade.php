@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if (Route::is('post.edit'))
                    Edit Post
                    @else
                    Create New Post
                    @endif
                </div>

                <div class="card-body">
                    @if (Route::is('post.edit'))
                    {!! Form::model($post, ['route' => ['post.update', $post->id], 'method' => 'PUT']) !!}
                    @else
                    {!! Form::open(['method' => 'POST', 'route' => 'posts.store']) !!}
                    @endif

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('title') }}</small>
                    </div>

                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        {!! Form::label('content', 'Content') !!}
                        {!! Form::textarea('content', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('content') }}</small>
                    </div>

                       <div class="btn-group pull-right">
                        @if (Route::is('post.edit'))
                        {!! Form::submit("Update", ['class' => 'btn btn-success']) !!}
                        @else
                        {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
                        {!! Form::submit("Send", ['class' => 'btn btn-success']) !!}
                        @endif
                       </div>

                   {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
