<div class="container max-w-4xl px-4 pt-2 sm:px-8 grid content-center w-full">
  <div class="w-full flex flex-row justify-start pb-4 gap-10">
  <h2 class="text-3xl font-bold leading-tight">
      各告警群組人員列表
  </h2>
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
              <option value="*" {{($search == "" || $search == "*") ? 'selected="selected"' : '' }}>選擇目標</option>
              @foreach($all_alarms as $alarm)
                <option value="{{$alarm->alarm_id}}" {{$search == $alarm->alarm_id ? 'selected="selected"' : '' }}>{{$alarm->alarm_id}} - {{$alarm->alarm_name}}</option>
              @endforeach  
            </select>
          </div>
      </form>
    </div>
  </div>
  <div class="overflow-y-visible pt-4 w-full">
        @if(count($all_labels) == 0)
          @if($search != "" || $search != "*")
          <div class="flex flex-row gap-2">
            <div id="{{$all_alarms[0]->alarm_name}}" class="center relative inline-block select-none whitespace-nowrap rounded-lg bg-teal-500 py-2 px-3.5 align-baseline font-sans text-xs font-bold uppercase leading-none text-white">
                @foreach($all_alarms as $alarm)
                  @if($alarm->alarm_id == $search)
                    <div class="mt-px">{{$alarm->alarm_id}} - {{$alarm->alarm_name}}</div>
                  @endif
                @endforeach
            </div>
            <a href="addpeople?id={{$alarm->alarm_id}}">
                <button
                  type="button" 
                  class="grid place-self-center flex justify-center w-8 h-8 rounded-lg py-1 font-medium text-gray-500 shadow-md transition duration-150 ease-in-out hover:shadow-lg hover:bg-gray-600 hover:text-white active:shadow-lg focus:ring-sky-400">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                  </svg>
                </button>
            </a>
          </div>
          @endif
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
            <table class="w-full border-collapse text-left text-sm text-gray-500">
              <thead class="bg-[#c3e3f1]">
                <tr>
                  <th class="bg-[#c3e3f7] px-6 py-4 font-medium text-gray-900">Name</th>
                  <th class="bg-[#c3e3f7] px-6 py-4 font-medium text-gray-900">Position</th>
                </tr>  
              </thead>
              <tbody>
                <td class="px-5 py-5 text-base border-b border-gray-200"><div class="flex items-center">
                  <div class="ml-3">
                    <p class="text-gray-900 whitespace-no-wrap">
                      目前無設定通知對象
                    </p>
                  </div>
                </div></td>
              </tbody>
        </div>
        @else
        @foreach($all_labels as $keys => $label)
          <div class="flex flex-row gap-2">
            <div id="{{$label[0]->aj_join_name}}" class="center relative inline-block select-none whitespace-nowrap rounded-lg bg-teal-500 py-2 px-3.5 align-baseline font-sans text-xs font-bold uppercase leading-none text-white">
              <div class="mt-px">{{$label[0]->fk_alarm_id}} - {{$label[0]->ag_join_name}}</div>
            </div>
            <a href="addpeople?id={{$label[0]->fk_alarm_id}}">
              <button
                type="button" 
                class="grid place-self-center flex justify-center w-8 h-8 rounded-lg py-1 font-medium text-gray-500 shadow-md transition duration-150 ease-in-out hover:shadow-lg hover:bg-gray-600 hover:text-white active:shadow-lg focus:ring-sky-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                  <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                </svg>
              </button>
            </a>
          </div>
          <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
            <table class="w-full border-collapse text-left text-sm text-gray-500">
              <thead class="bg-[#c3e3f1]">
                <tr>
                  <th class="bg-[#c3e3f7] px-6 py-4 font-medium text-gray-900">Name</th>
                  <th class="bg-[#c3e3f7] px-6 py-4 font-medium text-gray-900">Position</th>
                </tr>  
              </thead>

              <tbody>
                <tr class="w-full text-base"><td><span class="pl-2"># 個別員工</span></td><td></td></tr>
                <tr class="h-2"><td></td></tr>
                @for ($i = 0; $i < count($label); $i++)
                  @if($label[$i]->fk_user_id)
                  <tr class="hover:bg-gray-100 w-1/4">
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
                  </tr>
                  @endif
                @endfor
                @for ($i = 0; $i < count($label); $i++)
                  @if($label[$i]->fk_group_id)
                  <tr class="w-full text-base">
                    <td class="flex flex-row">
                      <span class="pl-2"># {{$label[$i]->group->group_name}}</span>
                    </td>
                    <td></td>
                  </tr>
                    <tr class="h-4"><td></td><tr>
                    @foreach($all_users as $groupuser)
                      @if($groupuser->fk_group_id == $label[$i]->fk_group_id)
                      <tr class="hover:bg-gray-100 w-1/4">
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
                      </tr>
                      @endif
                    @endforeach
                  @endif
                @endfor
              </tbody>
            </table>
          </div>
        @endforeach
        @if($search == "" || $search == "*")
          <div class="py-2">
            <span class="center relative inline-block select-none whitespace-nowrap rounded-lg bg-rose-700 py-2 px-3.5 align-baseline font-sans text-sm font-bold uppercase leading-none text-white">以下告警尚未設定通知對象</span>
          </div>

          @foreach($all_alarms as $alarm)
            @php $exist = 0; @endphp
            @foreach($no_label as $label)
              @if($alarm->alarm_id == $label[0]->fk_alarm_id)
                @php $exist = 1;  @endphp
              @endif
            @endforeach
            @php
              if($exist == 0)
                echo '<div class="flex flex-row gap-2">
                        <div class="center relative inline-block select-none whitespace-nowrap rounded-lg bg-gray-500 py-2 px-3.5 align-baseline font-sans text-xs font-bold uppercase leading-none text-white">
                          <div class="mt-px">'.$alarm->alarm_id. ' - ' .$alarm->alarm_name. '</div>
                        </div>
                        <a href="addpeople?id='.$alarm->alarm_id.'">
                          <button
                            type="button" 
                            class="grid place-self-center flex justify-center w-8 h-8 rounded-lg py-1 font-medium text-gray-500 shadow-md transition duration-150 ease-in-out hover:shadow-lg hover:bg-gray-600 hover:text-white active:shadow-lg focus:ring-sky-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                              <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                            </svg>
                          </button>
                        </a>
                      </div>

                      <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                        <table class="w-full border-collapse text-left text-sm text-gray-500">
                          <thead class="bg-gray-100">
                            <tr>
                              <th class="px-6 py-4 font-medium text-gray-900">Name</th>
                              <th class="px-6 py-4 font-medium text-gray-900">Position</th>
                            </tr>  
                          </thead>
                          <tbody>
                            <td class="px-5 py-5 text-base border-b border-gray-200"><div class="flex items-center">
                              <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap">
                                  目前無設定通知對象
                                </p>
                              </div>
                            </div></td>
                          </tbody>
                        </table>
                      </div>';
            @endphp
          @endforeach
        @endif  
      @endif
  </div>
</div>

