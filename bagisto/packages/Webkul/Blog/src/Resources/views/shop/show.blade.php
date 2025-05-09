<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Blog Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Optional Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $post->title }}</h1>

        <p class="text-gray-600 text-sm mb-8">
            <i class="far fa-calendar mr-2"></i>
            Published on {{ $post->created_at->format('F j, Y') }}
        </p>

        <div class="mb-8">
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}"
                     alt="{{ $post->title }}"
                     class="w-full h-auto rounded-lg shadow-md">
            @else
                <div class="w-full bg-gray-100 rounded-lg flex items-center justify-center h-48 text-gray-500">
                    <i class="fas fa-image text-2xl mr-2"></i>
                    No Image Available
                </div>
            @endif
        </div>

        <div class="prose max-w-none mb-8">
            <p class="text-gray-700 leading-relaxed">
                {{ $post->description }}
            </p>
        </div>

        <a href="{{ route('shop.blog.index') }}"
           class="inline-flex items-center px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Blog
        </a>
    </div>
</body>
</html>
