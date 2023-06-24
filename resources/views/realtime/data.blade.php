@section('title', '即時資料')
<x-app-layout>
    
    <div class="flex flex-row">
        <div class="w-48 h-[420px] min-w-fit max-w-3xl ml-4 mt-4 grid content-center">
                <div class="w-48 h-32 bg-indigo-300 grid place-items-center rounded-md hover:bg-indigo-400">
                    <span class="font-semibold text-lg text-white tracking-tight hover:text-white">點擊按鈕切換顯示方式</span>
                    <button 
                        id="button-border"
                        class="flex items-center border-solid border w-32 rounded-full bg-white transition duration-300 focus:outline-none shadow"
                        onclick="toggleTheme()">
                        <div
                            id="switch-toggle"
                            class="w-12 h-12 relative rounded-full transition duration-500 transform bg-sky-700 -translate-x-2 p-2 text-white items-center">
                            <img class="w-full pb-4" src="{{ asset('img/svg/gui_icon.svg') }}" alt="guiIcon" />                    </div>
                        <div>
                            <p id="mode-btn-text" class="text-right duration-700">流程形式<p>
                        </div>
                    </button>
                </div>
        </div>
        <div id="realtime-data" class="relative mt-2 w-[66rem] h-full shrink-0 grid content-start justify-items-center duration-500">
            <img class="w-full px-2" src="{{ asset('img/flow-chart.png') }}" alt="flow chart" />
        </div>
    </div>

    <x-slot name="scripts">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
        const switchToggle = document.querySelector('#switch-toggle');
        const modeText = document.querySelector('#mode-btn-text');
        const graph = document.querySelector('#realtime-data');
        const buttonBorder = document.querySelector('#button-border');
        let isExcel = false

        const ExcelIcon = `<img class="w-full pb-4" src="{{ asset('img/svg/excel.svg') }}" alt="ExcelIcon" />`
        const ExcelText = `<p id="mode-btn-text" class="duration-700">表格形式<p>`
        const Excel = ` <table class="border-collapse duration-500">
                            <thead>
                                <tr>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">testdata_id</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">當下時間</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">pH值</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">溫度</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">導電度</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">化學含氧量COD</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">懸浮固體SS</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">data6</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">data7</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">data8</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">data9</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">data10</th>

                                    </tr>
                            </thead>
                            <tbody>
                                <tr id="json_rt" class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                </tr>
                            </tbody>
                        </table>`

        const GuiIcon = `<img class="w-[100rem] pb-4" src="{{ asset('img/svg/gui_icon.svg') }}" alt="guiIcon" />`
        const guiText = `<p id="mode-btn-text" class="text-right duration-700">流程形式<p>`
        const Gui = `<img class="w-full px-2" src="{{ asset('img/flow-chart.png') }}" alt="flow chart" />
                     <div id="data1" class="absolute text-xl text-black top-1/4 left-1/4 -translate-x-[11.6rem] -translate-y-6"></div>
                     <div id="data1_2" class="absolute text-xl text-black top-1/4 left-1/4 -translate-x-[11.6rem] translate-y-[36px]"></div>
                     <div id="data2" class="absolute text-xl text-black top-1/4 left-1/4 -translate-x-10 -translate-y-6"></div>
                     <div id="data2_2" class="absolute text-xl text-black top-1/4 left-1/4 -translate-x-10 translate-y-[36px]"></div>
                     <div id="data3" class="absolute text-xl text-black top-1/4 left-1/3 translate-x-3 -translate-y-6"></div>
                     <div id="data3_2" class="absolute text-xl text-black top-1/4 left-1/3 translate-x-3 translate-y-[36px]"></div>
                     <div id="data4" class="absolute text-xl text-black top-1/4 left-1/2 -translate-x-16 -translate-y-6"></div>
                     <div id="data4_2" class="absolute text-xl text-black top-1/4 left-1/2 -translate-x-16 translate-y-[36px]"></div>
                     <div id="data5" class="absolute text-xl text-black top-1/4 right-1/3 -translate-x-24 -translate-y-6"></div>
                     <div id="data5_2" class="absolute text-xl text-black top-1/4 right-1/3 -translate-x-24 translate-y-[36px]"></div>
                     <div id="data6" class="absolute text-xl text-black top-1/4 right-1/3 translate-x-9 -translate-y-6"></div>
                     <div id="data6_2" class="absolute text-xl text-black top-1/4 right-1/3 translate-x-9 translate-y-[36px]"></div>
                     <div id="data7" class="absolute text-xl text-black top-1/4 right-1/4 translate-x-[3.4rem] -translate-y-6"></div>
                     <div id="data7_2" class="absolute text-xl text-black top-1/4 right-1/4 translate-x-[3.4rem] translate-y-[36px]"></div>
                     <div id="data8" class="absolute text-xl text-black top-1/4 right-1/4 translate-x-[12.5rem] -translate-y-6"></div>
                     <div id="data8_2" class="absolute text-xl text-black top-1/4 right-1/4 translate-x-[12.5rem] translate-y-[36px]"></div>
                     <div id="data9" class="absolute underline-offset-2 text-xl text-black bottom-1/4 right-1/2 translate-x-6 translate-y-[36px]"></div>
                     <div id="data9_2" class="absolute underline-offset-2 text-xl text-black bottom-1/4 right-1/2 translate-x-[10rem] translate-y-[36px]"></div>
                     <div id="data10" class="absolute underline-offset-2 text-xl text-black bottom-1/4 left-1/4 translate-x-28 translate-y-[36px]"></div>
                     <div id="data10_2" class="absolute underline-offset-2 text-xl text-black bottom-1/4 left-1/4 translate-x-3 translate-y-[36px]"></div>
                     <div id="sign" class="absolute w-8 h-8 rounded-full bottom-1/4 left-1/4 -translate-x-[5.4rem] translate-y-[44.5px]"></div>`


        function toggleTheme (){
        isExcel = !isExcel
        localStorage.setItem('isExcel', isExcel)
        switchTheme()
        }

        function switchTheme (){
        if (isExcel) {
            setTimeout(() => {
                modeText.innerHTML = ExcelText
                graph.innerHTML = Excel
            }, 150);
            setTimeout(() => {
                switchToggle.innerHTML = ExcelIcon
            }, 200);
            switchToggle.classList.remove('bg-sky-700','-translate-x-2')
            modeText.classList.remove('text-right')
            switchToggle.classList.add('bg-green-100','translate-x-20')
            modeText.classList.add('text-left', '-translate-x-9')
            graph.classList.add('px-20')
            buttonBorder.classList.add('border-2','border-green-800')
            
        } else {
            setTimeout(() => {
                switchToggle.innerHTML = GuiIcon
                modeText.innerHTML = guiText
                graph.innerHTML = Gui
            }, 200);
            switchToggle.classList.add('bg-sky-700','-translate-x-2')
            modeText.classList.add('text-right')
            switchToggle.classList.remove('bg-green-100','translate-x-20')
            modeText.classList.remove('text-left', '-translate-x-9')
            graph.classList.remove('px-20')
            buttonBorder.classList.remove('border-2', 'border-green-800')
        }
        }

        switchTheme()
        </script>
        <script type="text/javascript">
            function update() {
                $.ajax({
                    method: "POST",
                    url : '/realtime',
                    data: {'_token': '{{csrf_token()}}'},
                    dataType: 'json',
                    success:function(data){
                        current = data;
                        document.getElementById("json_rt").innerHTML = 
                    '<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">' + 
                    current.testdata_id + '</td>' +
                    '<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">' + 
                    current.added_on + '</td>' +
                    '<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">' + 
                    current.data1 + '</td>' +
                    '<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">' + 
                    current.data2 + '</td>' +
                    '<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">' + 
                    current.data3 + '</td>' +
                    '<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">' + 
                    current.data4 + '</td>' +
                    '<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">' + 
                    current.data5 + '</td>' +
                    '<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">' + 
                    current.data6 + '</td>' +
                    '<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">' + 
                    current.data7 + '</td>' +
                    '<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">' + 
                    current.data8 + '</td>' +
                    '<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">' + 
                    current.data9 + '</td>' +
                    '<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">' + 
                    current.data10 + '</td>' ;
                    },
                    error: function(errmsg) {
                       console.log("Ajax獲取伺服器資料出現錯誤！"+ errmsg);
                    },
                })
                document.getElementById("data1").innerHTML = current.data1;
                document.getElementById("data1_2").innerHTML = current.data1;
                document.getElementById("data2").innerHTML = current.data2;
                document.getElementById("data2_2").innerHTML = current.data2;
                document.getElementById("data3").innerHTML = current.data3;
                document.getElementById("data3_2").innerHTML = current.data3;
                document.getElementById("data4").innerHTML = current.data4;
                document.getElementById("data4_2").innerHTML = current.data4;
                document.getElementById("data5").innerHTML = current.data5;
                document.getElementById("data5_2").innerHTML = current.data5;
                document.getElementById("data6").innerHTML = current.data6;
                document.getElementById("data6_2").innerHTML = current.data6;
                document.getElementById("data7").innerHTML = current.data7;
                document.getElementById("data7_2").innerHTML = current.data7;
                document.getElementById("data8").innerHTML = current.data8;
                document.getElementById("data8_2").innerHTML = current.data8;
                document.getElementById("data9").innerHTML = current.data9;
                document.getElementById("data9_2").innerHTML = current.data5;
                document.getElementById("data10").innerHTML = current.data10;
                document.getElementById("data10_2").innerHTML = current.data7;

                const sign = document.querySelector('#sign');
                sign.classList.remove('bg-[#4cb631]');
                sign.classList.remove('bg-[#ffa100]');
                sign.classList.remove('bg-[#ff1616]');
                if(parseInt(current.data4) > 220){
                    sign.classList.add('bg-[#4cb631]');
                }
                else if(parseInt(current.data4) < 219 && parseInt(current.data4) > 200){
                    sign.classList.add('bg-[#ffa100]');
                }
                else {
                    sign.classList.add('bg-[#ff1616]');
                }
            }
           
            setInterval(update, 1000); //every 1 secs
        </script>
    </x-slot>
</x-app-layout>