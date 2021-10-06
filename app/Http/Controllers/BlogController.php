<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Redis;

class BlogController extends Controller
{
    public function index() 
    {
        $cachedBlog = Redis::get('blogs'); //get cache value 
      
        if(isset($cachedBlog)) //Already cache
        {
            $blogs = json_decode($cachedBlog, FALSE);
           
            // dd($blogs);
            // return response()->json([
            //     'status_code' => 201,
            //     'message' => 'Fetched from redis',
            //     'data' => $blog,
            // ]);
            return view('blogs.index',compact('blogs'));
        }
        else 
        {
            $blogs = Blog::all();
            Redis::set('blogs', $blogs);
      
            // return response()->json([
            //     'status_code' => 201,
            //     'message' => 'Fetched from database',
            //     'data' => $blog,
            // ]);
            return view('blogs.index',compact('blogs'));
        }
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        Blog::create($request->all());
        $blogs = Blog::all();
        Redis::set('blogs', $blogs);

        return "Blog Add Successfully"; 
    }

    public function show($id) {

        $cachedBlog = Redis::get('blog_' . $id);
      
        if(isset($cachedBlog)) 
        {
            $blog = json_decode($cachedBlog, FALSE);
            
            echo "Fetched from redis";
            dd($blog);
            // return response()->json([
            //     'status_code' => 201,
            //     'message' => 'Fetched from redis',
            //     'data' => $blog,
            // ]);
        }

        else 
        {
            $blog = Blog::find($id);
            Redis::set('blog_' . $id, $blog);

            echo "Fetched from database";
            dd($blog);
            // return response()->json([
            //     'status_code' => 201,
            //     'message' => 'Fetched from database',
            //     'data' => $blog,
            // ]);
        }
    }

    public function edit($id){

        $cachedBlog = Redis::get('blog_' . $id);
      
        if(isset($cachedBlog)) 
        {
            $blog = json_decode($cachedBlog, FALSE);
      
            return view('blogs.edit',compact('blog'));
        }
        else 
        {
            $blog = Blog::find($id);
            Redis::set('blog_' . $id, $blog);
      
            return view('blogs.edit',compact('blog'));
        }
    }

    public function update(Request $request, $id)
    {
        Blog::findOrFail($id)->update($request->all());
        
        Redis::del('blog_' . $id); // Delete blog_$id from Redis
    
        $blog = Blog::find($id);
        
        Redis::set('blog_' . $id, $blog);  // Set a new key with the blog id

        $blogs = Blog::all();
        Redis::set('blogs', $blogs);
    
        return "Blog Update Successfully";
    }

    public function delete($id)
    {
        Blog::findOrFail($id)->delete();
        Redis::del('blog_' . $id);

        $blogs = Blog::all();
        Redis::set('blogs', $blogs);

        return "Blog Delete Successfully";
    }
}
