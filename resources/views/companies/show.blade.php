<x-app-layout>
    {{-- Page Header Slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Details: ' . $company->name) }}
        </h2>
    </x-slot>

    {{-- Main Content --}}
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Company Information') }}</h3>

                    {{-- Detail Fields --}}
                    <div class="space-y-4 border-t border-gray-200 pt-4">
                        <div class="flex items-center">
                            <p class="w-32 text-sm font-semibold text-gray-700">ID:</p>
                            <p class="text-sm text-gray-900">{{ $company->id }}</p>
                        </div>

                        <div class="flex items-center">
                            <p class="w-32 text-sm font-semibold text-gray-700">Name:</p>
                            <p class="text-sm text-gray-900">{{ $company->name }}</p>
                        </div>

                        {{-- New Email Field --}}
                        <div class="flex items-center">
                            <p class="w-32 text-sm font-semibold text-gray-700">Email:</p>
                            <p class="text-sm text-gray-900">{{ $company->email }}</p>
                        </div>
                        {{-- End New Email Field --}}

                        {{-- Optional: Display creation date --}}
                        <div class="flex items-center">
                            <p class="w-32 text-sm font-semibold text-gray-700">Created At:</p>
                            <p class="text-sm text-gray-900">{{ $company->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-6">
                        {{-- Back Button (using x-secondary-button for styling) --}}
                        <a href="{{ route('web.companies.index') }}">
                            <x-secondary-button>
                                {{ __('Back to List') }}
                            </x-secondary-button>
                        </a>

                        {{-- Edit Button --}}
                        <a href="{{ route('web.companies.edit', $company) }}" class="ms-3">
                            <x-button>
                                {{ __('Edit Company') }}
                            </x-button>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
