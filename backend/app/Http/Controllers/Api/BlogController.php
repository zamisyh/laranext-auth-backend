<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\Api\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class BlogController extends Controller
{
    public function index()
    {
        $data = Blog::all();
        return response()->json($data);
    }

    public function createBlog(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $data = Blog::create([
            'idUsers' => Auth::user()->id,
            'title' => Str::slug($request->title),
            'description' => $request->description,
        ]);

        return response()->json($data);
    }


}
