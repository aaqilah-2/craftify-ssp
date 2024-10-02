<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                
                <!-- Pending Products Card -->
                <div class="p-6 overflow-hidden text-white bg-pink-600 rounded-lg shadow-md">
                    <h3 class="text-lg font-medium">Pending Products</h3>
                    <p class="text-3xl font-bold">{{ $pendingCount }}</p>
                    <a href="{{ url('/admin/products') }}" class="block mt-4 text-center">
                        <button class="px-4 py-2 text-white bg-purple-400 rounded-md hover:bg-purple-500">
                            View Pending Products
                        </button>
                    </a>
                </div>

                <!-- Approved Products Card -->
                <div class="p-6 overflow-hidden text-white bg-pink-500 rounded-lg shadow-md">
                    <h3 class="text-lg font-medium">Approved Products</h3>
                    <p class="text-3xl font-bold">{{ $approvedCount }}</p>
                    <a href="{{ url('/admin/products/approved') }}" class="block mt-4 text-center">
                        <button class="px-4 py-2 text-white bg-purple-400 rounded-md hover:bg-purple-500">
                            View Approved Products
                        </button>
                    </a>
                </div>

                <!-- Rejected Products Card -->
                <div class="p-6 overflow-hidden text-white bg-pink-400 rounded-lg shadow-md">
                    <h3 class="text-lg font-medium">Rejected Products</h3>
                    <p class="text-3xl font-bold">{{ $rejectedCount }}</p>
                    <a href="{{ url('/admin/products/rejected') }}" class="block mt-4 text-center">
                        <button class="px-4 py-2 text-white bg-purple-400 rounded-md hover:bg-purple-500">
                            View Rejected Products
                        </button>
                    </a>
                </div>
            </div>

            <!-- Space between sections -->
            <div class="mt-8"></div>

            <!-- User Management Section -->
            <div class="p-6 mt-8 overflow-hidden text-white bg-pink-700 rounded-lg shadow-md">
                <h3 class="text-xl font-bold">User Management</h3>
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <a href="{{ url('/admin/users') }}" class="block text-center">
                        <button class="w-full px-6 py-3 text-white bg-blue-300 rounded-md hover:bg-blue-400">
                            View All Users
                        </button>
                    </a>
                    <a href="{{ url('/admin/users/create') }}" class="block text-center">
                        <button class="w-full px-6 py-3 text-white bg-green-300 rounded-md hover:bg-green-400">
                            Add New User
                        </button>
                    </a>
                </div>
            </div>

            <!-- Space between sections -->
            <div class="mt-8"></div>

            <!-- Customer Count Card -->
            <div class="p-6 overflow-hidden text-white bg-purple-400 rounded-lg shadow-md">
                <h3 class="text-lg font-medium">Customers</h3>
                <p class="text-3xl font-bold">{{ $customerCount }}</p>
                <a href="{{ url('/admin/users/customers') }}" class="block mt-4 text-center">
                    <button class="px-4 py-2 text-white bg-pink-700 rounded-md hover:bg-pink-400">
                        View Customers
                    </button>
                </a>
            </div>

            <!-- Space between sections -->
            <div class="mt-8"></div>

            <!-- Artisan Count Card -->
            <div class="p-6 overflow-hidden text-white bg-purple-400 rounded-lg shadow-md">
                <h3 class="text-lg font-medium">Artisans</h3>
                <p class="text-3xl font-bold">{{ $artisanCount }}</p>
                <a href="{{ url('/admin/users/artisans') }}" class="block mt-4 text-center">
                    <button class="px-4 py-2 text-white bg-pink-700 rounded-md hover:bg-pink-400">
                        View Artisans
                    </button>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
