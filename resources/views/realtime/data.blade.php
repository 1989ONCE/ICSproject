@section('title', '即時資料')
<x-app-layout>
    
    <div class="flex flex-row">
        <div class="w-48 h-[420px] min-w-fit max-w-3xl ml-4 mt-24 grid content-around">
                <div class="w-48 h-32 bg-indigo-300 grid place-items-center rounded-md hover:bg-indigo-400">
                    <span class="font-semibold text-lg text-white tracking-tight hover:text-white">點擊按鈕切換顯示方式</span>
                    <button 
                        id="button-border"
                        class="flex items-center border-solid border w-32 rounded-full bg-white transition duration-300 focus:outline-none shadow"
                        onclick="toggleTheme()">
                        <div
                            id="switch-toggle"
                            class="w-12 h-12 relative rounded-full transition duration-500 transform bg-sky-700 -translate-x-2 p-2 text-white items-center">
                            <img class="w-full pb-4" src="{{ asset('img/svg/gui_icon.svg') }}" alt="guiIcon" />                    
                        </div>
                        <div>
                            <p id="mode-btn-text" class="text-right duration-700">流程形式<p>
                        </div>
                    </button>                  
                </div>
                <div class="pt-10 text-center">
                    <span class="text-base font-bold leading-tight">可選擇之預測模型結果<span>
                    <form method="get" action="{{ route('predData')}}">
                        <select name="option" onchange='this.form.submit()' class="bg-white border border-gray-300 text-gray-600 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($models as $model)
                                <option value="{{$model->model_id}}" @if($option == $model->model_id) selected @endif>{{$model->model_name}}</option>
                            @endforeach  
                        </select>
                    </form>
                </div>
                <img class="w-36 place-items-bottom translate-x-[1.2rem] pt-20" src="{{ asset('img/sign.png') }}" alt="sign" />  
        </div>
        <div id="realtime-data" class="relative mt-2 h-full shrink-0 duration-500">
            <img class="w-[66rem] px-2" src="{{ asset('img/flow-chart.png') }}" alt="flow chart" />
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
        const Excel = ` <div class="mb"><span id="time" class="text-xl flex justify-center"></span></div>
                        <div class="table w-full lg:w-[64.5rem] duration-500 mb-4 border border-gray-600 inline-block min-w-full overflow-hidden rounded-lg shadow">
                            <div class="table-header-group h-16">
                                <div class="table-row">
                                    <div class="px-2 font-bold uppercase bg-white text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle"></div>
                                    <div class="px-2 font-bold uppercase bg-[#dedbff] text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle">放流槽ph值</div>
                                    <div class="px-2 font-bold uppercase bg-[#dedbff] text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle">放流槽水溫</div>
                                    <div class="px-2 font-bold uppercase bg-[#dedbff] text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle">放流槽導電度</div>
                                    <div class="px-2 font-bold uppercase bg-[#dedbff] text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle">放流槽COD</div>
                                    <div class="px-2 font-bold uppercase bg-[#dedbff] text-gray-600 border-b border-gray-600 table-cell text-center align-middle">完整流程之告警狀態</div>
                                </div>
                            </div>
                            <div id="json_out" class="table-row bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <div class="grid grid-rows-2">
                                    <div class="px-2 row-span-1 bg-gray-200 w-full lg:w-auto text-gray-800 text-center border-b border-r border-gray-600 block table-cell relative lg:static">數值</div>
                                    <div class="px-2 row-span-1 bg-gray-200 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">狀態</div>
                                </div>
                                <div class="table-cell">
                                    <div class="grid grid-rows-2">
                                        <div id="excel_out_ph" class="w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                        <div class="grid w-full lg:w-auto text-gray-800 text-center border block table-cell relative lg:static">
                                            <div id="complete-1" class="place-self-center w-4 h-4 rounded-full"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-cell">
                                    <div class="grid grid-rows-2">
                                        <div id="excel_out_temp" class="w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                        <div class="grid w-full lg:w-auto text-gray-800 text-center border block table-cell relative lg:static"> 
                                            <div id="complete-2" class="place-self-center w-4 h-4 rounded-full"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-cell ">
                                    <div class="grid grid-rows-2">
                                        <div id="excel_out_ec" class="w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                        <div class="grid w-full lg:w-auto text-gray-800 text-center border block table-cell relative lg:static">
                                            <div id="complete-3" class="place-self-center w-4 h-4 rounded-full"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-cell">
                                    <div class="grid grid-rows-2">
                                        <div id="excel_out_cod" class="w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                        <div class="grid w-full lg:w-auto text-gray-800 text-center border block table-cell relative lg:static">
                                            <div id="complete-4" class="place-self-center w-4 h-4 rounded-full"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-span-2 grid w-full lg:w-auto text-gray-800 text-center block table-cell relative lg:static">
                                    <div id="complete" class="place-self-center translate-y-4 w-4 h-4 rounded-full"></div>
                                </div>                            
                            </div>
                        </div>

                        <div class="table w-full lg:w-[64.5rem] duration-500 mb-4 border border-gray-600 inline-block min-w-full overflow-hidden rounded-lg shadow">
                            <div class="table-header-group h-16">
                                <div class="table-row">
                                    <div class="px-2 font-bold uppercase bg-white text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle"></div>
                                    <div class="px-2 font-bold uppercase bg-[#f5ffc6] text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle">ph中和槽</div>
                                    <div class="px-2 font-bold uppercase bg-[#f4dede] text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle">冷卻塔</div>
                                    <div class="px-2 font-bold uppercase bg-[#d7ffdd] text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle">快混槽1</div>
                                    <div class="px-2 font-bold uppercase bg-[#d7ffdd] text-gray-600 border-b border-gray-600 table-cell text-center align-middle">快混槽2</div>
                                </div>
                            </div>
                            <div class="table-row-group">
                                <div id="json_rt1" class="table-row bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                    <div class="grid grid-rows-2 grid-cols-2">
                                        <div class="bg-gray-200 row-span-2 w-full lg:w-auto text-gray-800 text-center border-b border-r border-gray-600 block table-cell relative lg:static"><div class="translate-y-3">液鹼(45%)</div>
                                    </div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">目前</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">建議</div>
                                </div>
                                <div class="table-cell">
                                    <div class="grid grid-rows-2">
                                        <div id="excel_t01_2_drug" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                        <div id="excel_t01_2_pre_drug" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">
                                        </div>
                                    </div>
                                </div>
                                <div class="table-cell">
                                    <div class="grid grid-rows-2">
                                        <div id="excel_t01_4_drug" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                        <div id="excel_t01_4_pre_drug" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    </div>
                                </div>
                                <div class="table-cell">
                                    <div class="grid grid-rows-2">
                                        <div id="excel_t01_5_drug1" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                        <div id="excel_t01_5_pre_drug1" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    </div>
                                </div>
                                <div class="table-cell">
                                    <div class="grid grid-rows-2">
                                        <div id="excel_t01_12_drug1" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                        <div id="excel_t01_12_pre_drug1" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    </div>
                                </div>    
                            </div>

                            <div id="json_rt1_2" class="table-row bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <div class="grid grid-rows-2 grid-cols-2">
                                    <div class="bg-gray-200 row-span-2 w-full lg:w-auto text-gray-800 text-center border-b border-r border-gray-600 block table-cell relative lg:static">
                                        <div class="translate-y-3">硫酸鋁(7.5%)</div>
                                    </div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">目前</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">建議</div>
                                </div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_t01_5_drug2" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                        <div id="excel_t01_5_pre_drug2" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_t01_12_drug2" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    <div id="excel_t01_12_pre_drug2" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                </div></div>
                            </div>

                            <div id="json_rt1_3" class="table-row bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <div class="grid grid-rows-2 grid-cols-2">
                                    <div class="bg-gray-200 row-span-2 w-full lg:w-auto text-gray-800 text-center border-r border-gray-600 block table-cell relative lg:static"><div class="translate-y-3">pH值</div></div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">數值</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">狀態</div>
                                </div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_t01_4_ph" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    <div class="row-span-1 grid place-content-center w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">
                                        <div id="ph-1" class="w-4 h-4 rounded-full"></div>
                                    </div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_t01_5_ph" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    <div class="row-span-1 grid place-content-center w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">
                                        <div id="ph-2" class="w-4 h-4 rounded-full"></div>
                                    </div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_t01_12_ph" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    <div class="row-span-1 grid place-content-center w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">
                                        <div id="ph-3" class="w-4 h-4 rounded-full"></div>
                                    </div>
                                </div></div>
                            </div>
                        </div>
                        </div>
                        <div class="table w-full lg:w-[64.5rem] duration-500 mb-4 border border-gray-600 inline-block min-w-full overflow-hidden rounded-lg shadow">
                            <div class="table-header-group h-16">
                                <div class="table-row">
                                    <div class="px-2 font-bold uppercase bg-white text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle"></div>
                                    <div class="px-2 font-bold uppercase bg-[#e2ebfd] text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle">慢混槽1</div>
                                    <div class="px-2 font-bold uppercase bg-[#e2ebfd] text-gray-600 border-b border-gray-600 table-cell text-center align-middle">慢混槽2</div>
                                </div>
                            </div>
                            <div class="table-row-group">
                                <div id="json_rt2" class="table-row bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                    <div class="grid grid-rows-2 grid-cols-2">
                                    <div class="bg-gray-200 row-span-2 w-full lg:w-auto text-gray-800 text-center border-r border-gray-600 block table-cell relative lg:static"><div class="translate-y-3">polymer(0.1%)</div></div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">目前</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">建議</div>
                                </div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_t01_6_drug" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    <div id="excel_t01_6_pre_drug" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">
                                    </div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_t01_13_drug" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    <div id="excel_t01_13_pre_drug" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">
                                    </div>
                                </div></div>
                                </div>
                            </div>
                        </div>
                        `

        const GuiIcon = `<img class="w-[100rem] pb-4" src="{{ asset('img/svg/gui_icon.svg') }}" alt="guiIcon" />`
        const guiText = `<p id="mode-btn-text" class="text-right duration-700">流程形式<p>`
        const Gui = `<img class="w-[66rem] px-2" src="{{ asset('img/flow-chart.png') }}" alt="flow chart" />
                     <div id="gui_t01_2_drug" class="absolute text-xl text-black top-1/4 left-1/4 -translate-x-[12.6rem] -translate-y-6"></div>
                     <div id="gui_t01_2_pre_drug" class="absolute text-xl text-black top-1/4 left-1/4 -translate-x-[11.6rem] translate-y-[36px]"></div>
                     <div id="gui_t01_4_drug" class="absolute text-xl text-black top-1/4 left-1/4 -translate-x-12 -translate-y-6"></div>
                     <div id="gui_t01_4_pre_drug" class="absolute text-xl text-black top-1/4 left-1/4 -translate-x-10 translate-y-[36px]"></div>
                     <div id="gui_t01_5_drug1" class="absolute text-xl text-black top-1/4 left-1/3 translate-x-3 -translate-y-6"></div>
                     <div id="gui_t01_5_pre_drug1" class="absolute text-xl text-black top-1/4 left-1/3 translate-x-0 translate-y-[36px]"></div>
                     <div id="gui_t01_5_drug2" class="absolute text-xl text-black top-1/4 left-1/2 -translate-x-16 -translate-y-6"></div>
                     <div id="gui_t01_5_pre_drug2" class="absolute text-xl text-black top-1/4 left-1/2 -translate-x-16 translate-y-[36px]"></div>
                     <div id="gui_t01_6_drug" class="absolute text-xl text-black top-1/4 right-1/3 -translate-x-24 -translate-y-6"></div>
                     <div id="gui_t01_6_pre_drug" class="absolute text-xl text-black top-1/4 right-1/3 -translate-x-24 translate-y-[36px]"></div>
                     <div id="gui_t01_12_drug1" class="absolute text-xl text-black top-1/4 right-1/3 translate-x-9 -translate-y-6"></div>
                     <div id="gui_t01_12_pre_drug1" class="absolute text-xl text-black top-1/4 right-1/3 translate-x-9 translate-y-[36px]"></div>
                     <div id="gui_t01_12_drug2" class="absolute text-xl text-black top-1/4 right-1/4 translate-x-[4rem] -translate-y-6"></div>
                     <div id="gui_t01_12_pre_drug2" class="absolute text-xl text-black top-1/4 right-1/4 translate-x-[3.4rem] translate-y-[36px]"></div>
                     <div id="gui_t01_13_drug" class="absolute text-xl text-black top-1/4 right-1/4 translate-x-[12.5rem] -translate-y-6"></div>
                     <div id="gui_t01_13_pre_drug" class="absolute text-xl text-black top-1/4 right-1/4 translate-x-[12.5rem] translate-y-[36px]"></div>
                     <div id="gui_t01_15_cod" class="absolute underline-offset-2 text-xl text-black bottom-1/4 right-1/2 translate-x-6 translate-y-[36px]"></div>
                     <div id="gui_t01_15_ec" class="absolute underline-offset-2 text-xl text-black bottom-1/4 right-1/2 translate-x-[10rem] translate-y-[36px]"></div>
                     <div id="gui_t01_15_temp" class="absolute underline-offset-2 text-xl text-black bottom-1/4 left-1/4 translate-x-28 translate-y-[36px]"></div>
                     <div id="gui_t01_15_ph" class="absolute underline-offset-2 text-xl text-black bottom-1/4 left-1/4 translate-x-3 translate-y-[36px]"></div>
                     <div id="sign" class="absolute w-6 h-6 rounded-full bottom-1/4 left-1/4 -translate-x-[5rem] translate-y-[42px]"></div>
                     <div id="ph_gui-1" class="absolute w-4 h-4 rounded-full top-1/2 left-1/4 -translate-x-[2.2rem] -translate-y-[18px]"></div>
                     <div id="ph_1_val" class="absolute text-lg text-black top-1/2 left-1/4 -translate-x-[0.6rem] -translate-y-[24px]"></div>
                     <div id="ph_gui-2" class="absolute w-4 h-4 rounded-full top-1/2 left-1/3 translate-x-[3.8rem] -translate-y-[14px]"></div>
                     <div id="ph_2_val" class="absolute text-lg text-black top-1/2 left-1/3 translate-x-[5.4rem] -translate-y-[20px]"></div>
                     <div id="ph_gui-3" class="absolute w-4 h-4 rounded-full top-1/2 right-1/4 -translate-x-[0.4rem] -translate-y-[16.5px]"></div>
                     <div id="ph_3_val" class="absolute text-lg text-black top-1/2 right-1/4 translate-x-[0.8rem] -translate-y-[22px]"></div>`

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
            graph.classList.add('px-2')
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
            graph.classList.remove('px-2')
            buttonBorder.classList.remove('border-2', 'border-green-800')
        }
        }

        switchTheme()
        </script>
        <script type="text/javascript">
            function update() {
                $.ajax({
                    method: "GET",
                    url : '/realtimeData',
                    data: {'_token': '{{csrf_token()}}'},
                    dataType: 'json',
                    success:function(data){
                        current = data.rts;
                        // Excel realtime data

                        // 放流口
                        document.getElementById("time").innerHTML = current.added_on;
                        document.getElementById("excel_out_ph").innerHTML = current.T01_15_ph;
                        document.getElementById("excel_out_temp").innerHTML = current.T01_15_temp;
                        document.getElementById("excel_out_ec").innerHTML = current.T01_15_ec;
                        document.getElementById("excel_out_cod").innerHTML = current.T01_15_cod;

                        // 其他槽體
                        document.getElementById("excel_t01_2_drug").innerHTML = current.T01_2_drug;
                        document.getElementById("excel_t01_4_drug").innerHTML = current.T01_4_drug;
                        document.getElementById("excel_t01_4_ph").innerHTML = current.T01_4_ph;
                        document.getElementById("excel_t01_5_drug1").innerHTML = current.T01_5_drug1;
                        document.getElementById("excel_t01_5_drug2").innerHTML = current.T01_5_drug2;
                        document.getElementById("excel_t01_5_ph").innerHTML = current.T01_5_ph;
                        document.getElementById("excel_t01_12_drug1").innerHTML = current.T01_12_drug1;
                        document.getElementById("excel_t01_12_drug2").innerHTML = current.T01_12_drug2;
                        document.getElementById("excel_t01_12_ph").innerHTML = current.T01_12_ph;
                        document.getElementById("excel_t01_6_drug").innerHTML = current.T01_6_drug;
                        document.getElementById("excel_t01_13_drug").innerHTML = current.T01_13_drug;

                        // excel 完整流程燈號
                        const complete = document.querySelector('#complete');
                        complete.classList.remove('bg-[#4cb631]');
                        complete.classList.remove('bg-[#ffa100]');
                        complete.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_15_cod) >= 18){
                            complete.classList.add('bg-[#4cb631]');
                        }
                        else if(parseInt(current.T01_15_cod) < 18 && parseInt(current.data3) > 15){
                            complete.classList.add('bg-[#ffa100]');
                        }
                        else {
                            complete.classList.add('bg-[#ff1616]');
                        }

                        // excel 放流口ph值燈號
                        const complete_1 = document.querySelector('#complete-1');
                        complete_1.classList.remove('bg-[#4cb631]');
                        complete_1.classList.remove('bg-[#ffa100]');
                        complete_1.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_15_ph) >= 7){
                            complete_1.classList.add('bg-[#4cb631]');
                        }
                        else if(parseInt(current.T01_15_ph) < 7 && parseInt(current.data3) > 6){
                            complete_1.classList.add('bg-[#ffa100]');
                        }
                        else {
                            complete_1.classList.add('bg-[#ff1616]');
                        }

                        // excel 放流口水溫燈號
                        const complete_2 = document.querySelector('#complete-2');
                        complete_2.classList.remove('bg-[#4cb631]');
                        complete_2.classList.remove('bg-[#ffa100]');
                        complete_2.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_15_temp) >= 22){
                            complete_2.classList.add('bg-[#4cb631]');
                        }
                        else if(parseInt(current.T01_15_temp) < 22 && parseInt(current.data3) > 20){
                            complete_2.classList.add('bg-[#ffa100]');
                        }
                        else {
                            complete_2.classList.add('bg-[#ff1616]');
                        }

                        // excel 放流口導電度燈號
                        const complete_3 = document.querySelector('#complete-3');
                        complete_3.classList.remove('bg-[#4cb631]');
                        complete_3.classList.remove('bg-[#ffa100]');
                        complete_3.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_15_ec) >= 18){
                            complete_3.classList.add('bg-[#4cb631]');
                        }
                        else if(parseInt(current.T01_15_ec) < 18 && parseInt(current.data3) > 16){
                            complete_3.classList.add('bg-[#ffa100]');
                        }
                        else {
                            complete_3.classList.add('bg-[#ff1616]');
                        }
                        

                        // 放流口COD燈號
                        const complete_4 = document.querySelector('#complete-4');
                        complete_4.classList.remove('bg-[#4cb631]');
                        complete_4.classList.remove('bg-[#ffa100]');
                        complete_4.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_15_cod) >= 18){
                            complete_4.classList.add('bg-[#4cb631]');
                        }
                        else if(parseInt(current.T01_15_cod) < 18 && parseInt(current.data3) > 16){
                            complete_4.classList.add('bg-[#ffa100]');
                        }
                        else {
                            complete_4.classList.add('bg-[#ff1616]');
                        }

                    // excel t01-4 ph燈號
                    const ph_1 = document.querySelector('#ph-1');
                        ph_1.classList.remove('bg-[#4cb631]');
                        ph_1.classList.remove('bg-[#ffa100]');
                        ph_1.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_4_ph) >= 8){
                            ph_1.classList.add('bg-[#4cb631]');
                        }
                        else if(parseInt(current.T01_4_ph) < 8 && parseInt(current.T01_4_ph) > 6){
                            ph_1.classList.add('bg-[#ffa100]');
                        }
                        else {
                            ph_1.classList.add('bg-[#ff1616]');
                        }
                    
                    // excel t01-5 ph燈號
                    const ph_2 = document.querySelector('#ph-2');
                        ph_2.classList.remove('bg-[#4cb631]');
                        ph_2.classList.remove('bg-[#ffa100]');
                        ph_2.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_5_ph) >= 8){
                            ph_2.classList.add('bg-[#4cb631]');
                        }
                        else if(parseInt(current.T01_5_ph) < 8 && parseInt(current.T01_5_ph) > 6){
                            ph_2.classList.add('bg-[#ffa100]');
                        }
                        else {
                            ph_2.classList.add('bg-[#ff1616]');
                        }

                    // excel t01-12 ph燈號
                    const ph_3 = document.querySelector('#ph-3');
                        ph_3.classList.remove('bg-[#4cb631]');
                        ph_3.classList.remove('bg-[#ffa100]');
                        ph_3.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_12_ph) >= 8){
                            ph_3.classList.add('bg-[#4cb631]');
                        }
                        else if(parseInt(current.T01_12_ph) < 8 && parseInt(current.T01_12_ph) > 6){
                            ph_3.classList.add('bg-[#ffa100]');
                        }
                        else {
                            ph_3.classList.add('bg-[#ff1616]');
                        }                    
                    },
                    error: function(errmsg) {
                       console.log("Ajax獲取伺服器資料出現錯誤！"+ errmsg);
                    },
                })

                // GUI realtime
                document.getElementById("gui_t01_2_drug").innerHTML = current.T01_2_drug;
                document.getElementById("gui_t01_4_drug").innerHTML = current.T01_4_drug;
                document.getElementById("ph_1_val").innerHTML = current.T01_4_ph;
                document.getElementById("gui_t01_5_drug1").innerHTML = current.T01_5_drug1;
                document.getElementById("gui_t01_5_drug2").innerHTML = current.T01_5_drug2;
                document.getElementById("ph_2_val").innerHTML = current.T01_5_ph;
                document.getElementById("gui_t01_6_drug").innerHTML = current.T01_6_drug;
                document.getElementById("gui_t01_12_drug1").innerHTML = current.T01_12_drug1;
                document.getElementById("gui_t01_12_drug2").innerHTML = current.T01_12_drug2;
                document.getElementById("ph_3_val").innerHTML = current.T01_12_ph;
                document.getElementById("gui_t01_13_drug").innerHTML = current.T01_13_drug;

                // gui放流槽
                document.getElementById("gui_t01_15_ph").innerHTML = current.T01_15_ph;
                document.getElementById("gui_t01_15_temp").innerHTML = current.T01_15_temp;
                document.getElementById("gui_t01_15_ec").innerHTML = current.T01_15_ec;
                document.getElementById("gui_t01_15_cod").innerHTML = current.T01_15_cod;

                // gui 完整流程燈號
                const sign = document.querySelector('#sign');
                sign.classList.remove('bg-[#4cb631]');
                sign.classList.remove('bg-[#ffa100]');
                sign.classList.remove('bg-[#ff1616]');
                if(parseInt(current.T01_15_cod) >= 18){
                    sign.classList.add('bg-[#4cb631]');
                }
                else if(parseInt(current.T01_15_cod) < 18 && parseInt(current.T01_15_cod) > 16){
                    sign.classList.add('bg-[#ffa100]');
                }
                else {
                    sign.classList.add('bg-[#ff1616]');
                }

                const ph_gui_1 = document.querySelector('#ph_gui-1');
                ph_gui_1.classList.remove('bg-[#4cb631]');
                ph_gui_1.classList.remove('bg-[#ffa100]');
                ph_gui_1.classList.remove('bg-[#ff1616]');
                if(parseInt(current.T01_4_ph) >= 8){
                    ph_gui_1.classList.add('bg-[#4cb631]');
                }
                else if(parseInt(current.T01_4_ph) < 8 && parseInt(current.T01_4_ph) > 6){
                    ph_gui_1.classList.add('bg-[#ffa100]');
                }
                else {
                    ph_gui_1.classList.add('bg-[#ff1616]');
                }

                const ph_gui_2 = document.querySelector('#ph_gui-2');
                ph_gui_2.classList.remove('bg-[#4cb631]');
                ph_gui_2.classList.remove('bg-[#ffa100]');
                ph_gui_2.classList.remove('bg-[#ff1616]');
                if(parseInt(current.T01_5_ph) >= 8){
                    ph_gui_2.classList.add('bg-[#4cb631]');
                }
                else if(parseInt(current.T01_5_ph) < 8 && parseInt(current.T01_5_ph) > 6){
                    ph_gui_2.classList.add('bg-[#ffa100]');
                }
                else {
                    ph_gui_2.classList.add('bg-[#ff1616]');
                }

                const ph_gui_3 = document.querySelector('#ph_gui-3');
                ph_gui_3.classList.remove('bg-[#4cb631]');
                ph_gui_3.classList.remove('bg-[#ffa100]');
                ph_gui_3.classList.remove('bg-[#ff1616]');
                if(parseInt(current.T01_12_ph) >= 8){
                    ph_gui_3.classList.add('bg-[#4cb631]');
                }
                else if(parseInt(current.T01_12_ph) < 8 && parseInt(current.T01_12_ph) > 6){
                    ph_gui_3.classList.add('bg-[#ffa100]');
                }
                else {
                    ph_gui_3.classList.add('bg-[#ff1616]');
                }
            }
           
            setInterval(update, 1000); //every 1 secs
        </script>
        <script type="text/javascript">

            function getPredData() {
                $.ajax({
                    method: "POST",
                    url : '/realtimeOption',
                    data: {'option': '{{$option}}', '_token': '{{csrf_token()}}'},
                    dataType: 'json',
                    success:function(data){
                        pred = data.pred;
                        // Excel pred data

                        // 其他槽體
                        document.getElementById("excel_t01_2_pre_drug").innerHTML = pred.T01_2_pre_drug;
                        document.getElementById("excel_t01_4_pre_drug").innerHTML = pred.T01_4_pre_drug;
                        document.getElementById("excel_t01_5_pre_drug1").innerHTML = pred.T01_5_pre_drug1;
                        document.getElementById("excel_t01_5_pre_drug2").innerHTML = pred.T01_5_pre_drug2;
                        document.getElementById("excel_t01_12_pre_drug1").innerHTML = pred.T01_12_pre_drug1;
                        document.getElementById("excel_t01_12_pre_drug2").innerHTML = pred.T01_12_pre_drug2;
                        document.getElementById("excel_t01_6_pre_drug").innerHTML = pred.T01_6_pre_drug;
                        document.getElementById("excel_t01_13_pre_drug").innerHTML = pred.T01_13_pre_drug;
                    },
                    error: function(errmsg) {
                       console.log("Ajax獲取伺服器資料出現錯誤！"+ errmsg);
                    },
                })
                // GUI pred
                document.getElementById("gui_t01_2_pre_drug").innerHTML = pred.T01_2_pre_drug;
                document.getElementById("gui_t01_4_pre_drug").innerHTML = pred.T01_4_pre_drug;
                document.getElementById("gui_t01_5_pre_drug1").innerHTML = pred.T01_5_pre_drug1;
                document.getElementById("gui_t01_5_pre_drug2").innerHTML = pred.T01_5_pre_drug2;
                document.getElementById("gui_t01_6_pre_drug").innerHTML = pred.T01_6_pre_drug;
                document.getElementById("gui_t01_12_pre_drug1").innerHTML = pred.T01_12_pre_drug1;
                document.getElementById("gui_t01_12_pre_drug2").innerHTML = pred.T01_12_pre_drug2;
                document.getElementById("gui_t01_13_pre_drug").innerHTML = pred.T01_13_pre_drug;
            }
            setInterval(getPredData, 1000); //every 1 secs
        </script>
    </x-slot>
</x-app-layout>