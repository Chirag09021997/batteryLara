<!-- Navbar -->
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <!-- Logo Section -->
                <a href="{{ route('dashboard') }}" class="flex ms-2 md:me-24">
                    <span
                        class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">{{ config('app.name') }}</span>
                </a>
                <!-- Sidebar Toggle Button -->
                <button @click="sidebarOpen = !sidebarOpen"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg  hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
            </div>
            <!-- User Profile Dropdown -->
            <div class="relative flex items-center ms-3">
                <div class="flex items-center space-x-2 mx-4 mr-2">
                    <button
                        @click="if(document.documentElement.classList.contains('dark')) {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('darkMode', 'false');
                        } else {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('darkMode', 'true');
                        }"
                        class="flex items-center p-2 text-orange-500 rounded-lg focus:outline-none dark:focus:ring-gray-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707 8.001 8.001 0 1017.293 13.293z" />
                        </svg>
                    </button>
                </div>

                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    @click="open = !open;">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->profile ?? asset('images/avatar-1.png') }}"
                        alt="user photo">
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.outside="open = false"
                    class="absolute right-0 z-20 w-48 mt-2 top-10 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                    style="display: none;">
                    <div class="px-4 py-3">
                        <p class="text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300">
                            {{ Auth::user()->email }}</p>
                    </div>
                    <ul class="py-1">
                        <li>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600">Log
                                    Out</a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
