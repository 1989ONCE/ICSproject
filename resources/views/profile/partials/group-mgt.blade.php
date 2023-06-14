<div>
    @foreach($all_labels as $key => $label)
        <a href="#{{$label[0]->fk_alarm_id}}"><span class="w-24 inline-flex items-center flex jusitfy-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
            {{$label[0]->fk_alarm_id}}
        </span></a>
    @endforeach
</div>

                @foreach($all_labels as $keys => $label)
                <span id="{{$label[0]->fk_alarm_id}}" class="w-24 rounded-full bg-blue-50 px-10 py-1 text-xs font-semibold text-blue-600">{{$label[0]->fk_alarm_id}}<span>
                <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Position</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Warning Group</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                </tr>
              </thead>
                @foreach($label as $key => $l)
                <tr class="hover:bg-gray-50">
                  <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                    <div class="overflow-y-hidden h-10 w-10">
                      <img
                        class="h-full w-full rounded-full object-cover object-center"
                        src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt=""
                      />
                    </div>
                    <div class="text-sm">
                      <div class="font-medium text-gray-700">{{$l->fk_user_id}}</div>
                      <div class="text-gray-400">{{$all_users[$l->fk_user_id-1]->name}}</div>
                    </div>
                  </th>
                  <td class="px-6 py-4">
                    @foreach($groups as $key => $g)
                        @if($g->group_id == $all_users[$l->fk_user_id-1]->fk_group_id)
                            {{$g->group_name}}
                        @endif
                    @endforeach
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex gap-2">
                      <span
                        class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600"
                      >
                        Design
                      </span>
                      <span
                        class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2 py-1 text-xs font-semibold text-indigo-600"
                      >
                        Product
                      </span>
                      <span
                        class="inline-flex items-center gap-1 rounded-full bg-violet-50 px-2 py-1 text-xs font-semibold text-violet-600"
                      >
                        Develop
                      </span>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex justify-end gap-4">
                      <a x-data="{ tooltip: 'Delete' }" href="#">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                          class="h-6 w-6"
                          x-tooltip="tooltip"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                          />
                        </svg>
                      </a>
                      <a x-data="{ tooltip: 'Edite' }" href="#">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                          class="h-6 w-6"
                          x-tooltip="tooltip"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                          />
                        </svg>
                      </a>
                    </div>
                  </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            
          </div>
                @endforeach
