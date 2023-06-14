@section('title', '歷史報表')
<x-app-layout>

    <x-slot name="scripts">

    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('chart.partials.graph')
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <h1 class="text-center">Ph</h1>
        <div class="col-md-8 col-md-offset-2">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-container">
    					    <div class="chart has-fixed-height" id="main"></div>
                        <script type="text/javascript">
            // 基于准备好的dom，初始化echarts实例
            var myChart = echarts.init(document.getElementById('main'));

            // 指定图表的配置项和数据
            var option = {
            title: {
                text: 'ECharts 入门示例'
            },
            tooltip: {},
            legend: {
                data: ['销量']
            },
            xAxis: {
                data: ['衬衫', '羊毛衫', '雪纺衫', '裤子', '高跟鞋', '袜子']
            },
            yAxis: {},
            series: [
                {
                name: '销量',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20]
                }
            ]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </div>
</html>



    <div class="px-6">
        <button class="bg-amber-200 hover:bg-amber-300 text-emerald-700 hover:underline underline-offset-4 font-bold py-2 px-1 border rounded inline-flex items-center">
        <img width="40px" height="40px" src="{{ asset('img/svg/excel_download.svg') }}" class="grid items-center"></img>
        <a href="{{route('export')}}" class="px-2"><span>按此下載所有歷史資料</span>
        </button>
    </div>
</x-app-layout>
