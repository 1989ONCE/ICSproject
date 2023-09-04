<!-- component -->
<div class="w-full h-fit p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg grid place-items-center ">
    <div class="flex flex-col xl:flex-row items-center">
        <div class="w-5/12 grid justify-items-center mx-8 flex flex-col">
            <div class="bg-white flex flex-row grid place-content-center">
                @if($user->avatar == null)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-44 h-44">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <!-- Modal Toggle -->
                    <button
                        type="button"
                        data-modal-target="defaultModal" 
                        data-modal-toggle="defaultModal" 
                        class="-translate-x-2 -translate-y-[3.6rem] grid place-self-end flex justify-center z-10 w-12 h-12 bg-sky-300 rounded-full px-6 py-2.5 font-medium text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg hover:bg-sky-400 focus:shadow-lg focus:outline-none focus:ring-1 active:shadow-lg focus:ring-sky-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                        </svg>
                    </button>
                @else
                    <div class="flex flex-col justify-items-center">
                        <img class="sticky w-40 h-40 rounded-full" src="/avatars/{{ Auth::user()->avatar }}" alt="user avatar" />
                    </div>
                    <!-- Modal Toggle -->
                    <button
                        type="button"
                        data-modal-target="defaultModal" 
                        data-modal-toggle="defaultModal" 
                        class="-translate-y-10 grid place-self-end flex justify-center z-10 w-12 h-12 bg-sky-300 rounded-full px-6 py-2.5 font-medium text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg hover:bg-sky-400 focus:shadow-lg focus:outline-none focus:ring-1 active:shadow-lg focus:ring-sky-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                        </svg>
                    </button>
                @endif
                    
                    <!-- Main Model -->
                    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full border-2 border-gray-400">
                        <div class="relative w-96 max-w-2xl max-h-full">
                             <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-start justify-between p-4 border-b border-gray-600 bg-sky-200 rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Update Avatar
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form method="POST" action="{{ route('profile.change') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="grid align-center p-3">            
                                        <input id="avatar" type="file" accept=".jpg, .jpeg, .png, .gif, .jfif" class="border rounded form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" required autocomplete="avatar">
                                    </div>
                                
                                    <!-- Modal footer -->
                                    <div class="flex items-center justify-end px-6 py-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button data-modal-hide="defaultModal" type="submit" class="text-white bg-sky-600 hover:bg-sky-500 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">更換頭像</button>
                                        <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-200 focus:ring-2 focus:outline-none focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">取消</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <span class="-translate-y-10 font-black text-gray-800 text-2xl grid place-self-center inline-block align-top">{{$user->name}}</span>
            </div>
            <div class="-translate-y-8">
                    @if (session('success'))
                        <div class="bg-emerald-200 p-3 rounded-lg underline underline-offset-4 text-xs" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif 
                    @error('avatar')
                        <div class="bg-rose-100 p-2 rounded-lg break-normal underline underline-offset-4 text-xs" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    </div>
        </div>

        <div class="w-8/12 bg-white flex flex-col space-y-2 p-3">
            <div class="flex flex-row flex items-center">
                <p class="w-40 md:text-lg text-gray-500 text-base">員工識別號</br> Badge Number： </p>
                <div class="bg-sky-200 w-28 min-w-fit py-1 px-2 m-1 rounded-full">
                    <span class="font-normal text-sky-900 text-base flex justify-center underline underline-offset-2 hover:text-gray-500"># {{$user->Badge_num}}</span>
                </div>
            </div>
            <div class="flex flex-row flex items-center">
                <p class="w-40 md:text-lg text-gray-500 text-base">信箱 Email： </p>
                <div class="bg-sky-200 min-w-fit py-1 px-2 m-1 rounded-full">
                    <span class="font-normal text-sky-900 text-base flex justify-center underline underline-offset-2 hover:text-gray-500">{{$user->email}}</span>
                </div>
            </div>
            <div class="flex flex-row flex items-center">
                <p class="w-40 md:text-lg text-gray-500 text-base">手機 Phone： </p>
                <div class="bg-sky-200 w-28 min-w-fit p-1 m-1 rounded-full">
                    <span class="font-normal text-sky-900 text-base flex justify-center underline underline-offset-2 hover:text-gray-500">{{$user->phone}}</span>
                </div>
            </div>
            <div class="flex flex-row flex items-center">
                <p class="w-40 md:text-lg text-gray-500 text-base">職位 Position： </p>
                <div class="bg-sky-200 w-28 min-w-fit p-1 m-1 rounded-full">
                    <span class="font-normal text-sky-900 text-base flex justify-center underline underline-offset-2 hover:text-gray-500">{{$user->group->group_name}}</span>
                </div>
            </div>
            <div class="flex flex-row flex items-center">
                <p class="w-40 md:text-lg text-gray-500 text-base">權限 Authority: </p>
                <div class="bg-sky-200 w-28 min-w-fit p-1 m-1 rounded-full">
                    <span class="font-normal text-sky-900 text-base flex justify-center underline underline-offset-2 hover:text-gray-500">Admin</span>
                </div>
            </div>
        </div>
    </div>
</div>
