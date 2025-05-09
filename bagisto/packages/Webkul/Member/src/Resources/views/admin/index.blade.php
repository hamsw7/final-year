<x-admin::layouts>
    <x-slot:title>
        Members
    </x-slot>

    <div class="content">
        <div class="page-content">
            {!! view_render_event('members::admin.index.before') !!}

            <!-- Page Header -->
            <div class="flex items-center justify-between gap-4 max-sm:flex-wrap mb-4">
                <p class="text-xl font-bold text-gray-800 dark:text-white">
                    Members Management
                </p>

                <div class="flex items-center gap-x-2.5">
                    <a
                        href="{{ route('admin.member.create') }}"
                        class="primary-button"
                    >
                        Add Member
                    </a>

                    <a
                        href="{{ route('admin.member.send') }}"
                        class="transparent-button hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800"
                    >
                        Send Message
                    </a>
                </div>
            </div>

            <!-- Members Table -->
            <div class="box-shadow rounded bg-white dark:bg-gray-900 overflow-hidden">
                <div class="table-responsive">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-white">Name</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-white">Email</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-white">Phone</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-white">Address</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-white">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($members as $member)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-white">{{ $member->name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-white">{{ $member->email }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-white">{{ $member->phone ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-white">{{ $member->address ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex items-center gap-2.5">
                                            <a
                                                href="{{ route('admin.member.edit', $member->id) }}"
                                                class="icon-transition cursor-pointer p-1.5 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md text-blue-600 dark:text-blue-400"
                                                title="Edit"
                                            >
                                                <span class="icon-edit"></span>
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route('admin.member.delete', $member->id) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this member?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="icon-transition cursor-pointer p-1.5 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md text-red-600 dark:text-red-400"
                                                    title="Delete"
                                                >
                                                    <span class="icon-delete"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-400 dark:text-gray-300">
                                        No members found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {!! view_render_event('members::admin.index.after') !!}
        </div>
    </div>
</x-admin::layouts>
