@props(['href' => '#', 'backhref' => '#'])

<div
    class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex justify-between items-center p-3 my-3 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
    <div class="text-gray-900 text-lg font-bold  dark:text-white">
        @if ($backhref != '#')
            <a href="{{ $backhref }}"
                class="px-3 py-2 text-white rounded-full hover:bg-blue-900 me-4">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        @endif
        {{ $slot }}
    </div>
    @if ($href != '#')
        <a href="{{ $href }}" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Add
        </a>
    @endif
</div>
