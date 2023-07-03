@section('title', '告警管理')
<x-app-layout>

    <x-slot name="scripts">
    <script>
	function showCheckbox(type) {
	// 隱藏所有複選框
	document.getElementById("personal-checkbox").style.display = "none";
	document.getElementById("group-checkbox").style.display = "none";

	// 顯示所選選項的複選框
	if (type === "personal") {
		document.getElementById("personal-checkbox").style.display = "block";
	} else if (type === "group") {
		document.getElementById("group-checkbox").style.display = "block";
	}
	}
</script>
    </x-slot>

    <div class="flex flex-row">
        @include('warn.partials.sidebar')
        <!-- Main content -->
        <main class="mx-[250px] mt-10 w-9/12">
        <div class="container mx-auto py-8">
			<h1 class="text-4xl font-bold mb-6 text-center">修改水質告警條件</h1>

			<!--
			<div class="bg-sky-200 w-28 p-1 m-1 rounded-full">
                <span class="font-normal text-sky-900 text-base flex justify-center underline underline-offset-2 hover:text-gray-500">{{$alarm->alarm_num}} </span>
                            
            </div>
			-->
		
		<form class="max-w-4xl mx-auto bg-gray-700 p-8 rounded-md shadow-md" method="POST" action="{{ route('warn.update',['id'=>$alarm->alarm_id]) }}">
        @csrf
		@method('patch')
        <x-slot name="scripts"></x-slot>
        

        <div class="mb-4">
            <select id="type" name="type" class="bg-white border border-gray-300 text-gray-600 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>{{$alarm->alarm_type}}</option>
                    <option value="冷卻塔_ph值"> 冷卻塔_ph值 </option>
                    <option value="快混槽1_ph值"> 快混槽1_ph值 </option>  
                    <option value="快混槽2_ph值"> 快混槽2_ph值 </option>
                    <option value="放流槽_ph值"> 放流槽_ph值 </option>
                    <option value="放流槽_水溫"> 放流槽_水溫 </option>
                    <option value="放流槽_導電度"> 放流槽_導電度 </option>
                    <option value="放流槽_COD"> 放流槽_COD </option>    
            </select>
            
        </div>

        <div class="mb-4">
            <select id="operator" name="operator" class="bg-white border border-gray-300 text-gray-600 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>{{$alarm->operator}}</option>
                    <option value=">"> > </option>
                    <option value="="> = </option>  
                    <option value="<"> < </option>    
            </select>
            
        </div>

        <div class="mb-4">
            <input id="number" value = {{$alarm->alarm_num}} class="block mt-1 w-full" type="text" name="number" placeholder={{$alarm->alarm_num}}  >
            
        </div>

  
        
        <div class="mb-4">
            <select id="notify" name="notify" class="bg-white border border-gray-300 text-gray-600 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>
                        @if($alarm->fk_notify_id==1)
                                Email
                        @elseif($alarm->fk_notify_id==2)
                                Line
                        @else
                                全選
                        @endif
                    </option>
                    <option value=1> Email </option>
                    <option value=2> Line </option> 
                    <option value=3> 全選 </option>  
            </select>
            
        </div>

        <div class="action">
            
            <button type="submit" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">修改</button>

        </div>
    	<!--</form>-->




			
		</div>

        </main>
        
        <div class="flex justify-end">
            @include('warn.partials.r-sidebar')
        </div>
        
    </div>
</form>
</x-app-layout>