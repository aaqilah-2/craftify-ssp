<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-xl sm:rounded-lg">
                @if (session('success'))
                    <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <h3 class="mb-4 text-lg font-bold">Users</h3>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="text-white bg-pink-600">
                            <th class="w-1/4 px-4 py-2">Name</th>
                            <th class="w-1/4 px-4 py-2">Email</th>
                            <th class="w-1/4 px-4 py-2">Role</th>
                            <th class="w-1/4 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="bg-gray-100">
                                <td class="px-4 py-2 border">{{ $user->name }}</td>
                                <td class="px-4 py-2 border">{{ $user->email }}</td>
                                <td class="px-4 py-2 border">{{ $user->role == 1 ? 'Admin' : ($user->role == 2 ? 'Artisan' : 'Customer') }}</td>
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600">Edit</a>
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
