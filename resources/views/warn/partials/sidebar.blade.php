<x-slot name="scripts"></x-slot>
<!-- Sidebar -->
<aside class="h-screen fixed top-16 overflow-y-auto bg-gray-500 text-gray-100 flex flex-col w-[210px] border-gray-100 border-r-2">
    <!-- Sidebar header -->
        <div class="flex items-center justify-center h-14 border-b border-gray-700">
            <span id="sidebar-header" class="font-semibold text-xl tracking-tight border-b-2 border-gray-200">
                @if(request()->routeIs('warning')) 新增告警
                @elseif(request()->routeIs('status')) 斷電斷訊紀錄表
                @elseif(request()->routeIs('warning.check')) 告警列表
                @else 修改告警條件
                @endif 
            </span>
        </div>

    <!-- Navigation links -->
        <a href="{{route('warning')}}" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300 @if(request()->routeIs('warning')) active bg-gray-400 text-indigo-950 font-medium else '' @endif ">              
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
        </svg>
             新增告警
        </a>
        <a href="{{route('warning.check')}}" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300 @if(request()->routeIs('warning.check')) active bg-gray-400 text-indigo-950 font-medium else '' @endif ">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
        </svg>
             告警列表
        </a>
        <a href="{{route('status')}}" class="flex items-center py-2 px-4 font-normal text-gray-100 text-xl hover:text-sky-500 hover:underline underline-offset-2 hover:bg-gray-300 hover:border-r-2 hover:border-gray-300 @if(request()->routeIs('status')) active bg-gray-400 text-indigo-950 font-medium else '' @endif ">              
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
				<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
			</svg>
             斷電斷訊紀錄表
        </a>
</aside>