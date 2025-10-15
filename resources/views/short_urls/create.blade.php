<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Short URL') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div class="text-xl font-semibold text-gray-900 mb-6">
                        Shorten a new link
                    </div>

                    <form method="POST" action="{{ route('web.short_urls.store') }}">
                        @csrf

                        <!-- Original URL -->
                        <div class="col-span-6 sm:col-span-4 mb-4">
                            <label for="original_url" class="block font-medium text-sm text-gray-700">
                                {{ __('Original URL') }}
                            </label>
                            <input id="original_url" name="original_url" type="url" required autofocus
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                placeholder="https://example.com/very-long-link" value="{{ old('original_url') }}">
                            @error('original_url')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Custom Short Code (Optional) -->
                        {{-- <div class="col-span-6 sm:col-span-4 mb-6">
                            <label for="short_code" class="block font-medium text-sm text-gray-700">
                                {{ __('Custom Short Code (Optional)') }}
                            </label>
                            <div class="flex items-center mt-1">
                                <span class="text-gray-500 mr-1">{{ url('/') }}/</span>
                                <input id="short_code" name="short_code" type="text"
                                    class="flex-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="my-custom-link" value="{{ old('short_code') }}">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Leave blank to auto-generate a random code.</p>
                            @error('short_code')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Shorten Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
