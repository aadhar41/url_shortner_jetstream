<x-app-layout>
    {{-- Page Header Slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invite Company/Client') }}
        </h2>
    </x-slot>

    {{-- Main Content --}}
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    {{-- Form --}}
                    <form action="{{ route('web.companies.store') }}" method="POST">
                        @csrf

                        {{-- Name Input --}}
                        <div class="mb-4">
                            <x-label for="name" value="{{ __('Company/Client Name') }}" />
                            <x-input id="name" type="text" name="name" :value="old('name')" required autofocus
                                class="mt-1 block w-full" />
                            <x-input-error for="name" class="mt-2" />
                        </div>

                        {{-- Email Input --}}
                        <div class="mb-4">
                            <x-label for="email" value="{{ __('Company/Client Email') }}" />
                            <x-input id="email" type="email" name="email" :value="old('email')"
                                class="mt-1 block w-full" />
                            <x-input-error for="email" class="mt-2" />
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-end mt-6">
                            {{-- Cancel Button --}}
                            <a href="{{ route('web.companies.index') }}"
                                class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                {{ __('Cancel') }}
                            </a>

                            {{-- Submit Button --}}
                            <x-button class="ms-4">
                                {{ __('Invite') }}
                            </x-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
