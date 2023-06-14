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
			<h1 class="text-4xl font-bold mb-6 text-center">設定水值告警條件</h1>
			<form class="max-w-4xl mx-auto bg-gray-700 p-8 rounded-md shadow-md">
			  <div class="mb-4">
				<label class="block text-white text-sm font-bold mb-2" for="name">告警名稱   ：</label>
				<input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
				  type="text" id="name" name="name">
			  </div>
			  <div class="mb-4">
				<label class="block text-white text-sm font-bold mb-2" for="name">告警條件 1：</label>
				<input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
				  type="text" id="name" name="name">
			  </div>
			  <div class="mb-4">
				<label class="block text-white text-sm font-bold mb-2" for="name">告警條件 2：</label>
				<input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
				  type="text" id="name" name="name">
			  </div>
			  <div class="mb-4">
				<label class="block text-white text-sm font-bold mb-2" for="name">告警條件 3：</label>
				<input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
				  type="text" id="name" name="name">
			  </div>
			  <div class="mb-4">
				<label class="block text-white text-sm font-bold mb-2" for="name">告警條件 4：</label>
				<input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
				  type="text" id="name" name="name">
			  </div>
			  <div class="mb-4">
				<label class="block text-white text-sm font-bold mb-2" for="name">告警條件 5：</label>
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
		  </div>
        </main>
        <div class="flex justify-end">
            @include('warn.partials.r-sidebar')
        </div>
    </div>
</x-app-layout>