<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Short URL') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div class="text-xl font-semibold text-gray-900 mb-6">
                        Editing: <span class="text-blue-600">{{ url($shortUrl->short_code) }}</span>
                    </div>

                    <form method="POST" action="{{ route('web.short_urls.update', $shortUrl) }}">
                        @csrf
                        @method('PUT')

                        <!-- Original URL -->
                        <div class="col-span-6 sm:col-span-4 mb-4">
                            <label for="original_url" class="block font-medium text-sm text-gray-700">
                                {{ __('Original URL') }}
                            </label>
                            <input id="original_url" name="original_url" type="url" required
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                placeholder="https://example.com/very-long-link"
                                value="{{ old('original_url', $shortUrl->original_url) }}">
                            @error('original_url')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Short Code (Display Only) -->
                        <div class="col-span-6 sm:col-span-4 mb-4">
                            <label for="short_code_display" class="block font-medium text-sm text-gray-700">
                                {{ __('Short Code') }}
                            </label>
                            <div class="flex items-center mt-1">
                                <span class="text-gray-500 mr-1">{{ url('/') }}/</span>
                                <input id="short_code_display" type="text" readonly disabled
                                    class="flex-1 bg-gray-100 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm cursor-not-allowed"
                                    value="{{ $shortUrl->short_code }}">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Short code cannot be changed after creation.</p>
                        </div>

                        <!-- Active Status -->
                        <div class="col-span-6 sm:col-span-4 mb-6">
                            <label for="is_active" class="flex items-center">
                                <input type="checkbox" id="is_active" name="is_active" value="1"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                    @checked(old('is_active', $shortUrl->is_active))>
                                <span class="ms-2 text-sm text-gray-600">
                                    {{ __('Activate Link (When unchecked, the link will not redirect)') }}
                                </span>
                            </label>
                            @error('is_active')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Update Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
