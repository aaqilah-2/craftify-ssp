@extends('layouts.app-layout')

@section('title', 'Admin Dashboard')

@section('page-title', 'Dashboard')

@section('scripts')
<script>
    var ctx = document.getElementById('monthlyChart').getContext('2d');
    var monthlyChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'New Customers',
                data: [500, 600, 700, 800, 500, 650, 750],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>
@endsection


@section('content')
<!-- Dashboard content -->
<div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2 lg:grid-cols-3">
    <!-- Card 1: New Customers -->
    <div class="p-4 bg-orange-100 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold">New Customer</h2>
        <p class="text-2xl font-bold">852</p>
    </div>

    <!-- Card 2: Income -->
    <div class="p-4 bg-green-100 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold">Income</h2>
        <p class="text-2xl font-bold">$5,852</p>
    </div>

    <!-- Card 3: Tickets -->
    <div class="p-4 bg-red-100 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold">Ticket</h2>
        <p class="text-2xl font-bold">42</p>
    </div>

    <!-- Card 4: Orders -->
    <div class="p-4 bg-blue-100 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold">Orders</h2>
        <p class="text-2xl font-bold">$5,242</p>
    </div>
</div>

<!-- Chart Section -->
<div class="p-4 mb-6 bg-white rounded-lg shadow-md">
    <h3 class="mb-4 text-lg font-semibold">Monthly View</h3>
    <canvas id="monthlyChart" class="w-full h-40"></canvas>
</div>

<!-- Additional Content -->
<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div class="p-6 bg-white rounded-lg shadow-md">
        <h3 class="text-lg font-semibold">Total Leads</h3>
        <p>76.12% Overall</p>
        <p>16.40% Monthly</p>
    </div>
    <div class="p-6 bg-white rounded-lg shadow-md">
        <h3 class="text-lg font-semibold">Total Vendors</h3>
        <p>68.52% Overall</p>
        <p>28.90% Monthly</p>
    </div>
</div>
@endsection
