<?php

namespace Webkul\Blog\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Webkul\Blog\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
        {
            $posts = Post::orderBy('created_at', 'desc')->get();
            $posts = Post::where('user_id', auth('admin')->id())->get();
            return view('blog::admin.index', compact('posts'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('blog::admin.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'status' => 'boolean',
        ]);

        $postData = $validated;
        $postData['user_id'] = auth('admin')->id(); // Use the appropriate guard

        if ($request->hasFile('image')) {
            $postData['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($postData);

        session()->flash('success', 'Post created successfully.');
        return redirect()->route('admin.blog.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $post = Post::find($id);
        return view('blog::admin.edit' ,compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        $postData = $validated;

        if ($request->hasFile('image')) {
            $post = Post::find($id);
            if ($post->image) {
                if ($post->image && Storage::disk('public')->exists($post->image)) {
                    Storage::disk('public')->delete($post->image);
                }
                $postData['image'] = $request->file('image')->store('posts', 'public');
            }
            $postData['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::find($id)->update($postData);

        return redirect()->route('admin.blog.index')->with('success', 'posts is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $post = Post::find($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        Post::find($id)->delete();

        session()->flash('success', 'Posts deleted successfully');
        return redirect()->route('admin.blog.index');
    }
}
