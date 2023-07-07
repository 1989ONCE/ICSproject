
@section('title', '告警列表')
<x-app-layout>
    <div class="flex flex-row">
        @include('warn.partials.sidebar')
        <!-- Main content -->
        <main class="mx-[250px] mt-2 w-9/12">
            <div class="container max-w-4xl px-4 mx-auto sm:px-8">
                <div class="pt-2">
                    <div class="flex flex-row justify-between w-full mb-1 sm:mb-0">
                        <h2 class="text-3xl font-bold leading-tight">
                            告警列表
                        </h2>
                        <div class="flex flex-row justify-end">
                            <div class="place-self-end">
                                <a href="{{ route('warning.check')}}" class="bg-white w-[80px] flex flex-row font-semibold text-gray-800 rounded-lg hover:underline underline-offset-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm">取消過濾
                                </a>
                            </div>
                            <form method="get" action="{{ route('warn.search')}}" class="px w-3/4 max-w-sm space-y-3 md:flex-row md:w-full md:space-x-3 md:space-y-0">
                                <div class="relative ">
                                    <select id="text" name="search" onchange='this.form.submit()' class="bg-white border border-gray-300 text-gray-600 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" {{$search == "" ? 'selected="selected"' : '' }}>選擇目標</option>
                                    <option value="冷卻塔_ph值" {{$search == '冷卻塔_ph值' ? 'selected="selected"' : '' }} > 冷卻塔_ph值 </option>
                                    <option value="快混槽1_ph值" {{$search == '快混槽1_ph值' ? 'selected="selected"' : '' }}> 快混槽1_ph值 </option>  
                                    <option value="快混槽2_ph值" {{$search == '快混槽2_ph值' ? 'selected="selected"' : '' }}> 快混槽2_ph值 </option>
                                    <option value="放流槽_ph值" {{$search == '放流槽_ph值' ? 'selected="selected"' : '' }}> 放流槽_ph值 </option>
                                    <option value="放流槽_水溫" {{$search == '放流槽_水溫' ? 'selected="selected"' : '' }}> 放流槽_水溫 </option>
                                    <option value="放流槽_導電度" {{$search == '放流槽_導電度' ? 'selected="selected"' : '' }}> 放流槽_導電度 </option>
                                    <option value="放流槽_COD" {{$search == '放流槽_COD' ? 'selected="selected"' : '' }}> 放流槽_COD </option>   
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="flex flex-col justify-center px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
                        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr class="items-center">
                                        <th scope="col" class="px-5 py-3 text-lg font-normal text-left text-gray-800 uppercase bg-[#c3e3f7] border-b border-gray-200">
                                            目標
                                        </th>
                                        <th scope="col" class="px-5 py-3 text-lg font-normal text-center text-gray-800 uppercase bg-[#c3e3f7] border-b border-gray-200">
                                            運算子
                                        </th>
                                        <th scope="col" class="px-5 py-3 text-lg font-normal text-center text-gray-800 uppercase bg-[#c3e3f7] border-b border-gray-200">
                                            數值
                                        </th>
                                        <th scope="col" class="px-5 py-3 text-lg font-normal text-center text-gray-800 uppercase bg-[#c3e3f7] border-b border-gray-200">
                                            通知方式
                                        </th>
                                        <th scope="col" class="px-5 py-3 text-lg font-normal text-left text-gray-800 uppercase bg-[#c3e3f7] border-b border-gray-200">
                                        </th>
                                        <th scope="col" class="px-5 py-3 text-lg font-normal text-left text-gray-800 uppercase bg-[#c3e3f7] border-b border-gray-200">
                                        </th>
                                    </tr>
                                </thead>
                                @if(count($alarms) == 0)
                                <tbody>
                                    <tr class="bg-white hover:bg-gray-100">
                                        <td class="px-5 py-5 text-base border-b border-gray-200"><div class="flex items-center">
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    查無資料
                                                </p>
                                            </div>
                                        </div></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                @else
                                @foreach($alarms as $alarm)   
                                <tbody>
                                    <tr class="bg-white hover:bg-gray-100">
                                        <td class="px-5 py-5 text-base border-b border-gray-200">
                                            <div class="flex items-center">
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{$alarm->alarm_name}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 text-base border-b border-gray-200">
                                            <p class="text-gray-900 whitespace-no-wrap text-center">
                                                        @if($alarm->operator===">")
                                                            大於
                                                        @elseif($alarm->operator==="=")
                                                            等於
                                                        @else
                                                            小於
                                                        @endif
                                                
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 text-base border-b border-gray-200">
                                            <p class="text-gray-900 whitespace-no-wrap text-center">
                                                {{$alarm->alarm_num}}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 text-sm border-b border-gray-200 flex justify-center">
                                            @if($alarm->fk_notify_id==1)
                                                @foreach($notifys as $notify)
                                                    @if($notify->notify_id != 1)
                                                        <span class="inline-block w-fit font-semibold leading-tight text-orange-900 px-1">
                                                            <span class="text-base inset-0 px-2 py bg-orange-200 rounded-full opacity-50">
                                                                {{$notify->method}}     
                                                            </span>
                                                        </span>
                                                    @endif
                                                @endforeach
                                            @elseif($alarm->fk_notify_id==2)
                                                <span class="inline-block w-fit font-semibold leading-tight text-black">
                                                    <span class="text-base inset-0 px-2 py bg-sky-200 rounded-full opacity-50">
                                                        Email    
                                                    </span>
                                                </span>
                                            @else
                                            <span class="inline-block w-fit font-semibold leading-tight text-green-900">
                                                <span class="text-base inset-0 px-2 py bg-green-200 rounded-full opacity-50">
                                                    LINE   
                                                </span>
                                            </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-5 text-base border-b border-gray-200">
                                            <a href="{{ route('warning.edit',['id'=>$alarm->alarm_id])}}" class="text-indigo-600 hover:text-indigo-900">
                                                編輯
                                            </a>
                                        </td>
                                        <td class="px-5 py-5 text-base border-b border-gray-200">
                                            <form action="{{ route('warn.destroy',['id'=>$alarm->alarm_id])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="text-red-600 hover:text-red-900">刪除</button>
                                            </form>
                                        </td>
                                    </tr>

                                </tbody>
                                @endforeach
                            </table>
                            <div class="flex flex-col items-center px-5 py-2 bg-white xs:flex-row xs:justify-between">
                                {{$alarms->links()}}
                            </div>
                            @endif 
                       </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
