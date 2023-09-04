<div class="relative h-2/3 flex w-full max-w-[20rem] min-w-fit flex-col rounded-xl pb-8 text-white shadow-md shadow-teal-500/40">
  <div class="relative -translate-x-4 m-0 mb-4 rounded-none bg-clip-border border-b border-white/10 text-gray-700 shadow-none">
    <h2 class="inline-block select-none whitespace-nowrap rounded-lg bg-sky-500 py-2 px-3.5 font-sans text-lg font-bold uppercase leading-none text-white">
        {{$alarm->alarm_id}} - {{$alarm->alarm_name}}
    </h2>
  </div>
  <div class="p-0 overflow-y-auto h-[250px]">
    <ul class="flex flex-col gap-4">
      @for($i = 0; $i < count($already); $i++)
        @if($already[$i]->fk_group_id)
            <li class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-600 translate-x-2">
                    <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                </svg>

                <p class="block font-sans text-base font-normal leading-relaxed text-black antialiased">
                    {{$already[$i]->group->group_name}}
                </p>
                <a href="{{route('destroyGroup', ['group_id'=> $already[$i]->group->group_id, 'alarm_id'=> $alarm->alarm_id]) }}">
                    <button
                        type="button" 
                        class="grid place-self-center flex justify-center w-6 h-6 rounded-lg py-1 font-medium text-gray-500 shadow-md transition duration-150 ease-in-out hover:shadow-lg hover:bg-rose-600 hover:text-white active:shadow-lg focus:ring-sky-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M5.25 12a.75.75 0 01.75-.75h12a.75.75 0 010 1.5H6a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </a>
            </li>
        @endif
      @endfor
      @for($i = 0; $i < count($already); $i++)
        @if($already[$i]->fk_user_id)
            <li class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-600 translate-x-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>

                <p class="block font-sans text-base font-normal leading-relaxed text-black antialiased">
                    {{$already[$i]->user->name}}
                </p>
                <a href="{{route('destroyUser', ['user_id'=> $already[$i]->user->id, 'alarm_id'=> $alarm->alarm_id]) }}">
                    <button
                        type="button" 
                        class="grid place-self-center flex justify-center w-6 h-6 rounded-lg py-1 font-medium text-gray-500 shadow-md transition duration-150 ease-in-out hover:shadow-lg hover:bg-rose-600 hover:text-white active:shadow-lg focus:ring-sky-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M5.25 12a.75.75 0 01.75-.75h12a.75.75 0 010 1.5H6a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </a>
            </li>
        @endif
      @endfor
    </ul>
  </div>
</div>