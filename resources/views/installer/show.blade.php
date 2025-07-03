<x-app-layout>
    <x-head-lable backhref="{{ route('gallery.index') }}">
        {{ __('Gallery Show') }}
    </x-head-lable>

    <div class="border-4 border-white rounded-lg p-2 sm:p-4">
        <div class="grid md:grid-cols-2 gap-4">

            <!-- image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Image')" />
                <img src="{{ $gallery->image }}" alt="img" class="w-72 h-72">
            </div>

            <!-- swiper -->
            <div class="mt-4">
                <x-input-label for="swiper" :value="__('Show Swiper')" />
                <x-text-input id="swiper" class="block mt-1 w-full" type="text" name="swiper" :value="$gallery->products == 1 ? 'true' : 'false'"
                    disabled />
            </div>

            <!-- products -->
            <div class="mt-4">
                <x-input-label for="products" :value="__('Show products')" />
                <x-text-input id="products" class="block mt-1 w-full" type="text" name="products" :value="$gallery->products == 1 ? 'true' : 'false'"
                    disabled />
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
                <x-input-label for="status" :value="__('Status')" />
                <x-text-input id="status" class="block mt-1 w-full" type="text" name="status" :value="old('status', $gallery->status)"
                    disabled />
                </select>
            </div>
        </div>
    </div>
</x-app-layout>
