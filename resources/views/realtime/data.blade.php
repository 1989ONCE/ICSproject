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

        const ExcelIcon = `<svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>file_type_excel2</title><path d="M28.781,4.405H18.651V2.018L2,4.588V27.115l16.651,2.868V26.445H28.781A1.162,1.162,0,0,0,30,25.349V5.5A1.162,1.162,0,0,0,28.781,4.405Zm.16,21.126H18.617L18.6,23.642h2.487v-2.2H18.581l-.012-1.3h2.518v-2.2H18.55l-.012-1.3h2.549v-2.2H18.53v-1.3h2.557v-2.2H18.53v-1.3h2.557v-2.2H18.53v-2H28.941Z" style="fill:#20744a;fill-rule:evenodd"></path><rect x="22.487" y="7.439" width="4.323" height="2.2" style="fill:#20744a"></rect><rect x="22.487" y="10.94" width="4.323" height="2.2" style="fill:#20744a"></rect><rect x="22.487" y="14.441" width="4.323" height="2.2" style="fill:#20744a"></rect><rect x="22.487" y="17.942" width="4.323" height="2.2" style="fill:#20744a"></rect><rect x="22.487" y="21.443" width="4.323" height="2.2" style="fill:#20744a"></rect><polygon points="6.347 10.673 8.493 10.55 9.842 14.259 11.436 10.397 13.582 10.274 10.976 15.54 13.582 20.819 11.313 20.666 9.781 16.642 8.248 20.513 6.163 20.329 8.585 15.666 6.347 10.673" style="fill:#ffffff;fill-rule:evenodd"></polygon></g></svg>`
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

        const GuiIcon = `<svg viewBox="0 0 520 520" xmlns="http://www.w3.org/2000/svg" fill="#000000" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g transform="translate(1)"> <g> <path style="fill:#a8e5ff;" d="M485.4,110.933H24.6V24.747c0-9.387,6.827-16.213,16.213-16.213H470.04 c8.533,0,16.213,6.827,16.213,16.213v86.187H485.4z"></path> <path style="fill:#a8e5ff;" d="M374.467,503.467h93.867c9.387,0,17.067-8.533,17.067-18.773v-373.76H24.6v373.76 c0,10.24,7.68,18.773,17.067,18.773h93.867H374.467z"></path> </g> <path style="fill:#FFFFFF;" d="M24.6,484.693v-373.76V24.747c0-9.387,6.827-16.213,16.213-16.213H23.747 c-9.387,0-16.213,6.827-16.213,16.213v86.187v373.76c0,10.24,8.533,18.773,18.773,18.773h15.36 C32.28,503.467,24.6,494.933,24.6,484.693"></path> <path style="fill:#000000;" d="M486.253,8.533h-17.067c8.533,0,16.213,6.827,16.213,16.213v86.187v373.76 c0,10.24-7.68,18.773-17.067,18.773h15.36c10.24,0,18.773-8.533,18.773-18.773v-373.76V24.747 C502.467,15.36,495.64,8.533,486.253,8.533"></path> <g> <path style="fill:#00affa;" d="M84.333,59.733c0,14.507-11.093,25.6-25.6,25.6s-25.6-11.093-25.6-25.6s11.093-25.6,25.6-25.6 S84.333,45.227,84.333,59.733"></path> <path style="fill:#00affa;" d="M161.133,59.733c0,14.507-11.093,25.6-25.6,25.6s-25.6-11.093-25.6-25.6s11.093-25.6,25.6-25.6 S161.133,45.227,161.133,59.733"></path> <path style="fill:#00affa;" d="M237.933,59.733c0,14.507-11.093,25.6-25.6,25.6s-25.6-11.093-25.6-25.6s11.093-25.6,25.6-25.6 S237.933,45.227,237.933,59.733"></path> </g> <g> <path style="fill:#fffa66;" d="M459.8,307.2c0,18.773-15.36,34.133-34.133,34.133s-34.133-15.36-34.133-34.133 s15.36-34.133,34.133-34.133S459.8,288.427,459.8,307.2"></path> <path style="fill:#fffa66;" d="M263.533,384c0,18.773-15.36,34.133-34.133,34.133s-34.133-15.36-34.133-34.133 c0-18.773,15.36-34.133,34.133-34.133S263.533,365.227,263.533,384"></path> </g> <g> <path style="fill:#00affa;" d="M118.467,307.2c0,18.773-15.36,34.133-34.133,34.133S50.2,325.973,50.2,307.2 s15.36-34.133,34.133-34.133S118.467,288.427,118.467,307.2"></path> <path style="fill:#00affa;" d="M340.333,221.867c0,18.773-15.36,34.133-34.133,34.133s-34.133-15.36-34.133-34.133 s15.36-34.133,34.133-34.133S340.333,203.093,340.333,221.867"></path> </g> <path d="M58.733,93.867c-18.773,0-34.133-15.36-34.133-34.133S39.96,25.6,58.733,25.6s34.133,15.36,34.133,34.133 S77.507,93.867,58.733,93.867z M58.733,42.667c-9.387,0-17.067,7.68-17.067,17.067S49.347,76.8,58.733,76.8S75.8,69.12,75.8,59.733 S68.12,42.667,58.733,42.667z"></path> <path d="M135.533,93.867c-18.773,0-34.133-15.36-34.133-34.133S116.76,25.6,135.533,25.6s34.133,15.36,34.133,34.133 S154.307,93.867,135.533,93.867z M135.533,42.667c-9.387,0-17.067,7.68-17.067,17.067s7.68,17.067,17.067,17.067 S152.6,69.12,152.6,59.733S144.92,42.667,135.533,42.667z"></path> <path d="M212.333,93.867c-18.773,0-34.133-15.36-34.133-34.133S193.56,25.6,212.333,25.6s34.133,15.36,34.133,34.133 S231.107,93.867,212.333,93.867z M212.333,42.667c-9.387,0-17.067,7.68-17.067,17.067s7.68,17.067,17.067,17.067 S229.4,69.12,229.4,59.733S221.72,42.667,212.333,42.667z"></path> <path d="M511,119.467H-1v-94.72C-1,11.093,10.093,0,23.747,0h463.36C499.907,0,511,11.093,511,24.747V119.467z M16.067,102.4 h477.867V24.747c0-4.267-3.413-7.68-7.68-7.68H23.747c-4.267,0-7.68,3.413-7.68,7.68V102.4z"></path> <path d="M483.693,512H26.307C10.947,512-1,500.053-1,484.693V102.4h512v382.293C511,500.053,499.053,512,483.693,512z M16.067,119.467v365.227c0,5.973,4.267,10.24,10.24,10.24h457.387c5.973,0,10.24-4.267,10.24-10.24V119.467H16.067z"></path> <path d="M84.333,349.867c-23.893,0-42.667-18.773-42.667-42.667c0-23.893,18.773-42.667,42.667-42.667S127,283.307,127,307.2 C127,331.093,108.227,349.867,84.333,349.867z M84.333,281.6c-14.507,0-25.6,11.093-25.6,25.6s11.093,25.6,25.6,25.6 s25.6-11.093,25.6-25.6S98.84,281.6,84.333,281.6z"></path> <path d="M425.667,349.867c-23.893,0-42.667-18.773-42.667-42.667c0-23.893,18.773-42.667,42.667-42.667 s42.667,18.773,42.667,42.667C468.333,331.093,449.56,349.867,425.667,349.867z M425.667,281.6c-14.507,0-25.6,11.093-25.6,25.6 s11.093,25.6,25.6,25.6s25.6-11.093,25.6-25.6S440.173,281.6,425.667,281.6z"></path> <path d="M306.2,264.533c-23.893,0-42.667-18.773-42.667-42.667S282.307,179.2,306.2,179.2c23.893,0,42.667,18.773,42.667,42.667 S330.093,264.533,306.2,264.533z M306.2,196.267c-14.507,0-25.6,11.093-25.6,25.6c0,14.507,11.093,25.6,25.6,25.6 s25.6-11.093,25.6-25.6C331.8,207.36,320.707,196.267,306.2,196.267z"></path> <path d="M229.4,426.667c-23.893,0-42.667-18.773-42.667-42.667c0-23.893,18.773-42.667,42.667-42.667s42.667,18.773,42.667,42.667 C272.067,407.893,253.293,426.667,229.4,426.667z M229.4,358.4c-14.507,0-25.6,11.093-25.6,25.6c0,14.507,11.093,25.6,25.6,25.6 c14.507,0,25.6-11.093,25.6-25.6C255,369.493,243.907,358.4,229.4,358.4z"></path> <path d="M195.267,375.467c-1.707,0-2.56,0-4.267-0.853l-76.8-42.667c-4.267-2.56-5.973-7.68-3.413-11.947 c2.56-4.267,7.68-5.973,11.947-3.413l76.8,42.667c4.267,2.56,5.973,7.68,3.413,11.947 C201.24,373.76,198.68,375.467,195.267,375.467z"></path> <path d="M246.467,358.4c-0.853,0-2.56,0-3.413-0.853c-4.267-1.707-5.973-6.827-4.267-11.093l42.667-93.867 c1.707-4.267,6.827-5.973,11.093-4.267c4.267,1.707,5.973,6.827,4.267,11.093l-42.667,93.867 C252.44,356.693,249.88,358.4,246.467,358.4z"></path> <path d="M391.533,290.133c-1.707,0-3.413-0.853-5.12-1.707l-51.2-34.133c-4.267-2.56-5.12-7.68-2.56-11.947 c2.56-4.267,7.68-5.12,11.947-2.56l51.2,34.133c4.267,2.56,5.12,7.68,2.56,11.947C396.653,288.427,394.093,290.133,391.533,290.133 z"></path> </g> </g></svg>`
        const guiText = `<p id="mode-btn-text" class="text-right duration-700">流程形式<p>`;
        const Gui = `<img class="w-4/5 pb-4" src="{{ asset('img/flow-chart.png') }}" alt="flow chart" />`;

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
        <div class="pt-5 pl-24">
                <div>
                    <p>請選擇顯示方式<p><br>
                </div>
                <button 
                    class="border-solid border w-32 h-10 rounded-full bg-white flex items-center transition duration-300 focus:outline-none shadow"
                    onclick="toggleTheme()">
                    <div
                        id="switch-toggle"
                        class="w-12 h-12 relative rounded-full transition duration-500 transform bg-sky-700 -translate-x-2 p-2 text-white items-center">
                        <svg viewBox="0 0 520 520" xmlns="http://www.w3.org/2000/svg" fill="#000000" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" ><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g transform="translate(1)"> <g> <path style="fill:#a8e5ff;" d="M485.4,110.933H24.6V24.747c0-9.387,6.827-16.213,16.213-16.213H470.04 c8.533,0,16.213,6.827,16.213,16.213v86.187H485.4z"></path> <path style="fill:#a8e5ff;" d="M374.467,503.467h93.867c9.387,0,17.067-8.533,17.067-18.773v-373.76H24.6v373.76 c0,10.24,7.68,18.773,17.067,18.773h93.867H374.467z"></path> </g> <path style="fill:#FFFFFF;" d="M24.6,484.693v-373.76V24.747c0-9.387,6.827-16.213,16.213-16.213H23.747 c-9.387,0-16.213,6.827-16.213,16.213v86.187v373.76c0,10.24,8.533,18.773,18.773,18.773h15.36 C32.28,503.467,24.6,494.933,24.6,484.693"></path> <path style="fill:#000000;" d="M486.253,8.533h-17.067c8.533,0,16.213,6.827,16.213,16.213v86.187v373.76 c0,10.24-7.68,18.773-17.067,18.773h15.36c10.24,0,18.773-8.533,18.773-18.773v-373.76V24.747 C502.467,15.36,495.64,8.533,486.253,8.533"></path> <g> <path style="fill:#00affa;" d="M84.333,59.733c0,14.507-11.093,25.6-25.6,25.6s-25.6-11.093-25.6-25.6s11.093-25.6,25.6-25.6 S84.333,45.227,84.333,59.733"></path> <path style="fill:#00affa;" d="M161.133,59.733c0,14.507-11.093,25.6-25.6,25.6s-25.6-11.093-25.6-25.6s11.093-25.6,25.6-25.6 S161.133,45.227,161.133,59.733"></path> <path style="fill:#00affa;" d="M237.933,59.733c0,14.507-11.093,25.6-25.6,25.6s-25.6-11.093-25.6-25.6s11.093-25.6,25.6-25.6 S237.933,45.227,237.933,59.733"></path> </g> <g> <path style="fill:#fffa66;" d="M459.8,307.2c0,18.773-15.36,34.133-34.133,34.133s-34.133-15.36-34.133-34.133 s15.36-34.133,34.133-34.133S459.8,288.427,459.8,307.2"></path> <path style="fill:#fffa66;" d="M263.533,384c0,18.773-15.36,34.133-34.133,34.133s-34.133-15.36-34.133-34.133 c0-18.773,15.36-34.133,34.133-34.133S263.533,365.227,263.533,384"></path> </g> <g> <path style="fill:#00affa;" d="M118.467,307.2c0,18.773-15.36,34.133-34.133,34.133S50.2,325.973,50.2,307.2 s15.36-34.133,34.133-34.133S118.467,288.427,118.467,307.2"></path> <path style="fill:#00affa;" d="M340.333,221.867c0,18.773-15.36,34.133-34.133,34.133s-34.133-15.36-34.133-34.133 s15.36-34.133,34.133-34.133S340.333,203.093,340.333,221.867"></path> </g> <path d="M58.733,93.867c-18.773,0-34.133-15.36-34.133-34.133S39.96,25.6,58.733,25.6s34.133,15.36,34.133,34.133 S77.507,93.867,58.733,93.867z M58.733,42.667c-9.387,0-17.067,7.68-17.067,17.067S49.347,76.8,58.733,76.8S75.8,69.12,75.8,59.733 S68.12,42.667,58.733,42.667z"></path> <path d="M135.533,93.867c-18.773,0-34.133-15.36-34.133-34.133S116.76,25.6,135.533,25.6s34.133,15.36,34.133,34.133 S154.307,93.867,135.533,93.867z M135.533,42.667c-9.387,0-17.067,7.68-17.067,17.067s7.68,17.067,17.067,17.067 S152.6,69.12,152.6,59.733S144.92,42.667,135.533,42.667z"></path> <path d="M212.333,93.867c-18.773,0-34.133-15.36-34.133-34.133S193.56,25.6,212.333,25.6s34.133,15.36,34.133,34.133 S231.107,93.867,212.333,93.867z M212.333,42.667c-9.387,0-17.067,7.68-17.067,17.067s7.68,17.067,17.067,17.067 S229.4,69.12,229.4,59.733S221.72,42.667,212.333,42.667z"></path> <path d="M511,119.467H-1v-94.72C-1,11.093,10.093,0,23.747,0h463.36C499.907,0,511,11.093,511,24.747V119.467z M16.067,102.4 h477.867V24.747c0-4.267-3.413-7.68-7.68-7.68H23.747c-4.267,0-7.68,3.413-7.68,7.68V102.4z"></path> <path d="M483.693,512H26.307C10.947,512-1,500.053-1,484.693V102.4h512v382.293C511,500.053,499.053,512,483.693,512z M16.067,119.467v365.227c0,5.973,4.267,10.24,10.24,10.24h457.387c5.973,0,10.24-4.267,10.24-10.24V119.467H16.067z"></path> <path d="M84.333,349.867c-23.893,0-42.667-18.773-42.667-42.667c0-23.893,18.773-42.667,42.667-42.667S127,283.307,127,307.2 C127,331.093,108.227,349.867,84.333,349.867z M84.333,281.6c-14.507,0-25.6,11.093-25.6,25.6s11.093,25.6,25.6,25.6 s25.6-11.093,25.6-25.6S98.84,281.6,84.333,281.6z"></path> <path d="M425.667,349.867c-23.893,0-42.667-18.773-42.667-42.667c0-23.893,18.773-42.667,42.667-42.667 s42.667,18.773,42.667,42.667C468.333,331.093,449.56,349.867,425.667,349.867z M425.667,281.6c-14.507,0-25.6,11.093-25.6,25.6 s11.093,25.6,25.6,25.6s25.6-11.093,25.6-25.6S440.173,281.6,425.667,281.6z"></path> <path d="M306.2,264.533c-23.893,0-42.667-18.773-42.667-42.667S282.307,179.2,306.2,179.2c23.893,0,42.667,18.773,42.667,42.667 S330.093,264.533,306.2,264.533z M306.2,196.267c-14.507,0-25.6,11.093-25.6,25.6c0,14.507,11.093,25.6,25.6,25.6 s25.6-11.093,25.6-25.6C331.8,207.36,320.707,196.267,306.2,196.267z"></path> <path d="M229.4,426.667c-23.893,0-42.667-18.773-42.667-42.667c0-23.893,18.773-42.667,42.667-42.667s42.667,18.773,42.667,42.667 C272.067,407.893,253.293,426.667,229.4,426.667z M229.4,358.4c-14.507,0-25.6,11.093-25.6,25.6c0,14.507,11.093,25.6,25.6,25.6 c14.507,0,25.6-11.093,25.6-25.6C255,369.493,243.907,358.4,229.4,358.4z"></path> <path d="M195.267,375.467c-1.707,0-2.56,0-4.267-0.853l-76.8-42.667c-4.267-2.56-5.973-7.68-3.413-11.947 c2.56-4.267,7.68-5.973,11.947-3.413l76.8,42.667c4.267,2.56,5.973,7.68,3.413,11.947 C201.24,373.76,198.68,375.467,195.267,375.467z"></path> <path d="M246.467,358.4c-0.853,0-2.56,0-3.413-0.853c-4.267-1.707-5.973-6.827-4.267-11.093l42.667-93.867 c1.707-4.267,6.827-5.973,11.093-4.267c4.267,1.707,5.973,6.827,4.267,11.093l-42.667,93.867 C252.44,356.693,249.88,358.4,246.467,358.4z"></path> <path d="M391.533,290.133c-1.707,0-3.413-0.853-5.12-1.707l-51.2-34.133c-4.267-2.56-5.12-7.68-2.56-11.947 c2.56-4.267,7.68-5.12,11.947-2.56l51.2,34.133c4.267,2.56,5.12,7.68,2.56,11.947C396.653,288.427,394.093,290.133,391.533,290.133 z"></path> </g> </g></svg>            
                    </div>
                    <div>
                        <p id="mode-btn-text" class="text-right duration-700">流程形式<p>
                    </div>
                </button>

        </div>

        <div id="realtime-data" class="grid place-items-center mt-4 duration-500">
            <img class="w-4/5 pb-4" src="{{ asset('img/flow-chart.png') }}" alt="flow chart" />
        </div>
    </div>
</x-app-layout>