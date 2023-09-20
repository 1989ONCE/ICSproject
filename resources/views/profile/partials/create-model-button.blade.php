<!-- Modal Toggle -->
    <button
        type="button" 
        data-modal-target="createModel" 
        data-modal-toggle="createModel" 
        class="flex flex-row justify-center place-items-center w-fit h-fit rounded-lg shadow-md transition duration-150 ease-in-out hover:shadow-lg bg-sky-600 hover:bg-sky-500 font-sans text-2xl font-bold uppercase leading-none text-white active:shadow-lg focus:ring-sky-400">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
        </svg>
        
        <h2 class="inline-block select-none whitespace-nowrap rounded-lg py-2 px-2">
            新增模型類別
        </h2>
        
    </button>

<!-- Main Model -->
    <div id="createModel" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full border-2 border-gray-400">
        <div class="relative w-98 max-w-2xl max-h-full">
            <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b border-gray-600 bg-sky-200 rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                新增模型類別
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="createModel">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                    <!-- Modal body -->
                        <form method="POST" action="{{ route('profile.createModel') }}" enctype="multipart/form-data" class="padding-x-2">
                            @csrf
                            <h4 class="text-md text-black semibold">&ensp;目前系統僅支援3種預測模型類別,</br>
                            &ensp;VAR、LSTM和ARIMA</br>
                            &ensp;您仍可新增別種模型類別, 但可能無法得到預測結果！</h4>
                            <div class="grid align-center p-3 text-black">            
                                <input id="name" class="h-8 px-2 border rounded form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="請輸入新模型類別：">
                            </div>
                                
                    <!-- Modal footer -->
                            <div class="flex items-center justify-end px-6 py-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-hide="createModel" type="submit" class="text-white bg-sky-600 hover:bg-sky-500 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">新增類別</button>
                                <button data-modal-hide="createModel" type="button" class="text-gray-500 bg-white hover:bg-gray-200 focus:ring-2 focus:outline-none focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">取消</button>
                            </div>
                        </form>
                </div>
        </div>
    </div>
