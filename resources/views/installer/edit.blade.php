<x-app-layout>
    <x-head-lable backhref="{{ route('gallery.index') }}">
        {{ __('Gallery Edit') }}
    </x-head-lable>

    <form method="POST" action="{{ route('gallery.update', $gallery->id) }}" enctype="multipart/form-data"
        class="border-4 border-white rounded-lg p-2 sm:p-4 ">
        @csrf
        @method('PUT')
        <div class="grid md:grid-cols-2 gap-4">

            <!-- image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Image')" />
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 p-1"
                    id="image" name="image" type="file">
                <img src="{{ $gallery->image }}" alt="img" class="w-20 h-20">
            </div>

            <!-- swiper -->
            <div class="mt-4">
                <x-input-label for="swiper" :value="__('Show Swiper')" />
                <select id="swiper" name="swiper"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0" @selected(old('swiper', $gallery->swiper) == '0')>False</option>
                    <option value="1" @selected(old('swiper', $gallery->swiper) == '1')>True</option>
                </select>
            </div>

            <!-- products -->
            <div class="mt-4">
                <x-input-label for="products" :value="__('Show Products')" />
                <select id="products" name="products"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0" @selected(old('products', $gallery->products) == '0')>False</option>
                    <option value="1" @selected(old('products', $gallery->products) == '1')>True</option>
                </select>
            </div>

            <!-- shorting -->
            <div class="mt-4">
                <x-input-label for="shorting" :value="__('Shorting')" />
                <x-text-input id="shorting" class="block mt-1 w-full" type="number" name="shorting" :value="old('shorting', $gallery->shorting)"
                    placeholder="Enter Shorting" />
                <x-input-error :messages="$errors->get('shorting')" class="mt-2" />
            </div>

            <!-- status -->
            <div class="mt-4">
                <x-input-label for="status" :value="__('Show Status')" />
                <select id="status" name="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="Active" @selected(old('status', $gallery->status) == 'Active')>Active</option>
                    <option value="Inactive" @selected(old('status', $gallery->status) == 'Inactive')>Inactive</option>
                </select>
            </div>
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 "
                href="{{ route('gallery.index') }}">
                {{ __('Cancel') }}
            </a>

            <button type="submit"
                class="text-white hover:text-blue-900 bg-blue-900 border border-blue-300 focus:outline-none hover:bg-blue-100 focus:ring-4 focus:ring-blue-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 ">{{ __('Update') }}</button>
        </div>
    </form>
</x-app-layout>
