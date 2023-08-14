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
    <button onclick="oAuth2();" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">  連結到LineNotify</button>
</section>