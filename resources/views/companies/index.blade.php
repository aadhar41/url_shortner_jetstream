<x-app-layout>
    {{-- Page Header Slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client Management') }}
        </h2>

        {{-- DataTables CSS CDN --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.min.css">
    </x-slot>

    {{-- Main Content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                {{-- Create Button and Alerts --}}
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('web.companies.create') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out shadow-md">
                        {{ __('Invite') }}
                    </a>
                </div>

                @if (session('success'))
                    <div class="bg-emerald-100 border border-emerald-500 text-emerald-800 px-5 py-4 rounded-lg relative mb-4 shadow-md transition duration-300"
                        role="alert">
                        <span class="block sm:inline font-semibold">{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Table for Companies (DataTables enabled) --}}
                <div class="overflow-x-auto">
                    <table id="companies-table" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Owner</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Users</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($companies as $company)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $company->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                        {{ $company->name }}</td>
                                    {{-- Email Column --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                        {{ $company->email }}</td>

                                    {{-- Owner Column --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                        {{ $company->owner->name ?? 'N/A' }}</td>

                                    {{-- Member Count Column --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center font-bold text-indigo-600">
                                        {{ $company->totalMemberCount() }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        {{-- Actions --}}
                                        <a href="{{ route('web.companies.show', $company) }}"
                                            class="bg-blue-600 hover:bg-blue-700 text-gray-600 hover:text-gray-900 font-medium mr-4 py-1 px-3 rounded-md transition duration-150 ease-in-out shadow-md">
                                            View
                                        </a>
                                        <a href="{{ route('web.companies.edit', $company) }}"
                                            class="bg-yellow-600 hover:bg-yellow-700 text-indigo-600 hover:text-indigo-900 font-medium mr-4 py-1 px-3 rounded-md transition duration-150 ease-in-out shadow-md">
                                            Edit
                                        </a>

                                        <form action="{{ route('web.companies.destroy', $company) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-1 px-3 rounded-md transition duration-150 ease-in-out shadow-md"
                                                onclick="return confirm('Are you sure you want to delete this company?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    {{-- Colspan updated from 5 to 6 --}}
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                        No companies found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- DataTables JavaScript Initialization --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.min.js"></script>

    <script>
        // Initialize DataTables once the document is ready
        $(document).ready(function() {
            $('#companies-table').DataTable({
                responsive: true,
                // Disable ordering/searching on the Actions column (now column index 5)
                columnDefs: [{
                    targets: 5, // Actions column index updated from 4 to 5
                    orderable: false,
                    searchable: false
                }]
            });
        });
    </script>
</x-app-layout>
