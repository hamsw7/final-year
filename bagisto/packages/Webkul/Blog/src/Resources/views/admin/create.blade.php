<x-admin::layouts>

    <!-- Title of the page -->
    <x-slot:title>
        Create Blog Post
    </x-slot>
<div class="content">


        <div class="page-content">
        <x-admin::form :action="route('admin.blog.store')" enctype="multipart/form-data">

{!! view_render_event('blog::admin.posts.create.before') !!}

<!-- Page Header -->
<div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
    <p class="text-xl font-bold text-gray-800 dark:text-white">
        Create Blog Post
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
            Save Post
        </button>
    </div>
</div>

<!-- Container -->
<div class="mt-3.5 flex gap-2.5 max-xl:flex-wrap">
    <!-- Left Container: Description -->
    <div class="box-shadow flex flex-1 flex-col gap-2 rounded bg-white dark:bg-gray-900 max-xl:flex-auto">
        <x-admin::form.control-group>
            <x-admin::form.control-group.label class="required !text-gray-800 dark:!text-white">
                Description
            </x-admin::form.control-group.label>

            <x-admin::form.control-group.control
                type="textarea"
                name="description"
                rules="required"
                :value="old('description')"
                placeholder="Enter description..."
            />

            <x-admin::form.control-group.error control-name="description" />
        </x-admin::form.control-group>
    </div>

    <!-- Right Container: General Settings -->
    <div class="flex w-[360px] max-w-full select-none flex-col gap-2">
        <x-admin::accordion>
            <x-slot:header>
                <p class="p-2.5 text-base font-semibold text-gray-800 dark:text-white">
                    General
                </p>
            </x-slot:header>

            <x-slot:content>
                <!-- Title -->
                <x-admin::form.control-group>
                    <x-admin::form.control-group.label class="required !text-gray-800 dark:!text-white">
                        Title
                    </x-admin::form.control-group.label>

                    <x-admin::form.control-group.control
                        type="text"
                        name="title"
                        rules="required"
                        :value="old('title')"
                        placeholder="Enter title..."
                    />

                    <x-admin::form.control-group.error control-name="title" />
                </x-admin::form.control-group>

                <!-- Image Upload -->
                <x-admin::form.control-group>
                    <x-admin::form.control-group.label class="!text-gray-800 dark:!text-white">
                        Featured Image
                    </x-admin::form.control-group.label>

                    <x-admin::form.control-group.control
                        type="file"
                        name="image"
                        accept="image/jpeg,image/png,image/jpg,image/gif"
                    />

                    <x-admin::form.control-group.error control-name="image" />
                </x-admin::form.control-group>

 <!-- Status Toggle -->
<x-admin::form.control-group class="!mb-0">
    <div class="flex items-center gap-1.5">
        <x-admin::form.control-group.control
            type="checkbox"
            name="status"
            id="status"
            value="1"
            :checked="old('status', false)"
            class="rounded transition-all duration-100 ease-in-out border-gray-300 text-primary-600 shadow-sm focus:border-primary-600 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus:ring-offset-0 dark:border-gray-600 dark:bg-gray-900 dark:checked:border-primary-600 dark:checked:bg-primary-600 dark:focus:ring-primary-800 dark:focus:ring-offset-primary-700"
        />

        <x-admin::form.control-group.label
            for="status"
            class="!text-gray-800 dark:!text-white cursor-pointer"
        >
            Publish Status
        </x-admin::form.control-group.label>
    </div>

    <x-admin::form.control-group.error control-name="status" />
</x-admin::form.control-group>
            </x-slot:content>
        </x-admin::accordion>
    </div>
</div>

{!! view_render_event('blog::admin.posts.create.after') !!}

</x-admin::form>
        </div>
    </div>
</x-admin::layouts>
