<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts = Post::All(); 
         return view('admin.posts.index',compact('posts')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:50',
            'image' => 'url|max:255|nullable',
            'description' => 'required|min:5',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ],[
            'required'=>':attribute il campo è obbligatorio',
            'image.url'=>'l \'url dell \'immagine è sbagliato',
            'description.min'=>'Cè una lunghezza minima di caratteri per la descrizione',
            'tags.exists' => 'uno dei tag selezionati non è valido'
        ]);

        $data = $request->all(); 
        $post  = Post::create($data);
        
        if(array_key_exists('tags',$data)) $post->tags()->attach($data['tags']);

        return redirect()->route('admin.posts.show',$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post_tag_ids =  $post->tags->pluck('id')->toArray();

        return view('admin.posts.edit',compact('post','categories','tags','post_tag_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        $request->validate([
            'title' => 'required|min:5|max:50',
            'image' => 'url|max:255|nullable',
            'description' => 'required|min:5',
            'tags' => 'nullable|exists:tags,id'
        ],[
            'required'=>':attribute il campo è obbligatorio',
            'image.url'=>'l \'url dell \'immagine è sbagliato',
            'description.min'=>'Cè una lunghezza minima di caratteri per la descrizione',
            'tags.exists' => 'uno dei tag selezionati non è valido'
        ]);

        $data = $request->all(); 
        $post->update($data);

        if(!array_key_exists('tags',$data))
        {
            $post->tags()->detach();
        }
        else
        {
            $post->tags()->sync($data['tags']);
        }
        
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
