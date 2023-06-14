<x-slot name="scripts"></x-slot>
<!-- Sidebar -->
<aside class="h-screen fixed top-16 overflow-y-auto bg-gray-600 text-gray-100 flex flex-col w-[210px] border-gray-100 border-r-2">
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
            <img class="h-16 w-16 rounded-full object-cover border border-gray-300" src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80">
            <div class="ml-4">
                <div class="text-xl font-medium text-gray-100 hover:text-sky-500 hover:underline underline-offset-2"><a href="{{route('profile.show')}}">{{$user->name}}</a></div>
                <div class="text-xs font-medium text-gray-100 hover:text-sky-500 hover:underline underline-offset-2"><a href="{{route('profile.group')}}">Admin</a></div>
            </div>
        </div>

    <!-- Navigation links -->
        <a href="{{route('profile.show')}}" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300 @if(request()->routeIs('profile.show')) active bg-gray-400 text-indigo-950 font-medium border-l-4 border-gray-100 else '' @endif ">              
            個人資料
        </a>
        <a href="{{route('profile.edit')}}" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300 @if(request()->routeIs('profile.edit')) active bg-gray-400 text-indigo-950 font-medium border-l-4 border-gray-100 else '' @endif ">              
            更新資料
        </a>
        <a href="{{route('profile.group')}}" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300 @if(request()->routeIs('profile.group')) active bg-gray-400 text-indigo-950 font-medium border-l-4 border-gray-100 else '' @endif ">
            告警群組設定
        </a>
        <a href="{{route('logout')}}" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300">
            登出
        </a>
</aside>