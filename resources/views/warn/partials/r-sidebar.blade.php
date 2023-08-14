<x-slot name="scripts">
	<script>
		function block(group_id) {
			let div = document.getElementById("button_" + group_id);
			let svg = document.getElementById("svg_" + group_id);
			let checkboxes = document.querySelectorAll(`[id^='user_${group_id}']`)

			if (div.hasAttribute("disabled")) {
				div.removeAttribute('disabled');
				svg.classList.remove('hidden');
			}
			else{
				div.setAttribute('disabled', '');
				svg.classList.add('hidden');
				for(var i in checkboxes) 
					checkboxes[i].checked = false;
			}
		}

		function toggle(source) {
			if(Number.isInteger(source)){
				block(source);
			}
		}
		
	</script>
</x-slot>
<!-- Sidebar -->
<aside class="h-screen pt-16 fixed overflow-y-auto overflow-x-hidden text-gray-900 pl-24">
	<div class="flex flex-col">
		<nav class="flex w-full rounded-lg border border-gray-300 shadow overflow-x-hidden">
			<div class="flex flex-col pb-4">
				<!-- select all checkboxes -->
				<div class="w-[215px] flex flex-row bg-[#c3e3f7] py-2">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="translate-x-2 w-6 h-6">
						<path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" />
						<path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
					</svg>
					<span class="pl-1 translate-x-2">告警對象選擇(optional)</span>
				</div>
				@foreach($all_groups as $key => $group)
					<div class="block pl-6 pt-2 flex items-center">
						<input id="{{$group->group_id}}" name="group_id[]" type="checkbox" onClick="toggle({{$group->group_id}})" class="form-checkbox h-5 w-5 text-[#6da9cf] rounded-full foucus:ring-0 " value="{{$group->group_id}}">
						<button id="button_{{$group->group_id}}" data-dropdown-toggle="dropdownDefaultCheckbox_{{$group->group_id}}" class="pl-2 text-gray-900 font-medium rounded-lg text-base px text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
							{{$group->group_name}}
							<svg id="svg_{{$group->group_id}}" class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
							</svg>
						</button>
					</div>
					<!-- Dropdown menu -->
					<div id="dropdownDefaultCheckbox_{{$group->group_id}}" class="z-10 hidden overflow-y-auto w-48 bg-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
						<ul class="p-3 text-base text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCheckboxButton">
							@php $count = 0; @endphp
								@for($i = 0; $i < count($all_users); $i++)
									@if($all_users[$i]->fk_group_id == $group->group_id)
										@php $count = 1; @endphp
									@endif
								@endfor

								@if($count == 1)
									@foreach($all_users as $key => $user)
										@if($user->fk_group_id == $group->group_id)
											<li>
												<input id="user_{{$group->group_id}}_{{$user->id}}" type="checkbox" name="user_id[]" class="translate-x-4 w-4 h-4 text-[#6da9cf] bg-gray-100 rounded-full focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" value="{{$user->id}}" >
													<label for="user_{{$group->group_id}}_{{$user->id}}" class="translate-x-4 inline-flex items-center text-black">{{$user->name}}</label>
													<br>
											</li>
										@endif
									@endforeach
								@else
									<li>
									    <span class="text-sm">此職位目前沒有任何員工</span>
									</li>		
								@endif
						</ul>
					</div>
				@endforeach
			</div>
		</nav>
	</div>
</aside>