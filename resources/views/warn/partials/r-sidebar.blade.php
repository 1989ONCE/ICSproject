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
<!-- Sidebar -->
<aside class="h-screen fixed top-16 overflow-y-auto bg-gray-600 text-gray-100 flex flex-col w-[210px] border-gray-100 border-r-2">
<div class="flex flex-col justify-between flex-1 mt-6">
<nav class="flex w-72 h-full ">
		<!--	  <nav class="-mx-3 space-y-6"> -->
				<div class="flex flex-col">
				  <label class="inline-flex items-center mt-3 ml-2 ">
					<div class="flex flex-col">
					<span class="text-white ml-10 mb-2"><font size="4">請選擇告警對象</font></span>
					<div class="flex flex-row search-container">
					  <input type="text" placeholder="搜尋告警對象..." class="search-input rounded">
					</div>
					<div class="py-1"></div>
					<div class="flex justify-end">
					  <button class="px-4 py-1 text-black transition ease-in duration-200 uppercase rounded-full hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none bg-gray-400"type="button">搜尋</button>
					</div>
					<div class="py-1"></div>
					<div class="flex items-center">
					<button type="button" onclick="showCheckbox('personal')" class="w-18 px-2 py-1 text-base font-medium text-black bg-white border-t border-b border-l rounded-l-md hover:bg-gray-100">
						個人
					</button>
					
					<button type="button" onclick="showCheckbox('group')" class="w-18 px-2 py-1 text-base font-medium text-black bg-white border rounded-r-md hover:bg-gray-100">
						群組
					</button>
					</div>
					<!--
					<div>
						<button class="bg-violet-400 text-black font-bold py-1 px-2 border border-white-500 rounded"type="button"onclick="showCheckbox('personal')">個人</button>
						
						<button class="ml-2 bg-amber-400 text-black font-bold py-1 px-2 border border-white-500 rounded"type="button" onclick="showCheckbox('group')">群組</button>
					</div>
					-->
					<!--
					<form  method="POST" action="{{ route('alarms.store') }}">
        			@csrf
					-->
					<div class="px-1"></div>
					<div id="personal-checkbox" style="display:block;">
                    @foreach($all_users as $key => $user)
						
						<input type="checkbox" class="form-checkbox h-5 w-5 text-white-600" name="user_id" value={{$user->id}}>
						<label class="inline-flex items-center mt-3 text-white" for="personal-1">{{$user->name}}</label>
						<br>
                    @endforeach
					  </div>
                    

					  <div id="group-checkbox" style="display:none;">
                    @foreach($all_groups as $key => $group)
						
						<input type="checkbox" class="form-checkbox h-5 w-5 text-white-600" name="group_id" value={{$group->group_id}}>
						<label class="inline-flex items-center mt-3 text-white"for="group-1">{{$group->group_name}}</label>
						<br>
                    @endforeach
					  </div>
					  <div class="py-1"></div>
					<!--<div class="action">

            			<button type="submit" class="px-3 py-1 rounded bg-gray-200 text-black font-bold hover:bg-gray-300">新增</button>

        			</div>
					 </form> -->
				  </label>
				</div>
			  </nav>
			</div>
</aside>