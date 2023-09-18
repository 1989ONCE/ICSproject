<x-slot name="scripts"></x-slot>
<!-- Sidebar -->
<aside class="min-w-fit border-b-4 border-sky-600 top-0 xl:top-16 xl:border-b-0 mx-2 h-fit xl:h-screen xl:fixed overflow-y-auto text-gray-900 flex flex-col items-center xl:items-start w-fit xl:w-[210px]">
    <div class="py-2"></div>
    <div>
    <!-- User profile -->
        <div class="flex items-center mb-8 px-4">
            @if($user->avatar == null)
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            @else
                <img class="w-20 h-20 rounded-full" src="/avatars/{{ Auth::user()->avatar }}" alt="tailwind logo" class="rounded-xl" />
            @endif  
            <div class="ml-4">
                <div class="w-20 break-words text-lg font-medium text-gray-800 hover:text-sky-500 hover:underline underline-offset-2"><a href="{{route('profile.show')}}">{{$user->name}}</a></div>
                <div class="text-xs font-medium text-gray-800 hover:text-sky-500 hover:underline underline-offset-2"><a href="{{route('admin.allUser')}}">{{$user->getRoleNames()[0]}}</a></div>
            </div>
        </div>
    </div>
    <div class="flex flex-row xl:flex-col">
    <!-- Navigation links -->
        <a href="{{route('profile.show')}}" class="flex items-center py-2 px-4 font-normal text-gray-900 text-xl hover:bg-gray-100 hover:border-l-4 hover:border-sky-400 hover:rounded-r-lg @if(request()->routeIs('profile.show')) active text-indigo-950 font-medium bg-gray-200 rounded-r-lg border-b-4 xl:border-b-0 xl:border-l-4 border-sky-600 else '' @endif ">              
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
        </svg>

        個人資料
        </a>
        <a href="{{route('profile.edit')}}" class="flex items-center py-2 px-4 font-normal text-gray-900 text-xl hover:bg-gray-100 hover:border-l-4 hover:border-sky-400 hover:rounded-r-lg @if(request()->routeIs('profile.edit')) active text-indigo-950 font-medium bg-gray-200 rounded-r-lg border-b-4 xl:border-b-0 xl:border-l-4 border-sky-600 else '' @endif ">              
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
        </svg>
        更新資料
        </a>
        
        <div class="flex flex-row items-center h-8 @if($user->getRoleNames()[0] != 'Admin') hidden else '' @endif">
            <div class="text-sm font-light tracking-wide text-gray-500">管理員專區</div>
        </div>

        <a href="{{route('admin.allUser')}}" class="flex items-center py-2 px-4 font-normal text-gray-900 text-xl hover:bg-gray-100 hover:border-l-4 hover:border-sky-400 hover:rounded-r-lg @if(request()->routeIs('admin.allUser') || request()->routeIs('admin.edit')) active text-indigo-950 font-medium bg-gray-200 rounded-r-lg border-b-4 xl:border-b-0 xl:border-l-4 border-sky-600 else '' @endif @if($user->getRoleNames()[0] != 'Admin') hidden else '' @endif">              
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 01-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 11-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 016.336-4.486l-3.276 3.276a3.004 3.004 0 002.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008z" />
        </svg>
        人員管理
        </a>

        <a href="{{route('admin.model')}}" class="flex items-center py-2 px-4 font-normal text-gray-900 text-xl hover:bg-gray-100 hover:border-l-4 hover:border-sky-400 hover:rounded-r-lg @if(request()->routeIs('admin.model')) active text-indigo-950 font-medium bg-gray-200 rounded-r-lg border-b-4 xl:border-b-0 xl:border-l-4 border-sky-600 else '' @endif @if($user->getRoleNames()[0] != 'Admin') hidden else '' @endif">              
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6.75v10.5a2.25 2.25 0 002.25 2.25zm.75-12h9v9h-9v-9z" />
        </svg>
        模型設定
        </a>

        <a href="{{route('logout')}}" class="flex items-center py-2 px-4 font-normal text-gray-900 text-xl hover:bg-gray-100 hover:border-l-4 hover:border-sky-400 hover:rounded-r-lg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
        </svg>
        登出
        </a>
    </div>
</aside>