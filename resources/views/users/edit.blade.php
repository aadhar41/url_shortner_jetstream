<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User: ') . $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 sm:px-12">

                <form action="{{ route('web.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mt-4">
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', $user->name)" required autofocus />
                        <x-input-error for="name" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email', $user->email)" required />
                        <x-input-error for="email" class="mt-2" />
                    </div>

                    <!-- Company -->
                    <div class="mt-4">
                        <x-label for="company_id" value="{{ __('Company') }}" />
                        <select id="company_id" name="company_id" required
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">{{ __('Select Company') }}</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" @selected(old('company_id', $user->company_id) == $company->id)>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="company_id" class="mt-2" />
                    </div>

                    <!-- Role -->
                    <div class="mt-4">
                        <x-label for="role" value="{{ __('Role') }}" />
                        <select id="role" name="role" required
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach ($availableRoles as $role)
                                <option value="{{ $role }}" @selected(old('role', $user->role) === $role)>
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="role" class="mt-2" />
                    </div>

                    <!-- Password (Optional) -->
                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Change Password (Optional)') }}
                        </h3>
                        <div class="mt-4">
                            <x-label for="password" value="{{ __('New Password') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" />
                            <p class="text-xs text-gray-500 mt-1">{{ __('Leave blank to keep current password.') }}</p>
                            <x-input-error for="password" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-label for="password_confirmation" value="{{ __('Confirm New Password') }}" />
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" />
                            <x-input-error for="password_confirmation" class="mt-2" />
                        </div>
                    </div>


                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('web.users.index') }}"
                            class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                            {{ __('Cancel') }}
                        </a>
                        <x-button class="ms-4">
                            {{ __('Update User') }}
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
