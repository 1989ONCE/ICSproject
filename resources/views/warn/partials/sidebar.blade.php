<!-- Sidebar -->
<aside class="border-b-4 border-sky-600 top-0 xl:top-16 xl:border-b-0 mx-2 h-24 xl:h-screen xl:fixed overflow-y-auto text-gray-900 flex flex-row xl:flex-col w-fit xl:w-[210px]">
    <div class="py-8"></div>
    <!-- Navigation links -->
        <a href="{{route('warning')}}" class="flex items-center py-2 px-4 font-normal text-gray-900 text-sm hover:bg-gray-100 hover:border-b-4 xl:hover:border-b-0 xl:hover:border-l-4 hover:border-sky-400 hover:rounded-r-lg @if(request()->routeIs('warning'))) active text-indigo-950 font-medium bg-gray-200 rounded-r-lg border-b-4 xl:border-b-0 xl:border-l-4 border-sky-600 else '' @endif ">              
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
        </svg>
             新增告警
        </a>
        <a href="{{route('warning.check')}}" class="flex items-center py-2 px-4 font-normal text-gray-900 text-sm hover:bg-gray-100 hover:border-b-4 xl:hover:border-b-0 xl:hover:border-l-4 hover:border-sky-400 hover:rounded-r-lg @if(request()->routeIs('warning.check') || request()->routeIs('warning.edit')) active text-indigo-950 font-medium bg-gray-200 rounded-r-lg border-b-4 xl:border-b-0 xl:border-l-4 border-sky-600 else '' @endif ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
        </svg>
             告警列表
        </a>
        <a href="{{route('warning.group')}}" class="flex items-center py-2 px-4 font-normal text-gray-900 text-sm hover:bg-gray-100 hover:border-b-4 xl:hover:border-b-0 xl:hover:border-l-4 hover:border-sky-400 hover:rounded-r-lg @if(request()->routeIs('warning.group') || request()->routeIs('add')) active text-indigo-950 font-medium bg-gray-200 rounded-r-lg border-b-4 xl:border-b-0 xl:border-l-4 border-sky-600 else '' @endif ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
        </svg>
            告警人員列表
        </a>
        <a href="{{route('status')}}" class="flex items-center py-2 px-4 font-normal text-gray-900 text-sm hover:bg-gray-100 hover:border-b-4 xl:hover:border-b-0 xl:hover:border-l-4 hover:border-sky-400 hover:rounded-r-lg @if(request()->routeIs('status')) active text-indigo-950 font-medium bg-gray-200 rounded-r-lg border-b-4 xl:border-b-0 xl:border-l-4 border-sky-600 else '' @endif ">              
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
				<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
			</svg>
             斷電斷訊紀錄表
        </a>
</aside>
<x-slot name="scripts"></x-slot>