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
                    <span class="text-base font-bold leading-tight uppercase">可選擇之預測模型結果<span>
                    <form method="get" action="{{ route('predData')}}">
                        <select name="option" onchange='this.form.submit()' class="uppercase bg-white border border-gray-300 text-gray-600 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
        const Excel = ` <div class="mb"><span id="time" class="text-xl flex justify-center">資料更新時間：</span></div>
                        
                        <div class="table w-full lg:w-[64.5rem] duration-500 mb-4 border border-gray-600 inline-block min-w-full overflow-hidden rounded-lg shadow">
                            <div class="table-header-group h-16">
                                <div class="table-row">
                                    <div class="px-2 font-bold uppercase bg-white text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle"></div>
                                    <div class="px-2 font-bold uppercase bg-[#f5ffc6] text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle">T01-6 慢混槽1</div>
                                    <div class="px-2 font-bold uppercase bg-[#f4dede] text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle">T01-12 慢混槽2</div>
                                    <div class="px-2 font-bold uppercase bg-[#d7ffdd] text-gray-600 border-b border-r border-gray-600 table-cell text-center align-middle">T01-14 放流槽</div>
                                </div>
                            </div>
                            <div class="table-row-group">
                                <div id="json_rt1" class="table-row bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                    <div class="grid grid-rows-2 grid-cols-2">
                                        <div class="bg-gray-200 row-span-2 w-full lg:w-auto text-gray-800 text-center border-r border-gray-600 block table-cell relative lg:static"><div class="translate-y-3">液鹼(45%)</div>
                                    </div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">瞬間流量</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">累積流量</div>
                                </div>
                                <div class="table-cell">
                                    <div class="grid grid-rows-2">
                                        <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                        <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                    </div>
                                </div>
                                <div class="table-cell">
                                    <div class="grid grid-rows-2">
                                        <div id="excel_drug1" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                        <div id="excel_drug1_daily" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    </div>
                                </div>
                                <div class="table-cell">
                                    <div class="grid grid-rows-2">
                                        <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                        <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                    </div>
                                </div>
                                
                            </div>

                            <div id="json_rt1_2" class="table-row bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <div class="grid grid-rows-2 grid-cols-2">
                                    <div class="bg-gray-200 row-span-2 w-full lg:w-auto text-gray-800 text-center border-r border-gray-600 block table-cell relative lg:static">
                                        <div class="translate-y-3">硫酸鋁(7.5%)</div>
                                    </div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">瞬間流量</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">累積流量</div>
                                </div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_drug2" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    <div id="excel_drug2_daily" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                </div></div>
                            </div>

                            <div id="json_rt1_3" class="table-row bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <div class="grid grid-rows-2 grid-cols-2">
                                    <div class="bg-gray-200 row-span-2 w-full lg:w-auto text-gray-800 text-center border-r border-gray-600 block table-cell relative lg:static"><div class="translate-y-3">pH值(前)</div></div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">數值</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">狀態</div>
                                </div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_ph1" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    <div class="row-span-1 grid place-content-center w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">
                                        <div id="ph-1" class="w-4 h-4 rounded-full"></div>
                                    </div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_ph3" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    <div class="row-span-1 grid place-content-center w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">
                                        <div id="ph-3" class="w-4 h-4 rounded-full"></div>
                                    </div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                </div></div>
                            </div>

                            <div id="json_rt1_4" class="table-row bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <div class="grid grid-rows-2 grid-cols-2">
                                    <div class="bg-gray-200 row-span-2 w-full lg:w-auto text-gray-800 text-center border-r border-gray-600 block table-cell relative lg:static"><div class="translate-y-3">pH值(後)</div></div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">數值</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">狀態</div>
                                </div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_ph2" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    <div class="row-span-1 grid place-content-center w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">
                                        <div id="ph-2" class="w-4 h-4 rounded-full"></div>
                                    </div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_ph4" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    <div class="row-span-1 grid place-content-center w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">
                                        <div id="ph-4" class="w-4 h-4 rounded-full"></div>
                                    </div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_ph5" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    <div class="row-span-1 grid place-content-center w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">
                                        <div id="ph-5" class="w-4 h-4 rounded-full"></div>
                                    </div>
                                </div></div>
                            </div>

                            <div id="json_rt1_5" class="table-row bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <div class="grid grid-rows-2 grid-cols-2">
                                <div class="bg-gray-200 row-span-2 w-full lg:w-auto text-gray-800 text-center border-r border-gray-600 block table-cell relative lg:static"><div class="translate-y-3">SS懸浮粒子</div></div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">數值</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">狀態</div>
                                </div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div id="excel_ss" class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static"></div>
                                    <div class="row-span-1 grid place-content-center w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">
                                        <div id="ss" class="w-4 h-4 rounded-full"></div>
                                    </div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-b block table-cell relative lg:static">——</div>
                                </div></div>
                            </div>

                            <div id="json_rt1_6" class="table-row bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <div class="grid grid-rows-2 grid-cols-2">
                                    <div class="bg-gray-200 row-span-2 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 border-t-gray-100 block table-cell relative lg:static"><div class="translate-y-3">放流水質</div></div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">預測之放流SS值</div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center border border-r-gray-600 block relative lg:static">水質狀況燈號</div>
                                </div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center block table-cell relative lg:static"></div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center block table-cell relative lg:static"></div>
                                </div></div>

                                <div class="table-cell"><div class="grid grid-rows-2">
                                <div id="excel_pred_ss" class="row-span-1 w-full lg:w-auto text-gray-800 text-center block table-cell relative lg:static"></div>
                                    <div class="row-span-1 grid place-content-center w-full lg:w-auto text-gray-800 text-center block table-cell relative lg:static">
                                        <div id="complete" class="w-4 h-4 rounded-full"></div>
                                    </div>
                                </div></div>
                                <div class="table-cell"><div class="grid grid-rows-2">
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center block table-cell relative lg:static"></div>
                                    <div class="row-span-1 w-full lg:w-auto text-gray-800 text-center block table-cell relative lg:static"></div>
                                </div></div>
                            </div>
                        </div>
                        `

        const GuiIcon = `<img class="w-[100rem] pb-4" src="{{ asset('img/svg/gui_icon.svg') }}" alt="guiIcon" />`
        const guiText = `<p id="mode-btn-text" class="text-right duration-700">流程形式<p>`
        const Gui = `<img class="w-[66rem] px-2" src="{{ asset('img/flow-chart.png') }}" alt="flow chart" />
                     <div id="gui_t01_6_ph_pre" class="absolute text-3xl text-black top-1/4 left-1/4 -translate-x-[9.6rem] -translate-y-2"></div>
                     <div id="gui_t01_6_ph_aft" class="absolute text-3xl text-black top-1/4 left-1/4 -translate-y-2"></div>
                     <div id="gui_t01_6_ss" class="absolute text-3xl text-black top-1/4 left-1/4 -translate-x-[6.6rem] translate-y-[130px]"></div>
                     <div id="gui_t01_12_ph_pre" class="absolute text-3xl text-black top-1/4 left-1/2 -translate-x-[2.9rem] translate-y-[145px]"></div>
                     <div id="gui_t01_12_ph_aft" class="absolute text-3xl text-black top-1/4 left-1/2 translate-x-[5.3rem] translate-y-[145px]"></div>
                     <div id="gui_t01_12_drug1" class="absolute text-2xl text-black top-1/4 left-1/2 -translate-x-[8rem] -translate-y-8"></div>
                     <div id="gui_t01_12_daily_drug1" class="absolute text-2xl text-black top-1/4 left-1/2 -translate-x-[8rem] translate-y-10"></div>
                     <div id="gui_t01_12_drug2" class="absolute text-2xl text-black top-1/4 right-1/3 -translate-x-[2.6rem] -translate-y-8"></div>
                     <div id="gui_t01_12_daily_drug2" class="absolute text-2xl text-black top-1/4 right-1/3 -translate-x-[2.6rem] translate-y-10"></div>


                     <div id="gui_t01_14_ph" class="absolute text-3xl text-black top-1/4 right-1/4 translate-x-[5rem] -translate-y-12"></div>
                     <div id="gui_pred_ss" class="absolute text-3xl text-black top-1/4 right-1/4 translate-x-[5rem] translate-y-12"></div>
                     <div id="gui_time" class="absolute text-lg text-black bottom-1/4 left-1/4 -translate-x-[8rem] translate-y-[126px]"></div>

                     
                     <div id="sign" class="absolute w-8 h-8 rounded-full top-1/4 left-3/4 -translate-x-5 translate-y-36"></div>
                     <div id="ph_gui-1" class="absolute w-7 h-7 rounded-full top-1/4 left-1/4 -translate-x-[12rem] -translate-y-[2px]"></div>
                     <div id="ph_gui-2" class="absolute w-7 h-7 rounded-full top-1/4 left-1/4 -translate-x-[2.5rem] -translate-y-[2px]"></div>
                     <div id="ss_gui" class="absolute w-7 h-7 rounded-full top-1/2 left-1/4 -translate-x-[9rem] translate-y-[3px]"></div>
                     <div id="ph_gui-3" class="absolute w-6 h-6 rounded-full top-1/2 left-1/2 -translate-x-[5.1rem] translate-y-[20px]"></div>
                     <div id="ph_gui-4" class="absolute w-6 h-6 rounded-full top-1/2 right-1/2 translate-x-[4.8rem] translate-y-[20px]"></div>
                     <div id="ph_gui-5" class="absolute w-7 h-7 rounded-full top-1/2 right-1/4 translate-x-[0.5rem] -translate-y-[176px]"></div>
                     <div id="pred_ss_gui" class="absolute w-7 h-7 rounded-full top-1/3 right-1/4 translate-x-[0.5rem] translate-y-[10px]"></div>`
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

                        document.getElementById("time").innerHTML = '資料更新時間：'+ current.added_on;
                        document.getElementById("excel_ph1").innerHTML = current.T01_6_ph_pre;
                        document.getElementById("excel_ph2").innerHTML = current.T01_6_ph_aft;
                        document.getElementById("excel_ph3").innerHTML = current.T01_12_ph_pre;
                        document.getElementById("excel_ph4").innerHTML = current.T01_12_ph_aft;
                        document.getElementById("excel_ss").innerHTML = current.T01_6_ss;
                        document.getElementById("excel_ph5").innerHTML = current.T01_14_ph;

                        document.getElementById("excel_drug1").innerHTML = current.T01_12_drug1_current;
                        document.getElementById("excel_drug1_daily").innerHTML = current.T01_12_drug1_daily;
                        document.getElementById("excel_drug2").innerHTML = current.T01_12_drug2_current;
                        document.getElementById("excel_drug2_daily").innerHTML = current.T01_12_drug2_daily;

                        // excel 放流口ph值燈號
                        const complete = document.querySelector('#complete');
                        complete.classList.remove('bg-[#4cb631]');
                        complete.classList.remove('bg-[#ffa100]');
                        complete.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_14_ph) < 6 && parseInt(current.T01_14_ph) > 9){
                            complete.classList.add('bg-[#ff1616]'); //red(danger)
                        }
                        else if(parseInt(current.T01_14_ph) < 7 || parseInt(current.T01_14_ph) > 8){
                            complete.classList.add('bg-[#ffa100]'); //orange(warning)
                        }
                        else {
                            complete.classList.add('bg-[#4cb631]'); //green(normal)
                        }

                    // excel t01-6 ph(前)燈號
                    const ph_1 = document.querySelector('#ph-1');
                        ph_1.classList.remove('bg-[#4cb631]');
                        ph_1.classList.remove('bg-[#ffa100]');
                        ph_1.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_6_ph_pre) < 6 && parseInt(current.T01_6_ph_pre) > 9){
                            ph_1.classList.add('bg-[#ff1616]'); //red(danger)
                        }
                        else if(parseInt(current.T01_6_ph_pre) < 7 || parseInt(current.T01_6_ph_pre) > 8){
                            ph_1.classList.add('bg-[#ffa100]'); //orange(warning)
                        }
                        else {
                            ph_1.classList.add('bg-[#4cb631]'); //green(normal)
                        }
                    
                    // excel t01-6 ph(後)燈號
                    const ph_2 = document.querySelector('#ph-2');
                        ph_2.classList.remove('bg-[#4cb631]');
                        ph_2.classList.remove('bg-[#ffa100]');
                        ph_2.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_6_ph_aft) < 6 && parseInt(current.T01_6_ph_aft) > 9){
                            ph_2.classList.add('bg-[#ff1616]'); //red(danger)
                        }
                        else if(parseInt(current.T01_6_ph_aft) < 7 || parseInt(current.T01_6_ph_aft) > 8){
                            ph_2.classList.add('bg-[#ffa100]'); //orange(warning)
                        }
                        else {
                            ph_2.classList.add('bg-[#4cb631]'); //green(normal)
                        }

                    // excel t01-12 ph(前)燈號
                    const ph_3 = document.querySelector('#ph-3');
                        ph_3.classList.remove('bg-[#4cb631]');
                        ph_3.classList.remove('bg-[#ffa100]');
                        ph_3.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_12_ph_pre) < 6 && parseInt(current.T01_12_ph_pre) > 9){
                            ph_3.classList.add('bg-[#ff1616]'); //red(danger)
                        }
                        else if(parseInt(current.T01_12_ph_pre) < 7 || parseInt(current.T01_12_ph_pre) > 8){
                            ph_3.classList.add('bg-[#ffa100]'); //orange(warning)
                        }
                        else {
                            ph_3.classList.add('bg-[#4cb631]'); //green(normal)
                        }
                        
                    // excel t01-12 ph(後)燈號
                    const ph_4 = document.querySelector('#ph-4');
                        ph_4.classList.remove('bg-[#4cb631]');
                        ph_4.classList.remove('bg-[#ffa100]');
                        ph_4.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_12_ph_aft) < 6 && parseInt(current.T01_12_ph_aft) > 9){
                            ph_4.classList.add('bg-[#ff1616]'); //red(danger)
                        }
                        else if(parseInt(current.T01_12_ph_aft) < 7 || parseInt(current.T01_12_ph_aft) > 8){
                            ph_4.classList.add('bg-[#ffa100]'); //orange(warning)
                        }
                        else {
                            ph_4.classList.add('bg-[#4cb631]'); //green(normal)
                        } 
                    
                    // excel t01-6 ss燈號
                    const ss = document.querySelector('#ss');
                        ss.classList.remove('bg-[#4cb631]');
                        ss.classList.remove('bg-[#ffa100]');
                        ss.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_6_ss) < 6 && parseInt(current.T01_6_ss) > 9){
                            ss.classList.add('bg-[#ff1616]'); //red(danger)
                        }
                        else if(parseInt(current.T01_6_ss) < 7 || parseInt(current.T01_6_ss) > 8){
                            ss.classList.add('bg-[#ffa100]'); //orange(warning)
                        }
                        else {
                            ss.classList.add('bg-[#4cb631]'); //green(normal)
                        } 

                    // excel t01-14 ph燈號
                    const ph_5 = document.querySelector('#ph-5');
                        ph_5.classList.remove('bg-[#4cb631]');
                        ph_5.classList.remove('bg-[#ffa100]');
                        ph_5.classList.remove('bg-[#ff1616]');
                        if(parseInt(current.T01_14_ph) < 6 && parseInt(current.T01_14_ph) > 9){
                            ph_5.classList.add('bg-[#ff1616]'); //red(danger)
                        }
                        else if(parseInt(current.T01_14_ph) < 7 || parseInt(current.T01_14_ph) > 8){
                            ph_5.classList.add('bg-[#ffa100]'); //orange(warning)
                        }
                        else {
                            ph_5.classList.add('bg-[#4cb631]'); //green(normal)
                        } 
                    },
                    error: function(errmsg) {
                       console.log("Ajax獲取伺服器資料出現錯誤！"+ errmsg);
                    },
                })

                // GUI realtime
                document.getElementById("gui_t01_6_ph_pre").innerHTML = current.T01_6_ph_pre;
                document.getElementById("gui_t01_6_ph_aft").innerHTML = current.T01_6_ph_aft;
                document.getElementById("gui_t01_6_ss").innerHTML = current.T01_6_ss;
                document.getElementById("gui_t01_12_ph_pre").innerHTML = current.T01_12_ph_pre;
                document.getElementById("gui_t01_12_ph_aft").innerHTML = current.T01_12_ph_aft;
                document.getElementById("gui_t01_12_drug1").innerHTML = current.T01_12_drug1_current;
                document.getElementById("gui_t01_12_daily_drug1").innerHTML = current.T01_12_drug1_daily;
                document.getElementById("gui_t01_12_drug2").innerHTML = current.T01_12_drug2_current;
                document.getElementById("gui_t01_12_daily_drug2").innerHTML = current.T01_12_drug2_daily;
                document.getElementById("gui_t01_14_ph").innerHTML = current.T01_14_ph;
                document.getElementById("gui_time").innerHTML = current.added_on;


                // gui 完整流程燈號
                const sign = document.querySelector('#sign');
                sign.classList.remove('bg-[#4cb631]');
                sign.classList.remove('bg-[#ffa100]');
                sign.classList.remove('bg-[#ff1616]');
                if(parseInt(current.T01_14_ph) < 6 && parseInt(current.T01_14_ph) > 9){
                    sign.classList.add('bg-[#ff1616]'); //red(danger)
                }
                else if(parseInt(current.T01_14_ph) < 7 || parseInt(current.T01_14_ph) > 8){
                    sign.classList.add('bg-[#ffa100]'); //orange(warning)
                }
                else {
                    sign.classList.add('bg-[#4cb631]'); //green(normal)
                }

                const ph_gui_1 = document.querySelector('#ph_gui-1');
                ph_gui_1.classList.remove('bg-[#4cb631]');
                ph_gui_1.classList.remove('bg-[#ffa100]');
                ph_gui_1.classList.remove('bg-[#ff1616]');
                if(parseInt(current.T01_6_ph_pre) < 6 && parseInt(current.T01_6_ph_pre) > 9){
                    ph_gui_1.classList.add('bg-[#ff1616]'); //red(danger)
                }
                else if(parseInt(current.T01_6_ph_pre) < 7 || parseInt(current.T01_6_ph_pre) > 8){
                    ph_gui_1.classList.add('bg-[#ffa100]'); //orange(warning)
                }
                else {
                    ph_gui_1.classList.add('bg-[#4cb631]'); //green(normal)
                }

                const ph_gui_2 = document.querySelector('#ph_gui-2');
                ph_gui_2.classList.remove('bg-[#4cb631]');
                ph_gui_2.classList.remove('bg-[#ffa100]');
                ph_gui_2.classList.remove('bg-[#ff1616]');
                if(parseInt(current.T01_6_ph_aft) < 6 && parseInt(current.T01_6_ph_aft) > 9){
                    ph_gui_2.classList.add('bg-[#ff1616]'); //red(danger)
                }
                else if(parseInt(current.T01_6_ph_aft) < 7 || parseInt(current.T01_6_ph_aft) > 8){
                    ph_gui_2.classList.add('bg-[#ffa100]'); //orange(warning)
                }
                else {
                    ph_gui_2.classList.add('bg-[#4cb631]'); //green(normal)
                }

                const ph_gui_3 = document.querySelector('#ph_gui-3');
                ph_gui_3.classList.remove('bg-[#4cb631]');
                ph_gui_3.classList.remove('bg-[#ffa100]');
                ph_gui_3.classList.remove('bg-[#ff1616]');
                if(parseInt(current.T01_12_ph_pre) < 6 && parseInt(current.T01_12_ph_pre) > 9){
                    ph_gui_3.classList.add('bg-[#ff1616]'); //red(danger)
                }
                else if(parseInt(current.T01_12_ph_pre) < 7 || parseInt(current.T01_12_ph_pre) > 8){
                    ph_gui_3.classList.add('bg-[#ffa100]'); //orange(warning)
                }
                else {
                    ph_gui_3.classList.add('bg-[#4cb631]'); //green(normal)
                }

                const ph_gui_4 = document.querySelector('#ph_gui-4');
                ph_gui_4.classList.remove('bg-[#4cb631]');
                ph_gui_4.classList.remove('bg-[#ffa100]');
                ph_gui_4.classList.remove('bg-[#ff1616]');
                if(parseInt(current.T01_12_ph_aft) < 6 && parseInt(current.aft) > 9){
                    ph_gui_4.classList.add('bg-[#ff1616]'); //red(danger)
                }
                else if(parseInt(current.T01_12_ph_aft) < 7 || parseInt(current.T01_12_ph_aft) > 8){
                    ph_gui_4.classList.add('bg-[#ffa100]'); //orange(warning)
                }
                else {
                    ph_gui_4.classList.add('bg-[#4cb631]'); //green(normal)
                }

                const ph_gui_5 = document.querySelector('#ph_gui-5');
                ph_gui_5.classList.remove('bg-[#4cb631]');
                ph_gui_5.classList.remove('bg-[#ffa100]');
                ph_gui_5.classList.remove('bg-[#ff1616]');
                if(parseInt(current.T01_14_ph) < 6 && parseInt(current.T01_14_ph) > 9){
                    ph_gui_5.classList.add('bg-[#ff1616]'); //red(danger)
                }
                else if(parseInt(current.T01_14_ph) < 7 || parseInt(current.T01_14_ph) > 8){
                    ph_gui_5.classList.add('bg-[#ffa100]'); //orange(warning)
                }
                else {
                    ph_gui_5.classList.add('bg-[#4cb631]'); //green(normal)
                }

                const ss_gui = document.querySelector('#ss_gui');
                ss_gui.classList.remove('bg-[#4cb631]');
                ss_gui.classList.remove('bg-[#ffa100]');
                ss_gui.classList.remove('bg-[#ff1616]');
                if(parseInt(current.T01_6_ss) < 6 && parseInt(current.T01_6_ss) > 9){
                    ss_gui.classList.add('bg-[#ff1616]'); //red(danger)
                }
                else if(parseInt(current.T01_6_ss) < 7 || parseInt(current.T01_6_ss) > 8){
                    ss_gui.classList.add('bg-[#ffa100]'); //orange(warning)
                }
                else {
                    ss_gui.classList.add('bg-[#4cb631]'); //green(normal)
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

                        document.getElementById("excel_pred_ss").innerHTML = pred.pred_ss;
                    },
                    error: function(errmsg) {
                       console.log("Ajax獲取伺服器資料出現錯誤！"+ errmsg);
                    },
                })
                // GUI pred
                document.getElementById("gui_pred_ss").innerHTML = pred.pred_ss;
                const pred_ss_gui = document.querySelector('#pred_ss_gui');
                pred_ss_gui.classList.remove('bg-[#4cb631]');
                pred_ss_gui.classList.remove('bg-[#ffa100]');
                pred_ss_gui.classList.remove('bg-[#ff1616]');
                if(parseInt(pred.pred_ss) < 6 && parseInt(pred.pred_ss) > 9){
                    pred_ss_gui.classList.add('bg-[#ff1616]'); //red(danger)
                }
                else if(parseInt(pred.pred_ss) < 7 || parseInt(pred.pred_ss) > 8){
                    pred_ss_gui.classList.add('bg-[#ffa100]'); //orange(warning)
                }
                else {
                    pred_ss_gui.classList.add('bg-[#4cb631]'); //green(normal)
                }
            }
            setInterval(getPredData, 1000); //every 1 secs
        </script>
    </x-slot>
</x-app-layout>
