<div class="flex flex-col pb-10">
  <div class="flex flex-row justify-between pb-4">
    <span class="text-3xl underline underline-offet-4 text-gray-700">各告警群組人員列表</span>
    <div class="flex flex-row justify-end">
      <div class="place-self-end">
        <a href="{{ route('warning.group')}}" class="bg-white w-[80px] flex flex-row font-semibold text-gray-800 rounded-lg hover:underline underline-offset-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          <span class="text-sm">取消過濾</span>
        </a>
      </div>
      <form method="get" action="{{ route('warning.query')}}" class="place-self-end px max-w-sm space-y-3 md:flex-row md:w-full md:space-x-3 md:space-y-0">
          <div class="relative ">
            <select id="text" name="search" onchange='this.form.submit()' class="w-[200px] bg-white border border-gray-300 text-gray-600 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option value="" {{$search == "" ? 'selected="selected"' : '' }}>選擇目標</option>
              @foreach($all_alarms as $alarm)
                <option value="{{$alarm->alarm_id}}" {{$search == $alarm->alarm_id ? 'selected="selected"' : '' }}>{{$alarm->alarm_id}} - {{$alarm->alarm_name}}</option>
              @endforeach  
            </select>
          </div>
      </form>
    </div>
  </div>
    <div>
        @if(count($all_labels) == 0)
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Position</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Operations</th>
                </tr>
              </thead>
              <tbody>
                <td class="px-5 py-5 text-base border-b border-gray-200"><div class="flex items-center">
                  <div class="ml-3">
                    <p class="text-gray-900 whitespace-no-wrap">
                      查無資料
                    </p>
                  </div>
                </div></td>
              </tbody>
        </div>
        @else
        @foreach($all_labels as $keys => $label)
          <span id="{{$label[0]->aj_join_name}}" class="w-24 rounded-full bg-blue-50 px-8 py-2 text-base font-semibold text-blue-600">{{$label[0]->fk_alarm_id}} - {{$label[0]->ag_join_name}}</span>
          <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Position</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Operations</th>
                </tr>
              </thead>

              <tbody>
                @for ($i = 0; $i < count($label); $i++)
                  @if($label[$i]->fk_user_id)
                  <tr>
                    <td class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                      <div class="overflow-y-hidden h-10 w-10">
                        @if($label[$i]->user->avatar == null)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        @else
                            <img class="w-8 rounded-full translate-x-1" src="/avatars/{{ $label[$i]->user->avatar }}" alt="tailwind logo"/>
                        @endif 
                      </div>
                      <div class="text-sm">
                        <div class="font-medium text-gray-700">{{$label[$i]->user->Badge_num}}</div>
                        <div class="text-gray-400">{{ $label[$i]->user->name }}</div>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      @foreach($groups as $g)
                          @if($g->group_id == $label[$i]->user->fk_group_id)
                              {{$g->group_name}}
                          @endif
                      @endforeach
                    </td>
                    <td class="px-6 py-4">
                      <div class="flex justify-start gap-4">
                        <form action="{{ route('warn.destroyUser', ['user_id'=> $label[$i]->fk_user_id, 'alarm_id' => $label[$i]->fk_alarm_id])}}" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" class="flex flex-row text-rose-400 hover:text-rose-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                              <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                            </svg>
                            <span class="grid place-self-center">刪除個別員工</span>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  @elseif($label[$i]->fk_group_id)
                    @foreach($all_users as $groupuser)
                      @if($groupuser->fk_group_id == $label[$i]->fk_group_id)
                      <tr>
                        <td class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                          <div class="overflow-y-hidden h-10 w-10">
                            @if($groupuser->avatar == null)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            @else
                                <img class="w-8 rounded-full translate-x-1" src="/avatars/{{ $groupuser->avatar }}" alt="tailwind logo"/>
                            @endif 
                          </div>
                          <div class="text-sm">
                            <div class="font-medium text-gray-700">{{$groupuser->Badge_num}}</div>
                            <div class="text-gray-400">{{ $groupuser->name }}</div>
                          </div>
                        </td>
                        <td class="px-6 py-4">
                          {{$groupuser->group->group_name}}
                        </td>
                        <td class="px-6 py-4">
                          <div class="flex justify-start gap-4">
                            <form action="{{ route('warn.destroyGroup', ['group_id'=> $label[$i]->fk_group_id, 'alarm_id' => $label[$i]->fk_alarm_id])}}" method="post">
                              @csrf
                              @method('delete')
                              <button type="submit" class="flex flex-row text-rose-400 hover:text-rose-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                  <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                </svg>
                                <span class="grid place-self-center">移除職位群組</span>
                              </button>
                            </form>
                          </div>
                        </td>
                      </tr>
                      @endif
                    @endforeach
                  @endif
                @endfor
              </tbody>
            </table>
          </div>
        @endforeach
        @endif
    </div>
</div>

