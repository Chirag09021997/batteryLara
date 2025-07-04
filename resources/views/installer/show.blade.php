<x-app-layout>
    <x-head-label backhref="{{ route('installer.index') }}">
        {{ __('Installer Show') }}
    </x-head-label>

    <div class="rounded-lg p-5 bg-white dark:text-white dark:bg-gray-800">
        <div class="grid md:grid-cols-2 gap-4">
            <!-- name -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" type="text" :value="old('name', $user->name)"
                    class="block mt-1 w-full dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="text" :value="old('email', $user->email)"
                    class="block mt-1 w-full dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600" />
            </div>

            <!-- Mobile No -->
            <div class="mt-4">
                <x-input-label for="mobile_no" :value="__('Mobile No')" />
                <x-text-input id="mobile_no" type="text" :value="old('mobile_no', $user->mobile_no)"
                    class="block mt-1 w-full dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600" />
            </div>

            <!-- Role -->
            <div class="mt-4">
                <x-input-label for="role" :value="__('Role')" />
                <x-text-input id="role" type="text" :value="old('role', $user->role)"
                    class="block mt-1 w-full dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600" />
            </div>

            <!-- profile -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Profile')" />
                <img src="{{ $user->profile }}" alt="img" class="w-72 h-72">
            </div>

            <!-- status -->
            <div class="mt-4">
                <x-input-label for="status" :value="__('Status')" />
                <x-text-input id="status" class="block mt-1 w-full" type="text" name="status" :value="old('status', $user->status)"
                    disabled />
            </div>
        </div>
    </div>
</x-app-layout>
