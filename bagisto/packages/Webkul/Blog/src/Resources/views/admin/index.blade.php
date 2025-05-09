<x-admin::layouts>
    <x-slot:title>
        Blog Posts
    </x-slot>

    <div class="content">
        <div class="page-content">
            {!! view_render_event('blog::admin.posts.list.before') !!}

            <!-- Page Header -->
            <div class="flex items-center justify-between gap-4 mb-4">
                <p class="text-xl font-bold text-gray-800">
                    Blog Posts
                </p>

                <a
                    href="{{ route('admin.blog.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon-plus text-xl"></i>
                    Create Post
                </a>
            </div>

            <!-- Table Container -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">ID</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Title</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Content</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Status</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Image</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse ($posts as $post)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-600">#{{ $post->id }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $post->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600 max-w-[300px] truncate">
                                    {{ Str::limit(strip_tags($post->description), 50) }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $post->status ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $post->status ? 'Published' : 'Draft' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($post->image)
                                        <img
                                            src="{{ asset('storage/' . $post->image) }}"
                                            alt="{{ $post->title }}"
                                            class="w-16 h-16 object-cover rounded"
                                        >
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex items-center gap-3">
                                        <a
                                            href="{{ route('admin.blog.edit', $post->id) }}"
                                            class="text-blue-600 hover:text-blue-800"
                                            title="Edit"
                                        >
                                            <i class="icon-edit text-xl"></i>
                                        </a>

                                        <form
                                            action="{{ route('admin.blog.destroy', $post->id) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="text-red-600 hover:text-red-800"
                                                onclick="return confirm('Are you sure?')"
                                                title="Delete"
                                            >
                                                <i class="icon-trash text-xl"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                    No blog posts found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {!! view_render_event('blog::admin.posts.list.after') !!}
        </div>
    </div>
</x-admin::layouts>
