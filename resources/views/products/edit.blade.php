<x-app-layout>
    <x-head-label backhref="{{ route('product.index') }}">
        {{ __('Product Edit') }}
    </x-head-label>

    <form method="POST" action="{{ route('product.update', base64_encode($product->id)) }}" enctype="multipart/form-data"
        class=" rounded-lg p-5 bg-white dark:text-white dark:bg-gray-800">
        @csrf
        @method('PUT')
        <div class="grid md:grid-cols-2 gap-4">

            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" :value="old('name', $product->name)" placeholder="Enter name"
                    class="block mt-1 w-full dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- is_active -->
            <div class="mt-4">
                <x-input-label for="is_active" :value="__('Is Active')" />
                <select id="is_active" name="is_active"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="1" @selected(old('is_active', $product->is_active) == '1')>True</option>
                    <option value="0" @selected(old('is_active', $product->is_active) == '0')>False</option>
                </select>
            </div>

            <!-- Image -->
            <div class="mt-4 col-span-2">
                <x-input-label for="images" :value="__('Images (*) multiple')" />
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-200 focus:outline-none dark:bg-gray-700 dark:border-gray-600 p-2"
                    id="images" name="images[]" type="file" accept="image/*" multiple>
                <x-input-error :messages="$errors->get('profile')" class="mt-2" />

                @if ($product->image_urls)
                    <div class="grid md:grid-cols-6 grid-cols-3 gap-4 my-4">
                        @foreach ($product->image_urls as $url)
                            <div class="relative w-full">
                                <img src="{{ asset($url) }}" alt="img" class=" rounded border">
                                <button type="button" data-path="{{ $url }}"
                                    class="removeImage absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">×</button>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- hidden input to track removed images -->
                <input type="hidden" name="removed_images" id="removed_images">

            </div>
        </div>

        <div class="mt-6">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-lg font-medium">Warranties</h3>
                <button type="button" id="addWarranty"
                    class="text-white bg-green-500 hover:bg-green-600 focus:outline-none font-medium rounded-full text-sm px-4 py-2">
                    + Add Warranty
                </button>
            </div>

            <div id="warrantyContainer" class="space-y-4">
                @foreach ($product->warranties as $warranty)
                    <div class="grid md:grid-cols-4 gap-2 items-center border p-3 rounded-lg dark:border-gray-600">
                        <input type="hidden" name="existing_warranty_id[]" value="{{ $warranty->id }}" />
                        <select name="existing_warranty_coverage[]" required
                            class="block w-full text-sm border-gray-300 rounded-lg dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600 p-2">
                            <option value="Day" @selected($warranty->warranty_coverage == 'Day')>Day</option>
                            <option value="Month" @selected($warranty->warranty_coverage == 'Month')>Month</option>
                            <option value="Year" @selected($warranty->warranty_coverage == 'Year')>Year</option>
                        </select>

                        <input type="number" name="existing_warranty_size[]" value="{{ $warranty->warranty_size }}"
                            required
                            class="block w-full text-sm border-gray-300 rounded-lg dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600 p-2" />


                        <input type="number" step="0.01" name="existing_price[]" value="{{ $warranty->price }}"
                            required
                            class="block w-full text-sm border-gray-300 rounded-lg dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600 p-2" />

                        <button type="button"
                            class="removeWarranty text-white bg-red-500 hover:bg-red-600 rounded-full text-sm px-4 py-2">
                            Remove
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('product.index') }}"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-200 focus:ring-4 dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2">
                {{ __('Cancel') }}
            </a>
            <button type="submit"
                class="text-white border bg-orange-500 hover:bg-orange-600 focus:outline-none  focus:ring-4 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2">
                {{ __('Update') }}
            </button>
        </div>
    </form>

    @pushOnce('scripts')
        <script>
            // Add new warranty
            document.getElementById('addWarranty').addEventListener('click', function() {
                const container = document.getElementById('warrantyContainer');
                const item = document.createElement('div');
                item.classList.add('grid', 'md:grid-cols-4', 'gap-2', 'items-center', 'border', 'p-3', 'rounded-lg',
                    'dark:border-gray-600');

                item.innerHTML = `
            <select name="warranty_coverage[]" required
                class="block w-full text-sm border-gray-300 rounded-lg dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600 p-2">
                <option value="Day">Day</option>
                <option value="Month" selected>Month</option>
                <option value="Year">Year</option>
            </select>

            <input type="number" name="warranty_size[]" placeholder="Size" required
                class="block w-full text-sm border-gray-300 rounded-lg dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600 p-2" />
           
            <input type="number" step="0.01" name="price[]" placeholder="Price" required
                class="block w-full text-sm border-gray-300 rounded-lg dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600 p-2" />
            <button type="button"
                class="removeWarranty text-white bg-red-500 hover:bg-red-600 rounded-full text-sm px-4 py-2">Remove</button>
        `;
                container.appendChild(item);
            });

            // Remove warranty row
            document.getElementById('warrantyContainer').addEventListener('click', function(e) {
                if (e.target.classList.contains('removeWarranty')) {
                    e.target.closest('div').remove();
                }
            });

            // Track removed images
            let removedImages = [];
            document.querySelectorAll('.removeImage').forEach(button => {
                button.addEventListener('click', function() {
                    removedImages.push(this.getAttribute('data-path'));
                    document.getElementById('removed_images').value = JSON.stringify(removedImages);
                    this.closest('div').remove();
                });
            });
        </script>
    @endPushOnce

</x-app-layout>
