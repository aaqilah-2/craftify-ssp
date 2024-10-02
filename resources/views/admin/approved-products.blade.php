<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Approved Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 shadow-xl bg-pink-50 sm:rounded-lg">
                <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">Approved Products</h3>

                @if($products->isEmpty())
                    <p class="text-gray-500">No approved products available.</p>
                @else
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($products as $product)
                            <div class="p-4 bg-pink-200 border border-pink-300 rounded-lg shadow-lg dark:bg-pink-800">
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="object-cover w-full h-48 mb-4 rounded-md shadow-md" 
                                     style="max-height: 300px; object-fit: cover;">
                                <h2 class="text-lg font-semibold text-white dark:text-pink-100">{{ $product->name }}</h2>
                                <p class="mt-2 font-bold text-white dark:text-pink-100">{{ $product->description }}</p>
                                <p class="mt-2 font-bold text-gray-800 dark:text-gray-300">Price: Rs.{{ $product->price }}</p>
                                <p class="mt-1 font-semibold text-gray-700 dark:text-pink-200">{{ $product->category }}</p>
                                
                                <!-- Artisan info -->
                                <p class="mt-2 text-sm font-semibold text-gray-900 dark:text-pink-300">Uploaded by: {{ $product->artisan->name }} ({{ $product->artisan->email }})</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
