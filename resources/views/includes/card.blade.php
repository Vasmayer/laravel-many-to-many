<div class="card w-100">
    <img src="{{$post->image}}" class="card-img-top" alt="{{$post->title}}">
    <div class="card-body">
      <h5 class="card-title">{{$post->title}}</h5>
      <p class="card-text">{{$post->description}}</p>
      <div>{{$post->category->label ?? ''}}</div>
     
    </div>
  </div>