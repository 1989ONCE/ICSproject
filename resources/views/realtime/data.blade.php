@section('title', '即時資料')
<x-app-layout>

    <x-slot name="scripts">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
        const switchToggle = document.querySelector('#switch-toggle');
        const modeText = document.querySelector('#mode-btn-text');
        const graph = document.querySelector('#realtime-data');
        const buttonBorder = document.querySelector('#button-border');
        let isExcel = false

        const ExcelIcon = `<img class="w-full pb-4" src="{{ asset('img/svg/excel.svg') }}" alt="ExcelIcon" />`
        const ExcelText = `<p id="mode-btn-text" class="duration-700">表格形式<p>`;
        const Excel = ` <table class="border-collapse">
                            <thead>
                                <tr>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">data_id</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">處理槽名稱</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">pH值</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">溫度</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">導電度</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">化學含氧量COD</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">懸浮固體SS</th>
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">資料添加時間</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach($all_datas as $key => $data)
                                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                            {{ $data -> data_id }}
                                        </td>
                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                            {{ $data->pool->pool_name}}
                                        </td>
                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                            {{ $data -> ph }}
                                        </td>
                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                            {{ $data -> temp }}
                                        </td>
                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                            {{ $data -> EC }}
                                        </td>
                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                            {{ $data -> COD }}
                                        </td>
                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                            {{ $data -> SS }}
                                        </td>
                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                            {{ $data -> added_on }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>`;

        const GuiIcon = `<img class="w-full pb-4" src="{{ asset('img/svg/gui_icon.svg') }}" alt="guiIcon" />`
        const guiText = `<p id="mode-btn-text" class="text-right duration-700">流程形式<p>`;
        const Gui = `<img class="w-5/6 pb-4" src="{{ asset('img/flow-chart.png') }}" alt="flow chart" />`;

        function toggleTheme (){
        isExcel = !isExcel
        localStorage.setItem('isExcel', isExcel)
        switchTheme()
        }

        function switchTheme (){
        if (isExcel) {
            setTimeout(() => {
                modeText.innerHTML = ExcelText
            }, 250);
            switchToggle.classList.remove('bg-sky-700','-translate-x-2')
            modeText.classList.remove('text-right')
            switchToggle.classList.add('bg-green-100','translate-x-20')
            modeText.classList.add('text-left', '-translate-x-9')
            graph.classList.add('px-20')
            buttonBorder.classList.add('border-2','border-green-800')
            setTimeout(() => {
            switchToggle.innerHTML = ExcelIcon
            graph.innerHTML = Excel
            }, 250);
            
        } else {
            setTimeout(() => {
                modeText.innerHTML = guiText
            }, 250);
            switchToggle.classList.add('bg-sky-700','-translate-x-2')
            modeText.classList.add('text-right')
            switchToggle.classList.remove('bg-green-100','translate-x-20')
            modeText.classList.remove('text-left', '-translate-x-9')
            graph.classList.remove('px-20')
            buttonBorder.classList.remove('border-2', 'border-green-800')
            setTimeout(() => {
            switchToggle.innerHTML = GuiIcon
            graph.innerHTML = Gui
            }, 250);
            
        }
        }

        switchTheme()
        </script>
    </x-slot>
    
    <div class="flex flex-row h-screen -mt-8">
        <div class="w-48 min-w-fit max-w-3xl ml-8 mt-4 grid content-center">
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

        <div id="realtime-data" class="grid content-start justify-items-center mt-16 duration-500">
            <img class="w-5/6 pb-4" src="{{ asset('img/flow-chart.png') }}" alt="flow chart" />
        </div>
    </div>

    <div>
        <h1>即時資料</h1>
        <table>
    <thead>
        <tr>
            <th>時間戳記</th>
            <th>Data1</th>
            <th>Data2</th>
            <th>Data3</th>
            <th>Data4</th>
            <th>Data5</th>
            <th>Data6</th>
            <th>Data7</th>
            <th>Data8</th>
            <th>Data9</th>
            <th>Data10</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($rts as $rt)
            <tr>
                <td>{{ $rt['Timestamp'] }}</td>
                <td>{{ $rt['Data1'] }}</td>
                <td>{{ $rt['Data2'] }}</td>
                <td>{{ $rt['Data3'] }}</td>
                <td>{{ $rt['Data4'] }}</td>
                <td>{{ $rt['Data5'] }}</td>
                <td>{{ $rt['Data6'] }}</td>
                <td>{{ $rt['Data7'] }}</td>
                <td>{{ $rt['Data8'] }}</td>
                <td>{{ $rt['Data9'] }}</td>
                <td>{{ $rt['Data10'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
    </div>
</x-app-layout>