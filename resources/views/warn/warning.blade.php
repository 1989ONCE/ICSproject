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

  <div class="flex flex-row ">
        @include('warn.partials.sidebar')
        <!-- Main content -->
      <main class="mx-[250px] mt-10 w-9/12">
        <div class="container mx-auto py-8">
			    <h1 class="text-4xl font-bold mb-6 text-center">設定水質告警條件</h1>
          <!--
          <form class="max-w-4xl mx-auto bg-gray-700 p-8 rounded-md shadow-md">
            <div class="mb-4">
            <label class="block text-white text-sm font-bold mb-2" for="name">告警名稱   ：</label>
            <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
              type="text" id="name" name="name">
            </div>
            <div class="mb-4">
            <label class="block text-white text-sm font-bold mb-2" for="name">告警條件 ：</label>
            <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
              type="text" id="name" name="name">
            </div>
            
            <div class="flex justify-between">
            <button
              class="w-64 bg-red-500 text-white text-sm font-bold py-1 px-2 rounded-md hover:bg-red-200 transition duration-300"
              type="cancel">取消</button>
            <button
              class="w-64 bg-green-500 text-white text-sm font-bold py-1 px-2 rounded-md hover:bg-green-200 transition duration-300"
              type="submit">送出</button>
            </div>
          </form>
          
          -->
          <form class="max-w-4xl mx-auto bg-gray-700 p-8 rounded-md shadow-md" method="POST" action="{{ route('alarms.store') }}">
            @csrf
            <x-slot name="scripts"></x-slot>
            

            <div class="mb-4">
                <select id="type" name="type" class="bg-white border border-gray-300 text-gray-600 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>選擇類別</option>
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
                        <option selected>選擇operator</option>
                        <option value=">"> > </option>
                        <option value="="> = </option>  
                        <option value="<"> < </option>    
                </select>
                
            </div>

            <div class="mb-4">
                <x-text-input id="number" class="block mt-1 w-full" type="text" name="number" placeholder="輸入數值"  />
                
            </div>

  
        
            <div class="mb-4">
                <select id="notify" name="notify" class="bg-white border border-gray-300 text-gray-600 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>選擇通知方式</option>
                        <option value=1> Email </option>
                        <option value=2> Line </option> 
                        <option value=3> 全選 </option>  
                </select>
                
            </div>

            <div class="action">
                
                <button type="submit" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">新增</button>

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