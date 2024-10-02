<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Pending Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 shadow-xl bg-pink-50 sm:rounded-lg">
                <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">Review Pending Products</h3>

                @if($products->isEmpty())
                    <p class="text-gray-500">No pending products available for approval.</p>
                @else
                    @foreach($products as $product)
                        <div class="p-6 mb-6 bg-pink-200 border border-pink-300 rounded-lg shadow-lg dark:bg-pink-800">
                            <h2 class="mb-2 text-lg font-bold text-gray-800 dark:text-white">{{ $product->name }}</h2>
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="object-cover w-full h-48 mb-4 rounded-md shadow-md" 
                                 style="max-height: 300px; object-fit: contain;">
                             
                            <p class="mt-2 font-semibold text-gray-800 dark:text-gray-300">Description: {{ $product->description }}</p>
                            <p class="mt-2 font-semibold text-gray-800 dark:text-gray-300">Category: {{ $product->category }}</p>
                            <p class="mt-2 font-bold text-gray-800 dark:text-gray-300">Price: Rs.{{ $product->price }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Status: {{ $product->status }}</p>
                            
                            <!-- Artisan info -->
                            <p class="mt-2 text-sm font-semibold text-gray-900 dark:text-pink-300">Uploaded by: {{ $product->artisan->name }} ({{ $product->artisan->email }})</p>

                            <div class="flex mt-4 space-x-2">
                                <form action="/products/{{ $product->id }}/approve" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-700">Approve</button>
                                </form>
                                <form action="/products/{{ $product->id }}/reject" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-700">Reject</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
