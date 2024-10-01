@extends('layouts.app-layout')

@section('content')
<div class="w-4/5 p-6">
    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="mb-4 text-2xl font-semibold">Approved Products</h1>

    @if($products->isEmpty())
        <p class="text-gray-500">No approved products available.</p>
    @else
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($products as $product)
            <div class="p-6 bg-white rounded-lg shadow-md">
                <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="object-cover w-full h-40 mb-4 rounded-lg">
                <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                <p class="text-gray-600">{{ $product->description }}</p>
                <p class="mt-2 font-semibold text-gray-700">${{ $product->price }}</p>
                <p class="mt-1 text-gray-500">{{ $product->category }}</p>
                <p class="mt-1 text-gray-500">Uploaded by: {{ $product->artisan->name }} ({{ $product->artisan->email }})</p>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
