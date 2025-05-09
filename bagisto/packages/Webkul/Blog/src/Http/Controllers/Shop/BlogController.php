<?php

namespace Webkul\Blog\Http\Controllers\Shop;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Webkul\Blog\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::where('status', 1)->orderBy('created_at', 'desc')->paginate(10);

        return view('blog::shop.index', compact('posts'));
    }
    public function show(int $id)
    {
        $post = Post::where('id', $id)
                    ->where('status', 1)
                    ->firstOrFail();

        return view('blog::shop.show', compact('post'));
    }
}
