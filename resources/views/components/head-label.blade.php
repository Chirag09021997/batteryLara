@props(['href' => '#', 'backhref' => '#'])

<div
    class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex justify-between items-center p-3 my-3 dark:text-gray-400 focus:outline-none dark:bg-gray-800 dark:border-gray-800 dark:placeholder-gray-400">
    <div class="text-gray-900 text-lg font-bold  dark:text-white">
        {{-- @if ($backhref != '#')
        <a href="{{ $backhref }}" class="inline-flex items-center px-3 py-2 text-white rounded-full hover:bg-blue-900 me-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-5 h-5 text-white">
                <path
                    d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
            </svg>
        </a>        
        @endif --}}
        {{ $slot }}
    </div>
    @if ($href != '#')
        <a href="{{ $href }}" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Add
        </a>
    @endif
</div>
