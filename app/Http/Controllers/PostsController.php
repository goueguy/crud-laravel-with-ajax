<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy("id","desc")->get();
        $view = view("posts.show",compact('posts'))->render();

        return response()->json(['html'=>$view]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title"=>"required|min:3",
            "content"=>"required|string"
        ]);

        if (!$validator->passes()) {
            return response()->json(["status"=>0,"error"=>$validator->errors()->toArray()]);
        }else{
            $data = [
                "title"=>$request->title,
                "content"=>$request->content,
            ];
            Post::create($data);
            return response()->json(["success"=>"Saving....."]);
        }
        
        
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
        
        $post = Post::find($id);

        return response()->json($post);
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
        //dd($id);
        $validator = Validator::make($request->all(), [
            "title"=>"required|min:3",
            "message"=>"required|string"
        ]);
        if(!$validator->passes()){
            return response()->json(["status"=>0,"error"=>$validator->errors()->toArray()]);
        }else{
            Post::where('id', $id)->update(
                [
                    'title' => $request->title,
                    'content'=>$request->message,
                    'status'=>0
                ]
            );
            return response()->json(["success"=>"update"]);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return response()->json(["success"=>"Deleting....."]);
    }
}
