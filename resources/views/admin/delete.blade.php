<!-- Modal Toggle -->
<button
        type="button" 
        data-modal-target="delete" 
        data-modal-toggle="delete" 
        class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 @if($u->getRoleNames()[0] == 'Admin') hidden else '' @endif)">


        移除用戶
        
    </button>

<!-- Main Model -->
    <div id="delete" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-10 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full border-2 border-gray-400">
        <div class="relative w-98 max-w-2xl max-h-full">
            <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">                    
                    <!-- Modal body -->
                        <form method="POST" action="{{ route('admin.delete', ['id' => $u->id]) }}" enctype="multipart/form-data" class="p-6">
                            @csrf
                            @method('delete')
                            
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('確認要刪除此帳號嗎?') }}
                            </h2>
                            <h2>{{ __('Are you sure you want to delete this account?') }}</h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('此帳號刪除後，資料將無法復原') }}
                            </p>

                            <div class="mt-6">
                                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                                <x-text-input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="mt-1 block w-3/4"
                                    placeholder="{{ __('Admin Password') }}"
                                />

                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                            </div>
                                
                    <!-- Modal footer -->
                            <div class="flex items-center justify-end px-6 py-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-hide="delete" type="submit" class="text-white bg-rose-600 hover:bg-rose-500 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">移除用戶</button>
                                <button data-modal-hide="delete" type="button" class="text-gray-500 bg-white hover:bg-gray-200 focus:ring-2 focus:outline-none focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">取消</button>
                            </div>
                        </form>
                </div>
        </div>
    </div>
