<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Realtime Data') }}
        </h2>
    </x-slot>

    <x-slot name="scripts">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
        const switchToggle = document.querySelector('#switch-toggle');
        const modeText = document.querySelector('#mode-btn-text');
        const graph = document.querySelector('#realtime-data');
        let isExcel = false

        const ExcelIcon = `<img class="w-full pb-4" src="{{ asset('img/svg/excel.svg') }}" alt="ExcelIcon" />`
        const ExcelText = `<p id="mode-btn-text" class="duration-700">表格形式<p>`;
        const Excel = `<table class="border-collapse w-full">
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
            switchToggle.classList.add('border-solid','border','bg-gray-200','translate-x-20')
            modeText.classList.add('text-left', '-translate-x-9')
            graph.classList.add('px-12')
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
            switchToggle.classList.remove('border-solid','border','bg-gray-200','translate-x-20')
            modeText.classList.remove('text-left', '-translate-x-9')
            graph.classList.remove('px-12')
            setTimeout(() => {
            switchToggle.innerHTML = GuiIcon
            graph.innerHTML = Gui
            }, 250);
            
        }
        }

        switchTheme()
        </script>
    </x-slot>
    
    <div class="flex flex-row">
        <div class="w-1/6 pt-5 pl-12 flex-column">
                <div class="w-full">
                    <p>點擊切換顯示方式<p><br>
                </div>
                <button 
                    class="border-solid border w-32 h-10 rounded-full bg-white flex items-center transition duration-300 focus:outline-none shadow"
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

        <div id="realtime-data" class="grid place-items-center mt-4 duration-500">
            <img class="w-5/6 pb-4" src="{{ asset('img/flow-chart.png') }}" alt="flow chart" />
        </div>
    </div>
</x-app-layout>