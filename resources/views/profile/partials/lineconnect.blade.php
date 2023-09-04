<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Line通知設置') }}
        </h2>
    </header>
    <script>
        

        function oAuth2() {
        
            
            var URL = 'https://notify-bot.line.me/oauth/authorize?';
            URL += 'response_type=code';
            URL += '&client_id=	Fmqcpg21ohTgNGSU6xo499';
            URL += '&redirect_uri=http://localhost/ICSproject/public/profile/linetest';
            URL += '&scope=notify';
            URL += '&state=NO_STATE';
            window.location.href = URL;

        }

    </script>
    <div class="py-2"></div>
    @if($user->line_token == null)
    <button onclick="oAuth2();" class="gap-2 flex flex-row px-3 py-1 rounded text-[#06C755] bg-white border-2 border-[#06C755] hover:border-0 hover:text-white hover:bg-emerald-700 hover:underline hover:underline-offset-4 hover:decoration-2">
        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 48 48">
            <path fill="#00c300" d="M12.5,42h23c3.59,0,6.5-2.91,6.5-6.5v-23C42,8.91,39.09,6,35.5,6h-23C8.91,6,6,8.91,6,12.5v23C6,39.09,8.91,42,12.5,42z"></path><path fill="#fff" d="M37.113,22.417c0-5.865-5.88-10.637-13.107-10.637s-13.108,4.772-13.108,10.637c0,5.258,4.663,9.662,10.962,10.495c0.427,0.092,1.008,0.282,1.155,0.646c0.132,0.331,0.086,0.85,0.042,1.185c0,0-0.153,0.925-0.187,1.122c-0.057,0.331-0.263,1.296,1.135,0.707c1.399-0.589,7.548-4.445,10.298-7.611h-0.001C36.203,26.879,37.113,24.764,37.113,22.417z M18.875,25.907h-2.604c-0.379,0-0.687-0.308-0.687-0.688V20.01c0-0.379,0.308-0.687,0.687-0.687c0.379,0,0.687,0.308,0.687,0.687v4.521h1.917c0.379,0,0.687,0.308,0.687,0.687C19.562,25.598,19.254,25.907,18.875,25.907z M21.568,25.219c0,0.379-0.308,0.688-0.687,0.688s-0.687-0.308-0.687-0.688V20.01c0-0.379,0.308-0.687,0.687-0.687s0.687,0.308,0.687,0.687V25.219z M27.838,25.219c0,0.297-0.188,0.559-0.47,0.652c-0.071,0.024-0.145,0.036-0.218,0.036c-0.215,0-0.42-0.103-0.549-0.275l-2.669-3.635v3.222c0,0.379-0.308,0.688-0.688,0.688c-0.379,0-0.688-0.308-0.688-0.688V20.01c0-0.296,0.189-0.558,0.47-0.652c0.071-0.024,0.144-0.035,0.218-0.035c0.214,0,0.42,0.103,0.549,0.275l2.67,3.635V20.01c0-0.379,0.309-0.687,0.688-0.687c0.379,0,0.687,0.308,0.687,0.687V25.219z M32.052,21.927c0.379,0,0.688,0.308,0.688,0.688c0,0.379-0.308,0.687-0.688,0.687h-1.917v1.23h1.917c0.379,0,0.688,0.308,0.688,0.687c0,0.379-0.309,0.688-0.688,0.688h-2.604c-0.378,0-0.687-0.308-0.687-0.688v-2.603c0-0.001,0-0.001,0-0.001c0,0,0-0.001,0-0.001v-2.601c0-0.001,0-0.001,0-0.002c0-0.379,0.308-0.687,0.687-0.687h2.604c0.379,0,0.688,0.308,0.688,0.687s-0.308,0.687-0.688,0.687h-1.917v1.23H32.052z"></path>
        </svg>
        連結到Line Notify
    </button>
    @else
        <div class="flex flex-col gap-2">
            <span class="w-fit bg-[#06C788] p-1 text-white font-bold rounded">
                已綁定Line Notify連結
            </span>
            <x-danger-button 
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'cancel-line-notify')"
                class="w-fit px-3 rounded text-white text-md">
                取消綁定
            </x-danger-button>

            <x-modal name="cancel-line-notify" :show="$errors->userDeletion->isNotEmpty()" focusable>
                <form method="post" action="{{ route('profile.lineDestroy') }}" class="p-6">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('確認要取消此帳號與Line Notify的綁定嗎?') }}
                    </h2>
                    <h5 class="text-md font-medium text-gray-900 dark:text-gray-100">          
                        {{ __('Are you sure you want to unlink Line Notify from this account?') }}
                    </h5>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('取消連結後，需重新綁定Line Notify連結') }}
                    </p>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('返回') }}
                        </x-secondary-button>

                        <x-danger-button class="ml-3">
                            {{ __('取消綁定') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </div>
    @endif
</section>