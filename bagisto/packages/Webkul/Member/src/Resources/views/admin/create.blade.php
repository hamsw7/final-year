<x-admin::layouts>
    <x-slot:title>
        Create Member
    </x-slot>

    <div class="content">
        <div class="page-content">
            <x-admin::form :action="route('admin.member.store')">

                {!! view_render_event('members::admin.create.before') !!}

                <!-- Page Header -->
                <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
                    <p class="text-xl font-bold text-gray-800 dark:text-white">
                        Create New Member
                    </p>

                    <div class="flex items-center gap-x-2.5">
                        <a
                            href="{{ route('admin.member.index') }}"
                            class="transparent-button hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800"
                        >
                            Back
                        </a>

                        <button
                            type="submit"
                            class="primary-button"
                        >
                            Save Member
                        </button>
                    </div>
                </div>

                <!-- Form Container -->
                <div class="mt-3.5 flex gap-2.5 max-xl:flex-wrap">
                    <!-- Main Form Section -->
                    <div class="box-shadow flex flex-1 flex-col gap-2 rounded bg-white dark:bg-gray-900 p-4 max-xl:flex-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Name -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label class="required !text-gray-800 dark:!text-white">
                                    Name
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    name="name"
                                    rules="required|alpha"
                                    :value="old('name')"
                                    placeholder="Enter member name..."
                                />

                                <x-admin::form.control-group.error control-name="name" />
                            </x-admin::form.control-group>

                            <!-- Email -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label class="required !text-gray-800 dark:!text-white">
                                    Email
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="email"
                                    name="email"
                                    rules="required|email"
                                    :value="old('email')"
                                    placeholder="Enter member email..."
                                />

                                <x-admin::form.control-group.error control-name="email" />
                            </x-admin::form.control-group>

                            <!-- Phone -->
                            <x-admin::form.control-group class="md:col-span-2">
                                <x-admin::form.control-group.label class="!text-gray-800 dark:!text-white">
                                    Phone
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    name="phone"
                                    rules="required|numeric|max:10"
                                    :value="old('phone')"
                                    placeholder="Enter phone number..."
                                />

                                <x-admin::form.control-group.error control-name="phone" />
                            </x-admin::form.control-group>

                            <!-- Address -->
                            <x-admin::form.control-group class="md:col-span-2">
                                <x-admin::form.control-group.label class="!text-gray-800 dark:!text-white">
                                    Address
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    name="address"
                                    :value="old('address')"
                                    placeholder="Enter member address..."
                                />

                                <x-admin::form.control-group.error control-name="address" />
                            </x-admin::form.control-group>
                        </div>
                    </div>

                    <!-- Sidebar Section -->
                    <div class="flex w-[360px] max-w-full select-none flex-col gap-2">
                        <x-admin::accordion>
                            <x-slot:header>
                                <p class="p-2.5 text-base font-semibold text-gray-800 dark:text-white">
                                    Additional Settings
                                </p>
                            </x-slot:header>

                            <x-slot:content>
                                <!-- Add any additional fields here -->
                                <x-admin::form.control-group class="!mb-0">
                                    <div class="flex items-center gap-1.5">
                                        <x-admin::form.control-group.control
                                            type="checkbox"
                                            name="is_active"
                                            id="is_active"
                                            value="1"
                                            :checked="old('is_active', false)"
                                            class="rounded transition-all duration-100 ease-in-out border-gray-300 text-primary-600 shadow-sm focus:border-primary-600 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus:ring-offset-0 dark:border-gray-600 dark:bg-gray-900 dark:checked:border-primary-600 dark:checked:bg-primary-600 dark:focus:ring-primary-800 dark:focus:ring-offset-primary-700"
                                        />

                                        <x-admin::form.control-group.label
                                            for="is_active"
                                            class="!text-gray-800 dark:!text-white cursor-pointer"
                                        >
                                            Active Status
                                        </x-admin::form.control-group.label>
                                    </div>
                                </x-admin::form.control-group>
                            </x-slot:content>
                        </x-admin::accordion>
                    </div>
                </div>

                {!! view_render_event('members::admin.create.after') !!}

            </x-admin::form>
        </div>
    </div>
</x-admin::layouts>
