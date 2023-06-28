<x-slot name="scripts"></x-slot>
<!-- Sidebar -->
<aside class="h-screen overflow-y-auto pb-16 fixed top-16 overflow-y-auto bg-gray-600 text-gray-100 flex flex-col w-[210px] border-gray-100 border-r-2">
    <!-- Sidebar header -->
        <div class="flex items-center justify-center h-14 border-b border-gray-700">
            <span id="sidebar-header" class="font-semibold text-xl tracking-tight border-b-2 border-gray-200">
                @if(request()->routeIs('profile.show')) 個人資料
                @elseif(request()->routeIs('profile.edit')) 更新資料
                @else 群組管理
                @endif 
            </span>
        </div>
    <!-- User profile -->
        <div class="flex items-center my-8 px-4">
            @if($user->avatar == null)
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            @else
                <img class="w-20 h-20 rounded-full" src="/avatars/{{ Auth::user()->avatar }}" alt="tailwind logo" class="rounded-xl" />
            @endif  
            <div class="ml-4">
                <div class="w-20 break-words text-lg font-medium text-gray-100 hover:text-sky-500 hover:underline underline-offset-2"><a href="{{route('profile.show')}}">{{$user->name}}</a></div>
                <div class="text-xs font-medium text-gray-100 hover:text-sky-500 hover:underline underline-offset-2"><a href="{{route('profile.group')}}">Admin</a></div>
            </div>
        </div>

    <!-- Navigation links -->
        <a href="{{route('profile.show')}}" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300 @if(request()->routeIs('profile.show')) active bg-gray-400 text-indigo-950 font-medium border-l-4 border-gray-100 else '' @endif ">              
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
        </svg>

        個人資料
        </a>
        <a href="{{route('profile.edit')}}" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300 @if(request()->routeIs('profile.edit')) active bg-gray-400 text-indigo-950 font-medium border-l-4 border-gray-100 else '' @endif ">              
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
        </svg>
        更新資料
        </a>
        <a href="{{route('profile.group')}}" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300 @if(request()->routeIs('profile.group')) active bg-gray-400 text-indigo-950 font-medium border-l-4 border-gray-100 else '' @endif ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
        </svg>
            告警群組設定
        </a>
        <a href="{{route('logout')}}" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
        </svg>
        登出
        </a>
</aside>