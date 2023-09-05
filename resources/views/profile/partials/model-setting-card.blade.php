<div class="relative h-fit flex w-full max-w-[20rem] flex-col mb-4 ml-10 rounded-xl text-white shadow-md shadow-teal-500/40">
    <div class="flex flex-row justify-between">
        <div class="relative -translate-x-4 m-0 mb-4 rounded-none bg-clip-border border-b border-white/10 text-gray-700 shadow-none">
            <h2 class="inline-block select-none whitespace-nowrap rounded-lg bg-sky-500 py-2 px-3.5 font-sans text-lg font-bold uppercase leading-none text-white">
                {{$m->model_name}}
            </h2>
        </div>
        <div class="relative translate-x-2 m-0 mb-4 rounded-none bg-clip-border border-b border-white/10 text-gray-700 shadow-none">
            <form method="POST" action="{{ route('profile.deleteModel', ['id' => $m->model_id]) }}">
                @csrf
                @method('delete')
                <button type="submit" class="inline-block select-none whitespace-nowrap rounded-lg bg-rose-600 hover:bg-rose-500 py-2 px-2 font-sans text-lg font-bold uppercase leading-none text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

  <div class="pt-2 pb-4 pr-2 overflow-y-auto h-fit">
    <ul class="flex flex-col gap-4">
            <li class="flex items-center gap-4">
                <p class="block text-base font-normal leading-relaxed text-black antialiased ml-4">
                    模型：
                    @if($m->model_loc == null)
                        <span class="text-sky-800 text-sm font-bold">無設定模型</span>
                    @elseif($m->model_loc)
                        <span class="block text-sky-700 font-bold">{{$m->model_loc}}</sapi_windows_cp_conv>
                    @endif    
                </p>
                                
                @include('profile.partials.upload-button', ['id' => $m->model_id, 'name' => $m->model_name])

            </li>
        
            <li class="flex items-center gap-4">
                <p class="block text-base font-normal leading-relaxed text-black antialiased ml-4">
                    準確度：
                    @if($m->accuracy == null)
                        <span class="text-cyan-800 text-sm font-bold">資料不足,尚不提供準確度!</span>
                    @elseif($m->accuracy < 0.9)
                        <h5 class="text-red-600 font-bold">{{$m->accuracy}}</h5>
                    @else
                        <h5 class="text-green-600 font-bold">{{$m->accuracy}}</h5>
                    @endif
                </p>
            </li>

            <li class="flex items-center gap-4">
                <p class="block text-base font-normal leading-relaxed text-black antialiased ml-4">
                    上傳日期：
                    @if($m->added_on == null)
                        <span class="text-cyan-800 text-sm font-bold">———</span>
                    @else
                        <h5 class="text-green-600 font-bold">{{$m->added_on}}</h5>
                    @endif
                </p>
            </li>
    </ul>
  </div>
</div>