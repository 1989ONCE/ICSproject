@section('title', '歷史報表')
<x-app-layout>
    <div class="flex flex-col xl:flex-row items-center lg:justify-evenly w-full max-w-screen h-auto pl-8">
        <div class="flex flex-col grid h-fit w-fit">
            <div id="main" style="width: 450px;height:350px;"></div>
                <script type="text/javascript">
                    function update() {
                        $.ajax({
                            method: "POST",
                            url : '/chart',
                            data: {'_token': '{{csrf_token()}}'},
                            dataType: 'json',
                            success:function(data){
                                var json1 = JSON.parse(data[0]);
                                var json2 = JSON.parse(data[1]);
                                var json3 = JSON.parse(data[2]);
                                var json4 = JSON.parse(data[3]);
                                var json5 = JSON.parse(data[4]);
                                var json6 = JSON.parse(data[5]);
                                var json7 = JSON.parse(data[6]);

                                
                                var T01_6_ph_pre = json1.map(x => x.T01_6_ph_pre);
                                var T01_6_ph_aft = json2.map(x => x.T01_6_ph_aft);
                                var T01_6_ss = json3.map(x => x.T01_6_ss);
                                var T01_12_ph_pre = json4.map(x => x.T01_12_ph_pre);
                                var T01_12_ph_aft = json5.map(x => x.T01_12_ph_aft);
                                var T01_14_ph = json6.map(x => x.T01_14_ph);

                                var added_on = json7.map(x => x.added_on);
                                // 基于准备好的dom，初始化echarts实例
                                var myChart = echarts.init(document.getElementById('main'));

                                // 指定图表的配置项和数据
                                var option = {
                                    backgroundColor: '#ffffff',
                                    title: {
                                        text: '各項數值歷史報表'
                                    },
                                    tooltip: {},
                                    legend: {
                                        top: 2,
                                        left: 150,
                                        data: ['化混槽1-pH(前)', '化混槽1-pH(後)', '化混槽1-ss', '化混槽2-pH(前)', '化混槽2-pH(後)', '放流槽-pH']
                                    },
                                    xAxis: {
                                        data: added_on
                                    },
                                    yAxis: {
                                        type: 'value'
                                    },
                                    series: [
                                        {
                                            name: '化混槽1-pH(前)',
                                            type: 'line',
                                            data: T01_6_ph_pre
                                        },
                                        {
                                            name: '化混槽1-pH(後)',
                                            type: 'line',
                                            data: T01_6_ph_aft
                                        },
                                        {
                                            name: '化混槽1-ss',
                                            type: 'line',
                                            data: T01_6_ss
                                        },
                                        {
                                            name: '化混槽2-pH(前)',
                                            type: 'line',
                                            data: T01_12_ph_pre
                                        },
                                        {
                                            name: '化混槽2-pH(後)',
                                            type: 'line',
                                            data: T01_12_ph_aft
                                        },
                                        {
                                            name: '放流槽-pH',
                                            type: 'line',
                                            data: T01_14_ph
                                        },
                                    ]
                                };
                                // 使用刚指定的配置项和数据显示图表。
                                myChart.setOption(option);
                            },
                            error: function(errmsg) {
                            console.log("Ajax獲取伺服器資料出現錯誤！"+ errmsg);
                            },
                        })
                    }
                    setInterval(update, 1000); //every 1 secs
                </script>
                <a href="{{route('export')}}" class="w-fit h-12 -translate-y-6 justify-self-end flex flex-row bg-amber-200 hover:bg-amber-300 text-emerald-700 hover:underline underline-offset-4 font-bold py px-1 border rounded items-center">
                    <img width="30px" height="30px" src="{{ asset('img/svg/excel_download.svg') }}" class="grid items-center"></img>
                    <span class="text-md">按此下載各項數值歷史資料</span>
                </a>
        </div>

        <div class="flex flex-col grid h-fit w-fit lg:pl-4">
            <div id="main-2" style="width: 450px;height:350px;"></div>
            <script type="text/javascript">
                function update2() {
                    $.ajax({
                        method: "POST",
                        url : '/chart2',
                        data: {'_token': '{{csrf_token()}}'},
                        dataType: 'json',
                        success:function(data){
                            var json1 = JSON.parse(data[0]);
                            var json2 = JSON.parse(data[1]);
                            var json3 = JSON.parse(data[2]);

                            var T01_12_drug1_daily = json1.map(x => x.T01_12_drug1_daily);
                            var T01_12_drug2_daily = json2.map(x => x.T01_12_drug2_daily);
                            var added_on = json3.map(x => x.added_on);

                            // 基于准备好的dom，初始化echarts实例
                            var myChart2 = echarts.init(document.getElementById('main-2'));

                            // 指定图表的配置项和数据
                            var option2 = {
                                backgroundColor: '#ffffff',
                                title: {
                                    text: '藥劑量'
                                },
                                tooltip: {},
                                legend: {
                                    left: 60,
                                    data: ['化混槽2-液鹼', '化混槽2-硫酸鋁']
                                },
                                xAxis: {
                                    data: added_on
                                },
                                yAxis: {
                                    type: 'value'
                                },
                                series: [
                                    {
                                        name: '化混槽2-液鹼',
                                        type: 'line',
                                        data: T01_12_drug1_daily
                                    },
                                    {
                                        name: '化混槽2-硫酸鋁',
                                        type: 'line',
                                        data: T01_12_drug2_daily
                                    },
                                ]
                            };

                            // 使用刚指定的配置项和数据显示图表。
                            myChart2.setOption(option2);
                        },
                        error: function(errmsg) {
                        console.log("Ajax獲取伺服器資料出現錯誤！"+ errmsg);
                        },
                    })
                }
                setInterval(update2, 1000); //every 1 secs
            </script>
            <a href="{{route('export2')}}" class="w-fit h-12 -translate-y-[26px] justify-self-end flex flex-row bg-amber-200 hover:bg-amber-300 text-emerald-700 hover:underline underline-offset-4 font-bold py px-1 border rounded items-center">
                <img width="30px" height="30px" src="{{ asset('img/svg/excel_download.svg') }}" class="grid items-center"></img>
                <span class="text-md">按此下載藥劑量報表</span>
            </a>
        </div>
    </div>
    
    <x-slot name="scripts"></x-slot>
</x-app-layout>
