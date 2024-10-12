<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $details = Detail::where('state',1)->get();
        $posts = Post::with('detail')->get();

        //lấy danh sách theo id trả về form
        $post_id = null;
        if($request->has('post_id')){
            $post_id = Post::findOrFail($request->post_id);
        }

        //lấy danh sách theo tên trả về table
        $namePosts = null;
        if($request->has('namePost')){
            $namePosts = Post::where('name','LIKE','%'.$request->namePost.'%')->with('detail')->get();
        }
        return view('admin.post.index',compact('posts','details','post_id','namePosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'content'=>'required',
            'author'=>'required',
            'content'=>'required',
            'detail_id'=>'required',
            'image'=>'required'
        ]);
        $post = Post::create($data);
        return redirect(route('admin.post.index'))->with('success','create post success');
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
        $data = $request->validate([
            'name'=>'required',
            'content'=>'required',
            'content'=>'required',
            'author'=>'required',
            'detail_id'=>'required',
            'image'=>'required'
        ]);
        $post = Post::findOrFail($id);
        $post->update($data);
        return redirect(route('admin.post.index'))->with('success','post update thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect(route('admin.post.index'))->with('success','del post thành công!');
    }
}
