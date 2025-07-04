<x-app-layout>
    <x-head-label backhref="{{ route('product.index') }}">
        {{ __('Product Show') }}
    </x-head-label>

    <div class="rounded-lg p-5 bg-white dark:text-white dark:bg-gray-800">
        <div class="grid md:grid-cols-2 gap-4">
            <!-- name -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" type="text" :value="old('name', $product->name)"
                    class="block mt-1 w-full dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600" disabled />
            </div>

            <!-- is_active -->
            <div class="mt-4">
                <x-input-label for="is_active" :value="__('Is Active')" />
                <x-text-input id="is_active" class="block mt-1 w-full" type="text" name="status" :value="old('is_active', $product->is_active == 1 ? 'true' : 'false')"
                    disabled />
            </div>

            <!-- Image -->
            <div class="mt-4 col-span-2">
                <x-input-label for="images" :value="__('Images (*) multiple')" />
                @if ($product->image_urls)
                    <div class="grid md:grid-cols-6 grid-cols-3 gap-4 my-4">
                        @foreach ($product->image_urls as $url)
                            <div class="relative w-full">
                                <img src="{{ asset($url) }}" alt="img" class="rounded border">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <h3 class="text-lg font-medium mb-4">Warranties</h3>

            <div class="overflow-x-auto rounded-lg border dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Coverage</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Size</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Price (₹)</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($product->warranties as $warranty)
                            <tr class="bg-white dark:bg-gray-800">
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $warranty->warranty_coverage }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    {{ $warranty->warranty_size }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                    ₹{{ number_format($warranty->price, 2) }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if ($warranty->is_active)
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">Active</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-600 dark:text-gray-400">No
                                    warranties available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
