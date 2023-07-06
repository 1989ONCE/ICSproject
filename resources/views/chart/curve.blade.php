@section('title', '歷史報表')
<x-app-layout>

    <x-slot name="scripts"></x-slot>

    <div class="flex flex-row justify-evenly w-full h-auto pl-8">
        <div class="w-fit flex flex-col grid h-[450px] pt-8">
            <div id="main" style="width: 600px;height:450px;"></div>
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

                                var T01_15_ph = json1.map(x => x.T01_15_ph);
                                var T01_15_temp = json2.map(x => x.T01_15_temp);
                                var T01_15_ec = json3.map(x => x.T01_15_ec);
                                var T01_15_cod = json4.map(x => x.T01_15_cod);
                                var added_on = json5.map(x => x.added_on);
                                // 基于准备好的dom，初始化echarts实例
                                var myChart = echarts.init(document.getElementById('main'));

                                // 指定图表的配置项和数据
                                var option = {
                                    backgroundColor: '#ffffff',
                                    title: {
                                        text: '放流槽數值歷史報表'
                                    },
                                    tooltip: {},
                                    legend: {
                                        top: 2,
                                        left: 200,
                                        data: ['ph', 'temp', 'EC', 'COD']
                                    },
                                    xAxis: {
                                        data: added_on
                                    },
                                    yAxis: {
                                        type: 'value'
                                    },
                                    series: [
                                        {
                                            name: 'ph',
                                            type: 'line',
                                            data: T01_15_ph
                                        },
                                        {
                                            name: 'temp',
                                            type: 'line',
                                            data: T01_15_temp
                                        },
                                        {
                                            name: 'EC',
                                            type: 'line',
                                            data: T01_15_ec
                                        },
                                        {
                                            name: 'COD',
                                            type: 'line',
                                            data: T01_15_cod
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
                    <span class="text-md">按此下載放流槽數值歷史資料</span>
                </a>
            </div>

            <div class="w-fit flex justify-center flex-col grid h-[450px] pl-4 pt-8 pb-4">
                <div id="main-2" style="width: 600px;height:450px;"></div>
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
                                var json4 = JSON.parse(data[3]);
                                var json5 = JSON.parse(data[4]);
                                var json6 = JSON.parse(data[5]);
                                var json7 = JSON.parse(data[6]);
                                var json8 = JSON.parse(data[7]);
                                var json9 = JSON.parse(data[8]);

                                var T01_2_drug = json1.map(x => x.T01_2_drug);
                                var T01_4_drug = json2.map(x => x.T01_4_drug);
                                var T01_5_drug1 = json3.map(x => x.T01_5_drug1);
                                var T01_5_drug2 = json4.map(x => x.T01_5_drug2);
                                var T01_6_drug = json5.map(x => x.T01_6_drug);
                                var T01_12_drug1 = json6.map(x => x.T01_12_drug1);
                                var T01_12_drug2 = json7.map(x => x.T01_12_drug2);
                                var T01_13_drug = json8.map(x => x.T01_13_drug);
                                var added_on = json9.map(x => x.added_on);

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
                                        data: ['ph中和槽-液鹼', '冷卻塔-液鹼', '快混槽1-液鹼', '快混槽1-硫酸鋁', '慢混槽1-polymer', '快混槽2-液鹼', '快混槽2-硫酸鋁', '慢混槽2-polymer']
                                    },
                                    xAxis: {
                                        data: added_on
                                    },
                                    yAxis: {
                                        type: 'value'
                                    },
                                    series: [
                                        {
                                            name: 'ph中和槽-液鹼',
                                            type: 'line',
                                            data: T01_2_drug
                                        },
                                        {
                                            name: '冷卻塔-液鹼',
                                            type: 'line',
                                            data: T01_4_drug
                                        },
                                        {
                                            name: '快混槽1-液鹼',
                                            type: 'line',
                                            data: T01_5_drug1
                                        },
                                        {
                                            name: '快混槽1-硫酸鋁',
                                            type: 'line',
                                            data: T01_5_drug2
                                        },
                                        {
                                            name: '慢混槽1-polymer',
                                            type: 'line',
                                            data: T01_6_drug
                                        },
                                        {
                                            name: '快混槽2-液鹼',
                                            type: 'line',
                                            data: T01_12_drug1
                                        },
                                        {
                                            name: '快混槽2-硫酸鋁',
                                            type: 'line',
                                            data: T01_12_drug2
                                        },
                                        {
                                            name: '慢混槽2-polymer',
                                            type: 'line',
                                            data: T01_13_drug
                                        }
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
                    <span class="text-md">按此下載各槽體藥劑量報表</span>
                </a>
            </div>
    </div>
</x-app-layout>
