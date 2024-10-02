<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit User Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-xl sm:rounded-lg">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="role" class="block mb-2 text-sm font-bold text-gray-700">User Role:</label>
                        <select name="role" id="role" class="w-full px-4 py-2 border rounded">
                            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Artisan</option>
                            <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Customer</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="px-4 py-2 text-white bg-pink-600 rounded">Update Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
