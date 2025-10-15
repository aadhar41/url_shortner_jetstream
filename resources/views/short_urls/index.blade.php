<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Short URLs Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

                    <!-- Actions Row: Filter, Search, Create Button, Download Button -->
                    <div
                        class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
                        <h3 class="text-2xl font-bold text-gray-700">Your Short Links</h3>

                        <!-- Combined Actions: Filter, Search, Download, Create. Using gap-3 for consistent spacing -->
                        <div class="flex flex-wrap items-center justify-end gap-3 w-full sm:w-auto">

                            <!-- Filter Dropdown Form -->
                            <form method="GET" action="{{ route('web.short_urls.index') }}" id="filter-form">
                                {{-- Preserve search term if present when filtering --}}
                                @if (request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                <select name="period" onchange="document.getElementById('filter-form').submit()"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm p-2 bg-white pr-8">
                                    <option value="">All Time</option>
                                    <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>
                                        Today</option>
                                    <option value="week" {{ request('period') == 'week' ? 'selected' : '' }}>
                                        This Week</option>
                                    <option value="month" {{ request('period') == 'month' ? 'selected' : '' }}>
                                        This Month</option>
                                </select>
                            </form>

                            <!-- Search Form -->
                            <form method="GET" action="{{ route('web.short_urls.index') }}"
                                class="flex items-center w-full sm:w-auto">
                                {{-- Preserve filter period if present when searching --}}
                                @if (request('period'))
                                    <input type="hidden" name="period" value="{{ request('period') }}">
                                @endif
                                <input type="search" name="search" placeholder="Search URLs or codes..."
                                    value="{{ request('search') }}"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-l-lg shadow-sm text-sm p-2 w-full sm:w-40" />
                                <button type="submit"
                                    class="inline-flex items-center p-2 bg-gray-700 border border-transparent rounded-r-lg text-white shadow-lg transition ease-in-out duration-150 hover:bg-gray-800 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    <!-- Search Icon (Filled for better visibility) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                                    </svg>
                                </button>
                            </form>

                            <!-- Download Button -->
                            <a href="{{ route('web.short_urls.index', array_merge(request()->query(), ['download' => 'csv'])) }}"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest shadow-lg transition ease-in-out duration-150 hover:bg-red-700 hover:shadow-xl active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 disabled:opacity-25">
                                <!-- Download Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v7a1 1 0 11-2 0V4a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ __('Download CSV') }}
                            </a>

                            <!-- Generate Short URL Button -->
                            <a href="{{ route('web.short_urls.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest shadow-lg transition ease-in-out duration-150 hover:bg-indigo-700 hover:shadow-xl active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-25">
                                {{ __('Generate Short URL') }}
                            </a>
                        </div>
                    </div>

                    <!-- Success Message Display -->
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif


                    @if ($shortUrls->isEmpty())
                        <div class="text-center py-10 text-gray-500">
                            @if (request('search'))
                                <p class="text-lg">No short links found matching "{{ request('search') }}".</p>
                                <p class="mt-2">Try a different search term or click the button above to create a new
                                    one.</p>
                            @else
                                <p class="text-lg">You haven't created any short URLs yet.</p>
                                <p class="mt-2">Click the **Generate Short URL** button to start shortening!</p>
                            @endif
                        </div>
                    @else
                        <!-- Short URLs Table -->
                        <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Original URL
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Short Code
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Clicks
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        {{-- Added: New Created At Header --}}
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Created At
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($shortUrls as $shortUrl)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 truncate max-w-xs"
                                                title="{{ $shortUrl->original_url }}">
                                                <a href="{{ $shortUrl->original_url }}" target="_blank"
                                                    class="text-blue-600 hover:text-blue-900">
                                                    {{ Str::limit($shortUrl->original_url, 50) }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ url($shortUrl->short_code) }}" target="_blank"
                                                        class="text-green-600 font-mono hover:text-green-900">
                                                        /{{ $shortUrl->short_code }}
                                                    </a>
                                                    <button type="button"
                                                        onclick="copyToClipboard('{{ url($shortUrl->short_code) }}')"
                                                        class="text-gray-400 hover:text-gray-600 transition"
                                                        title="Copy full link">
                                                        <!-- Icon for Copy -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v2M8 5h2M12 7v10m-3-3h6" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center font-semibold">
                                                {{ number_format($shortUrl->access_count) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                                @if ($shortUrl->is_active)
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            {{-- Added: Created At Data Cell --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left"
                                                title="{{ $shortUrl->created_at->toFormattedDateString() }}">
                                                {{ $shortUrl->created_at->diffForHumans() }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                <a href="{{ route('web.short_urls.edit', $shortUrl) }}"
                                                    class="bg-blue-600 hover:bg-blue-700 text-gray-600 hover:text-gray-900 font-medium mr-4 py-1 px-3 rounded-md transition duration-150 ease-in-out shadow-md">
                                                    {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('web.short_urls.destroy', $shortUrl) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- NOTE: Removed non-compliant browser 'confirm()' call --}}
                                                    <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-1 px-3 rounded-md transition duration-150 ease-in-out shadow-md"
                                                        title="Delete this short URL">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ $shortUrls->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Clipboard Copy -->
    <script>
        function copyToClipboard(text) {
            // Using a temporary textarea to ensure compatibility with execCommand
            const textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();

            try {
                // Execute copy command
                document.execCommand('copy');
                // NOTE: Using a simple console log here as alerts are discouraged in the environment.
                console.log('Copied to clipboard: ' + text);

                // Since alerts are discouraged, a toast notification would typically go here.

            } catch (err) {
                console.error('Could not copy text: ', err);
            }

            document.body.removeChild(textarea);
        }
    </script>
</x-app-layout>
