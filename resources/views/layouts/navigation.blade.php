<nav x-data="{ open: false }" class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Navbar -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex justify-center">
                        <img src="{{ asset('img/logo.png') }}" class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->

                <div class="hidden text-center space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('rt')" :active="request()->routeIs('rt')">
                        即時資料</br>
                        Realtime Data
                    </x-nav-link>
                </div>
                <div class="hidden text-center space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('chart')" :active="request()->routeIs('chart')">
                        歷史報表</br>
                        Historical Report
                    </x-nav-link>
                </div>
                <div class="hidden text-center space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('warning')" :active="request()->routeIs('warning')">
                        告警管理</br>
                        Warning Management
                    </x-nav-link>
                </div>
                <div class="hidden text-center space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        個人中心</br>
                        Personal Info
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Navbar -->
            <div class="hidden justify-items-start sm:flex sm:items-center sm:ml-6">
                <!-- current time -->
                <div class="flex items-center justify-center bg-white text-black font-bold rounded-md">
                    <span id="clock" class="text-sm text-gray-500">現在時間: </span>
                </div>
                <script>
                    // 這裡是JavaScript代碼，用來顯示現在的時間
                    function updateTime() {
                        // 創建一個Date對象，並使用它來獲取現在的時間
                        var now = new Date();
                        var options = {
                            weekday: "long",
                            year: "numeric",
                            month: "long",
                            day: "numeric",
                            hour: "numeric",
                            minute: "numeric",
                            second: "numeric",
                        }
                        // 將時間格式化為字符串，例如："2023年3月9日 下午1:30:45"
                        var timeString = now.toLocaleString("ch-tw", options);
                        
                        // 將時間字符串更新到HTML中的元素中
                        document.getElementById("clock").innerHTML = '現在時間：' + timeString;
                    }
                    
                    // 每秒鐘更新一次時間
                    setInterval(updateTime, 1000);
                </script>

                <!-- Settings dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                             this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
