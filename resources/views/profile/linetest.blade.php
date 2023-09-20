@section('title', 'line授權')

<x-app-layout>
    
    <x-slot name="scripts"></x-slot>

    <div class="flex">
    <script>
        

        function oAuth2() {
        
            
            var URL = 'https://notify-bot.line.me/oauth/authorize?';
            URL += 'response_type=code';
            URL += '&client_id=	Fmqcpg21ohTgNGSU6xo499';
            URL += '&redirect_uri=http://ncumis-ics.com/profile/linetest';
            URL += '&scope=notify';
            URL += '&state=NO_STATE';
            window.location.href = URL;

        }

    </script>
</head>


<body>
    

    <button onclick="oAuth2();" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">  點選這裡連結到LineNotify</button>

    



</body>
    </div>
</x-app-layout>