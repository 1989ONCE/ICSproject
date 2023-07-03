
@section('title', '告警管理')
<x-app-layout>





    <div class="flex flex-row">
        @include('warn.partials.sidebar')
        <!-- Main content -->

        
        <main class="mx-[250px] mt-10 w-9/12">

        <!--
            <div class="container mx-auto py-8">
			    <h1 class="text-4xl font-bold mb-6 text-center">編輯告警</h1>

                @foreach($alarms as $alarm)
                <div class="w-8/12 bg-white flex flex-col space-y-2 p-3">
        
                    
                    <div class="flex flex-row flex items-center ">
                        <div class="bg-sky-200 w-28 p-1 m-1 rounded-full">
                            <span class="font-normal text-sky-900 text-base flex justify-center ">{{$alarm->alarm_name}}</span>
                            
                        </div>
                        
                        <div class="flex">
                            <a class="px-2 rounded bg-sky-600 text-white" href="{{ route('warning.edit',['id'=>$alarm->alarm_id])}}" >編輯</a>

                            <div class="px-1"></div>

                            <form action="{{ route('warn.destroy',['id'=>$alarm->alarm_id])}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="px-2 rounded bg-red-600 text-white">刪除</button>
                            </form>
                        </div>
                    </div>

                    
                </div>
                @endforeach

                
            </div>
        -->

        <div class="container max-w-4xl px-4 mx-auto sm:px-8">
        <div class="py-8">
        <div class="flex flex-row justify-between w-full mb-1 sm:mb-0">
            <h2 class="text-3xl font-bold leading-tight">
                編輯告警
            </h2>
            
            <div class="text-end">
                
                <form method="get" action="{{ route('warn.search')}}" class="flex flex-col justify-center w-3/4 max-w-sm space-y-3 md:flex-row md:w-full md:space-x-3 md:space-y-0">
                    <div class=" relative ">
                        
                        <select id="text" name="search" class="bg-white border border-gray-300 text-gray-600 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>選擇目標</option>
                        <option value="冷卻塔_ph值"> 冷卻塔_ph值 </option>
                        <option value="快混槽1_ph值"> 快混槽1_ph值 </option>  
                        <option value="快混槽2_ph值"> 快混槽2_ph值 </option>
                        <option value="放流槽_ph值"> 放流槽_ph值 </option>
                        <option value="放流槽_水溫"> 放流槽_水溫 </option>
                        <option value="放流槽_導電度"> 放流槽_導電度 </option>
                        <option value="放流槽_COD"> 放流槽_COD </option>   
                        </select>
                        <!--
                        <input type="text" id="&quot;form-subscribe-Filter" name="search" value="{{isset($search) ? $search : ''}}" class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="name"/>
                        -->
                        </div>
                        <button type="submit"class="flex-shrink-0 px-4 py-2 text-base font-semibold text-white bg-purple-600 rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-purple-200" type="submit">
                            搜尋
                        </button>
                        <a href="{{ route('warning.check')}}" class="flex-shrink-0 px-4 py-3 text-base font-semibold  text-white bg-purple-600 rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-purple-200">
                            取消選取
                        </a>
                    </form>

                    
                </div>
                
            </div>
            
            <div class="flex flex-col justify-center px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
                <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th scope="col" class="px-5 py-3 text-lg font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                    目標
                                </th>
                                <th scope="col" class="px-5 py-3 text-lg font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                    運算子
                                </th>
                                <th scope="col" class="px-5 py-3 text-lg font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                    數值
                                </th>
                                <th scope="col" class="px-5 py-3 text-lg font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                    通知方式
                                </th>
                                <th scope="col" class="px-5 py-3 text-lg font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                </th>
                                <th scope="col" class="px-5 py-3 text-lg font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                </th>
                            </tr>
                        </thead>
                        @foreach($alarms as $alarm)
                            
                        <tbody>
                            <tr>
                                <td class="px-5 py-5 text-base bg-white border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{$alarm->alarm_name}}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 text-base bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                                @if($alarm->operator===">")
                                                    大於
                                                @elseif($alarm->operator==="=")
                                                    等於
                                                @else
                                                    小於
                                                @endif
                                        
                                    </p>
                                </td>
                                <td class="px-5 py-5 text-base bg-white border-b border-gray-200">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$alarm->alarm_num}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                        <span aria-hidden="true" class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                        </span>
                                        <span class="relative">
                                                @if($alarm->fk_notify_id==1)
                                                    Email
                                                @elseif($alarm->fk_notify_id==2)
                                                    Line
                                                @else
                                                    全選
                                                @endif
                                        </span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 text-base bg-white border-b border-gray-200">
                                    <a href="{{ route('warning.edit',['id'=>$alarm->alarm_id])}}" class="text-indigo-600 hover:text-indigo-900">
                                        編輯
                                    </a>
                                </td>
                                <td class="px-5 py-5 text-base bg-white border-b border-gray-200">
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
                    
                    <div class="flex flex-col items-center px-5 py-5 bg-white xs:flex-row xs:justify-between">
                    {{$alarms->links()}}
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

			
		
        </main>
		
        
    </div>
</x-app-layout>