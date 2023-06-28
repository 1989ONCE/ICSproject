
@section('title', '告警管理')
<x-app-layout>

    <div class="flex flex-row">
        @include('warn.partials.sidebar')
        <!-- Main content -->

        
        <main class="mx-[250px] mt-10 w-9/12">
            <div class="container mx-auto py-8">
			    <h1 class="text-4xl font-bold mb-6 text-center">編輯告警</h1>

                @foreach($alarms as $alarm)
                <div class="w-8/12 bg-white flex flex-col space-y-2 p-3">
        
                    
                    <div class="flex flex-row flex items-center ">
                        <div class="bg-sky-200 w-28 p-1 m-1 rounded-full">
                            <span class="font-normal text-sky-900 text-base flex justify-center ">{{$alarm->alarm_name}}</span>
                            
                        </div>
                        
                        <div class="flex">
                            <a class="px-2 rounded bg-blue-500 text-white" href="{{ route('warning.edit',['id'=>$alarm->alarm_id])}}" >編輯</a>

                            <div class="px-1"></div>

                            <form action="{{ route('warn.destroy',['id'=>$alarm->alarm_id])}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="px-2 rounded bg-red-500 text-white">刪除</button>
                            </form>
                        </div>
                    </div>

                    
                </div>
                @endforeach

                
            </div>

			
		
        </main>
		
        
    </div>
</x-app-layout>