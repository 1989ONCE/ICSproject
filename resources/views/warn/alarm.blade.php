<x-app-layout>
    <form method="POST" action="{{ route('alarms.store') }}">
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
            <x-text-input id="number" class="block mt-1 w-full" type="text" name="number" placeholder="alarm_number"  />
            
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
    </form>
 </x-app-layout>