<x-app-layout>
    <x-head-label backhref="{{ route('installer.index') }}">
        {{ __('Installer Edit') }}
    </x-head-label>

    <form method="POST" action="{{ route('installer.update', base64_encode($user->id)) }}" enctype="multipart/form-data"
        class=" rounded-lg p-5 bg-white dark:text-white dark:bg-gray-800">
        @csrf
        @method('PUT')
        <div class="grid md:grid-cols-2 gap-4">

            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" placeholder="Enter name"
                    class="block mt-1 w-full dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" placeholder="Enter email"
                    class="block mt-1 w-full dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" name="password" type="password"
                    class="block mt-1 w-full dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600"
                    placeholder="********" :value="old('password')" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Mobile No -->
            <div class="mt-4">
                <x-input-label for="mobile_no" :value="__('Mobile No')" />
                <x-text-input id="mobile_no" name="mobile_no" type="text" :value="old('mobile_no', $user->mobile_no)"
                    placeholder="Enter 10 digit mobile no"
                    class="block mt-1 w-full dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600" />
                <x-input-error :messages="$errors->get('mobile_no')" class="mt-2" />
            </div>

            <!-- Role -->
            <div class="mt-4">
                <x-input-label for="role" :value="__('Role')" />
                <select id="role" name="role"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="Installer" @selected(old('role', $user->role) == 'Installer')>Installer</option>
                    <option value="Admin" @selected(old('role', $user->role) == 'Admin')>Admin</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Status -->
            <div class="mt-4">
                <x-input-label for="status" :value="__('Status')" />
                <select id="status" name="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="Active" @selected(old('status', $user->status) == 'Active')>Active</option>
                    <option value="Inactive" @selected(old('status', $user->status) == 'Inactive')>Inactive</option>
                </select>
            </div>

            <!-- Profile Image -->
            <div class="mt-4">
                <x-input-label for="profile" :value="__('Profile Image')" />
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-200 focus:outline-none dark:bg-gray-700 dark:border-gray-600 p-2"
                    id="profile" name="profile" type="file" accept="image/*">
                <x-input-error :messages="$errors->get('profile')" class="mt-2" />

                @if ($user->profile)
                    <img src="{{ asset($user->profile) }}" alt="profile" class="w-16 mt-2 rounded">
                @endif
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('installer.index') }}"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-200 focus:ring-4 dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2">
                {{ __('Cancel') }}
            </a>
            <button type="submit"
                class="text-white border bg-orange-500 hover:bg-orange-600 focus:outline-none  focus:ring-4 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2">
                {{ __('Update') }}
            </button>
        </div>
    </form>
</x-app-layout>
