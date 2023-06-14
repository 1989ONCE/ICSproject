<x-slot name="scripts"></x-slot>
<!-- Sidebar -->
<aside class="h-screen fixed top-16 overflow-y-auto bg-gray-600 text-gray-100 flex flex-col w-[210px] border-gray-100 border-r-2">
    <!-- Sidebar header -->
        <div class="flex items-center justify-center h-14 border-b border-gray-700">
            <span id="sidebar-header" class="font-semibold text-xl tracking-tight border-b-2 border-gray-200">
                @if(request()->routeIs('warning')) 水質告警
                <!-- @elseif(request()->routeIs('profile.edit')) 更新資料
                @else 群組管理
                @endif  -->
            </span>
        </div>

    <!-- Navigation links -->
        <a href="{{route('warning')}}" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300 @if(request()->routeIs('profile.show')) active bg-gray-400 text-indigo-950 font-medium border-l-4 border-gray-100 else '' @endif ">              
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
		    	<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
            </svg>    
             水質告警
        </a>
        <a href="#" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300 @if(request()->routeIs('profile.edit')) active bg-gray-400 text-indigo-950 font-medium border-l-4 border-gray-100 else '' @endif ">              
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
				<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
			</svg>
             斷電斷訊紀錄表
        </a>
        <a href="#" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300 @if(request()->routeIs('profile.group')) active bg-gray-400 text-indigo-950 font-medium border-l-4 border-gray-100 else '' @endif ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
				<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
			</svg>
             編輯告警設定
        </a>
</aside>