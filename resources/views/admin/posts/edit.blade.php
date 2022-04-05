@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('admin.posts.update',$post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="title">Titolo</label>
          <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
        </div>
        <div class="form-group">
          <label for="image">Immagine</label>
          <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="description">Descrizione</label>
          <textarea class="form-control" id="description" name="description" rows="5">{{$post->description}}</textarea>
        </div>
        <select class="form-control" id="category" name="category_id">
          <option value="">Nessuna Categoria</option>
          @foreach ($categories as $category)
            <option value="{{$category->id}}"
             @if ($category->id == $post->category->id)
                selected
             @endif>
            {{$category->label}}</option>
          @endforeach
        </select>
        <div class="mt-3">
          @foreach ($tags as $tag)  
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="tags[]" id="tag-{{ $tag->id }}" value="{{$tag->id}}" @if(in_array($tag->id,$post_tag_ids)) checked @endif>
              <label class="form-check-label" for="tag-{{ $tag->id }}">{{$tag->label}}</label>
            </div>
          @endforeach
        </div>
        <div class="text-right mt-3">
            <button type="submit" class="btn btn-success">Modifica</button>
        </div>
      </form>
</div>
@endsection