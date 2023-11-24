@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Posts
                    <a href="{{route('post.create')}}" class="btn btn-sm btn-primary float-right">Create Post</a>
                </div>
                <div class="card-body">
                   <table class="table">
                    <tr>
                        <td>Bil.</td>
                        <td>Tajuk</td>
                        <td>Penulis</td>
                        <td>Bil Komen</td>
                        <td>Tindakan</td>
                    </tr>
                    @foreach ($posts as $post)
                    <tr>
                        <td>
                            {{ $loop->iteration + ( $posts->perPage() * ($posts->currentPage() - 1) ) }}
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                           {{ $post->comments->count() }}
                        </td>
                        <td>
                            <a href="{{ route('post.show',['post'=>$post->id]) }}">Papar</a>

                            @if (Auth::user()->id == $post->user_id)


                            <a href="{{ route('post.edit',['post'=>$post->id]) }}">Kemaskini</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['post.delete',$post->id], 'class'=>'formDelete']) !!}

                                <div class="btn-group pull-right">
                                    {!! Form::button("Delete", ['class' => 'btn btn-sm btn-danger btn-delete']) !!}
                                </div>

                            {!! Form::close() !!}

                            @endif
                        </td>
                    </tr>
                    @endforeach
                   </table>
                   {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>

        $('.btn-delete').on('click', function (e) {
            e.preventDefault();
            var form = $(this).closest('form');

            console.log(form);

            swal("Are you sure you want to delete this post?",{
                dangerMode: true,
                icon:'error',
                buttons: {
                    cancel: {
                        text: "Cancel",
                        value: false,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Ok",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    }
                }
            }).then((value)=>{
                if(value){
                    $(form).submit();
                }
            });
        });
    </script>
@endsection
