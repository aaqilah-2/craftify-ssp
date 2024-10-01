@extends('layouts.app-layout')

@section('title', 'Pending Products')

@section('content')
    <!-- Main Content -->
    <div class="w-full p-6">
        <!-- Display Success or Error Messages -->
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="mb-4 text-2xl font-semibold">Pending Products for Approval</h1>

        @if($products->isEmpty())
            <p class="text-gray-500">No pending products available for approval.</p>
        @else
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($products as $product)
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="object-cover w-full h-40 mb-4 rounded-lg">
                        <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                        <p class="text-gray-600">{{ $product->description }}</p>
                        <p class="mt-2 font-semibold text-gray-700">${{ $product->price }}</p>
                        <p class="mt-1 text-gray-500">{{ $product->category }}</p>
                        
                        <!-- Artisan info -->
                        <p class="mt-1 text-gray-500">Uploaded by: {{ $product->artisan->name }} ({{ $product->artisan->email }})</p>

                        <div class="flex justify-between mt-4">
                            <form action="{{ url('/products/' . $product->id . '/approve') }}" method="POST" class="inline-block">
                                @csrf
                                <button class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-700">Approve</button>
                            </form>
                            <form action="{{ url('/products/' . $product->id . '/reject') }}" method="POST" class="inline-block">
                                @csrf
                                <button class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-700">Reject</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
