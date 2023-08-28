<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('修改個人資料') }}
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

    <button onclick="oAuth2();" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">  點選這裡連結到LineNotify</button>
</section>
<<<<<<< HEAD

=======
>>>>>>> 8eeb6e39e8bd625740fe3e9df5b3b66f1de9b293
