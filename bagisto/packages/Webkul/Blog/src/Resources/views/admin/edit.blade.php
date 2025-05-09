<x-admin::layouts>
    <x-slot:title>
        Edit Blog Post
    </x-slot>

    <x-admin::form
        :action="route('admin.blog.update', $post->id)"
        enctype="multipart/form-data"
        method="PUT"
    >
        {!! view_render_event('blog::admin.posts.edit.before', ['post' => $post]) !!}

        <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
            <p class="text-xl font-bold text-gray-800 dark:text-white">
                Edit Blog Post
            </p>

            <div class="flex items-center gap-x-2.5">
                <a
                    href="{{ route('admin.blog.index') }}"
                    class="transparent-button hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800"
                >
                    Back
                </a>

                <button
                    type="submit"
                    class="primary-button"
                >
                    Save Changes
                </button>
            </div>
        </div>

        <div class="mt-3.5 flex gap-2.5 max-xl:flex-wrap">
            <!-- Left Content -->
            <div class="flex flex-1 flex-col gap-2 max-xl:flex-auto">
                <!-- Main Content -->
                <div class="box-shadow rounded bg-white p-4 dark:bg-gray-900">
                    <p class="mb-4 text-base font-semibold text-gray-800 dark:text-white">
                        Post Content
                    </p>

                    <!-- Title -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Title
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="title"
                            rules="required"
                            :value="old('title', $post->title)"
                            placeholder="Enter post title..."
                        />

                        <x-admin::form.control-group.error control-name="title" />
                    </x-admin::form.control-group>

                    <!-- Description -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Content
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="description"
                            rules="required"
                            :value="old('description', $post->description)"
                            :tinymce="true"
                            placeholder="Write your post content..."
                        />

                        <x-admin::form.control-group.error control-name="description" />
                    </x-admin::form.control-group>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="flex w-[360px] max-w-full flex-col gap-2">
                <!-- Featured Image -->
                <x-admin::accordion>
                    <x-slot:header>
                        <p class="p-2.5 text-base font-semibold text-gray-800 dark:text-white">
                            Featured Image
                        </p>
                    </x-slot>

                    <x-slot:content>
                        <x-admin::form.control-group class="!mb-0">
                            @if ($post->image)
                                <div class="mb-4">
                                    <img
                                        src="{{ asset('storage/' . $post->image) }}"
                                        alt="Current featured image"
                                        class="rounded-lg border border-gray-200 dark:border-gray-700"
                                        style="max-width: 100%"
                                    >
                                </div>
                            @endif

                            <x-admin::form.control-group.control
                                type="file"
                                name="image"
                                accept="image/jpeg,image/png,image/jpg,image/gif"
                            />

                            <x-admin::form.control-group.error control-name="image" />
                        </x-admin::form.control-group>
                    </x-slot>
                </x-admin::accordion>

                <!-- Publish Settings -->
                <x-admin::accordion>
                    <x-slot:header>
                        <p class="p-2.5 text-base font-semibold text-gray-800 dark:text-white">
                            Publish Settings
                        </p>
                    </x-slot>

                    <x-slot:content>
                        <x-admin::form.control-group class="!mb-0">
                            <div class="flex items-center gap-2.5">
                                <x-admin::form.control-group.control
                                    type="switch"
                                    name="status"
                                    value="1"
                                    :checked="old('status', $post->status)"
                                    label="Publish Status"
                                />

                                <label class="text-sm font-medium text-gray-600 dark:text-gray-300">
                                    {{ $post->status ? 'Published' : 'Draft' }}
                                </label>
                            </div>

                            <x-admin::form.control-group.error control-name="status" />
                        </x-admin::form.control-group>
                    </x-slot>
                </x-admin::accordion>
            </div>
        </div>

        {!! view_render_event('blog::admin.posts.edit.after', ['post' => $post]) !!}

    </x-admin::form>

</x-admin::layouts>
