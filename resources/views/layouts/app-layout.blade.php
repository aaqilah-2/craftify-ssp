<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- Add your custom CSS and icons here -->
    <head>
        <!-- Include Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    
    <style>
        .sidebar {
            background-color: #2a2b3d;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #404456;
            border-radius: 0.5rem;
            padding-left: 1rem;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-1/5 p-6 sidebar">
        <h2 class="mb-8 text-xl font-semibold">Admin Panel</h2>
        <ul>
            <li class="mb-4"><a href="#">Dashboard</a></li>
           
            <li class="mb-4"><a href="{{ url('/admin/products') }}" class="text-gray-600 hover:text-gray-900">Pending Products</a></li>
            <li class="mb-4"><a href="{{ url('/admin/products/approved') }}" class="text-gray-600 hover:text-gray-900">Approved Products</a></li>
            <li class="mb-4"><a href="{{ url('/admin/products/rejected') }}" class="text-gray-600 hover:text-gray-900">Rejected Products</a></li>
            <li class="mb-4"><a href="#">Analytics</a></li>
            <li class="mb-4"><a href="#">Reports</a></li>
            <li class="mb-4"><a href="#">Orders</a></li>
            <li class="mb-4"><a href="#">Products</a></li>
            <li class="mb-4"><a href="#">Users</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="w-4/5 p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-3xl font-semibold">@yield('page-title', 'Dashboard')</h1>
            <div class="flex items-center space-x-4">
                <div class="text-sm text-gray-500">Welcome, Admin</div>
                <img src="https://via.placeholder.com/40" class="w-10 h-10 rounded-full" alt="Admin">
            </div>
        </div>

        <!-- Alerts for success/error messages -->
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

        <!-- Main Content Section -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>
