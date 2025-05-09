<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
<div class="py-12">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-12">
            <h1 class="text-5xl font-bold text-blue-600">Latest Posts</h1>
        </div>

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($posts as $post)
                <article class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 h-full overflow-hidden">
                    <div class="relative overflow-hidden">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}"
                                 alt="{{ $post->title }}"
                                 class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="h-64 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                                <i class="fas fa-image text-6xl text-gray-300"></i>
                            </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500">
                                <i class="far fa-calendar mr-2"></i>
                                {{ $post->created_at->format('M d, Y') }}
                            </span>
                            <span class="px-3 py-1 bg-blue-600 text-white rounded-full text-sm">Category</span>
                        </div>

                        <h3 class="text-xl font-bold mb-4">{{ $post->title }}</h3>

                        <p class="text-gray-600 mb-6 line-clamp-3">
                            {{ Str::limit(strip_tags($post->content), 120) }}
                        </p>

                        <div class="flex justify-between items-center">
                            <a href="{{ route('shop.blog.show', $post->id) }}"
                               class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                Read More
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                            <div class="flex space-x-4">
                                <span class="text-gray-500 text-sm">
                                    <i class="far fa-comment mr-1"></i> 15
                                </span>
                                <span class="text-gray-500 text-sm">
                                    <i class="far fa-heart mr-1"></i> 42
                                </span>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $posts->onEachSide(1)->links('pagination::tailwind') }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // AJAX Pagination
        document.querySelector('.pagination').addEventListener('click', function(e) {
            e.preventDefault();
            if (e.target.tagName === 'A') {
                const url = e.target.getAttribute('href');
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        document.querySelector('.grid').innerHTML = doc.querySelector('.grid').innerHTML;
                        document.querySelector('.pagination').innerHTML = doc.querySelector('.pagination').innerHTML;
                    });
            }
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        let searchTimeout;

        searchInput.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                // Implement search API call here
                console.log('Searching for:', e.target.value);
            }, 500);
        });
    });
</script>
</body>
</html>
