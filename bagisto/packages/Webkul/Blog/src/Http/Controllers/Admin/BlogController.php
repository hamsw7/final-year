<?php

namespace Webkul\Blog\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
        return view('blog::admin.index');
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
    public function store()
    {
        //
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'status' => 'boolean',
        ]);

        $postData = $validated;
        $postData['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $postData['image'] = $request->file('image')->store('posts', 'public');
        }

        $this->postRepository->create($postData);

        session()->flash('success', trans('blog::app.admin.posts.created'));
        return redirect()->route('admin.blog.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $post = $this->postRepository->find($id);
        return view('blog::admin.edit' ,compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(int $id)
    {
        //
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean',
        ]);

        $postData = $validated;

        if ($request->hasFile('image')) {
            $post = $this->postRepository->find($id);
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $postData['image'] = $request->file('image')->store('posts', 'public');
        }

        $this->postRepository->update($postData, $id);

        return redirect()->route('admin.blog.index')->with('success', trans('blog::app.admin.posts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $post = $this->postRepository->find($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $this->postRepository->delete($id);

        session()->flash('success', trans('blog::app.admin.posts.deleted'));
        return redirect()->route('admin.blog.index');
    }
}
