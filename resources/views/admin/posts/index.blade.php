@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-4 p-5">
                @include('includes.card')
                <div class="d-flex align-items-center justify-content-center">

                    <a href="{{ route('admin.posts.show',$post->id) }}" class="btn btn-primary">Mostra</a>
                    <a href="{{ route('admin.posts.edit',$post->id) }}" class="btn btn-warning ml-2">Modifica</a>
                    <form class="ml-2" action="{{ route('admin.posts.destroy',$post->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
