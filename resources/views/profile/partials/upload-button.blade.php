<!-- Modal Toggle -->
    <button
        type="button" 
        data-modal-target="defaultModal_{{$id}}" 
        data-modal-toggle="defaultModal_{{$id}}" 
        class="grid place-self-center flex justify-center w-6 h-6 rounded-lg py-1 font-medium text-gray-500 shadow-md transition duration-150 ease-in-out hover:shadow-lg hover:bg-rose-600 hover:text-white active:shadow-lg focus:ring-sky-400">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
        </svg>
    </button>

<!-- Main Model -->
    <div id="defaultModal_{{$id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full border-2 border-gray-400">
        <div class="relative w-96 max-w-2xl max-h-full">
            <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b border-gray-600 bg-sky-200 rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                上傳模型 - {{Str::upper($name)}}
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal_{{$id}}">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                    <!-- Modal body -->
                        <form method="POST" action="{{ route('profile.upload', ['id'=> $id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="grid align-center p-3 text-black">            
                                <input id="loc" type="file" accept=".pkl" class="border rounded form-control @error('loc') is-invalid @enderror" name="loc" value="{{ old('loc') }}" required autocomplete="loc">
                            </div>
                                
                    <!-- Modal footer -->
                            <div class="flex items-center justify-end px-6 py-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-hide="defaultModal_{{$id}}" type="submit" class="text-white bg-sky-600 hover:bg-sky-500 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">確認</button>
                                <button data-modal-hide="defaultModal_{{$id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-200 focus:ring-2 focus:outline-none focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">取消</button>
                            </div>
                        </form>
                </div>
        </div>
    </div>
