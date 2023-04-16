<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        $posts = Post::latest()->get();
        $posts = Post::orderBy('title', 'asc')->get();
        $posts = Post::latest()->get();
        //dd($posts);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //data validation
        
        //$this->validate($request, [
        //    'title'=> 'required|max:50',
        //]);

        //
        //return $request->title;
        //Post::create($request->all());


        //file upload
        //$file = $request->file('file');
        //echo $file->getClientOriginalName();
        //echo '<br>';
        //echo $file->getSize();
        
        //$input = $request->all();
        //$input['title'] = $request->title;
        //Post::create($request->all());
        //$post = new Post;
        //$post->title = $request->title;
        //$post->save();
        //return redirect('posts');

        $input = $request->all();
        //if we have a file
        if($file = $request->file('file')){
            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $input['path'] = $name;
        }
        Post::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = POST::findOrFail($id);
        $post->update($request->all());
        return redirect('/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = POST::findOrFail($id);
        $post->delete();
        return redirect('/posts');
    }

    public function contact(){
        $people = ['Dan', 'Libby', 'Andy'];
        return view('contact', compact('people'));
    }

    public function show_post($id, $name, $password){
        //return view('post')->with('id', $id);
        return view('post', compact('id', 'name', 'password'));
    }
}
