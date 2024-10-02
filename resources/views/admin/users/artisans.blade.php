<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
            {{ __('Artisans') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-xl sm:rounded-lg">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Artisan Profiles</h3>

                @if($artisans->isEmpty())
                    <p class="text-gray-500">No artisans found.</p>
                @else
                    <ul class="mt-4 space-y-4">
                        @foreach($artisans as $artisan)
                            <li class="p-4 bg-blue-100 rounded-md shadow-md">
                                <p><strong>Name:</strong> {{ $artisan->name }}</p>
                                <p><strong>Email:</strong> {{ $artisan->email }}</p>

                                @if($artisan->artisanProfile)
                                    <p><strong>Street Address:</strong> {{ $artisan->artisanProfile->street_address ?? 'N/A' }}</p>
                                    <p><strong>City:</strong> {{ $artisan->artisanProfile->city ?? 'N/A' }}</p>
                                    <p><strong>Postal Code:</strong> {{ $artisan->artisanProfile->postal_code ?? 'N/A' }}</p>
                                    <p><strong>Years of Experience:</strong> {{ $artisan->artisanProfile->years_of_experience ?? 'N/A' }}</p>

                                    {{-- Check if skills is an array before using implode --}}
                                    <p><strong>Skills:</strong> {{ is_array($artisan->artisanProfile->skills) ? implode(', ', $artisan->artisanProfile->skills) : 'N/A' }}</p>

                                    {{-- Check if social_media_links is an array before using implode --}}
                                    <p><strong>Social Media Links:</strong> {{ is_array($artisan->artisanProfile->social_media_links) ? implode(', ', $artisan->artisanProfile->social_media_links) : 'N/A' }}</p>
                                @else
                                    <p><strong>Profile:</strong> N/A (No artisan profile available)</p>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
