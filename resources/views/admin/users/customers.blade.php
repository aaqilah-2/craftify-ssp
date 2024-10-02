<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-xl sm:rounded-lg">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Customer Profiles</h3>
                
                @if($customers->isEmpty())
                    <p class="text-gray-500">No customers found.</p>
                @else
                    <ul class="mt-4 space-y-4">
                        @foreach($customers as $customer)
                            <li class="p-4 bg-green-100 rounded-md shadow-md">
                                <p><strong>Name:</strong> {{ $customer->name }}</p>
                                <p><strong>Email:</strong> {{ $customer->email }}</p>
                                <p><strong>Street Address:</strong> {{ $customer->customerProfile->street_address ?? 'N/A' }}</p>
                                <p><strong>City:</strong> {{ $customer->customerProfile->city ?? 'N/A' }}</p>
                                <p><strong>Postal Code:</strong> {{ $customer->customerProfile->postal_code ?? 'N/A' }}</p>
                                <p><strong>Phone Number:</strong> {{ $customer->customerProfile->phone_number ?? 'N/A' }}</p>
                                <p><strong>Preferences:</strong> {{ implode(', ', $customer->customerProfile->preferences ?? []) }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
