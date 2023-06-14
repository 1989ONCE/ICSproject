<!-- component -->
<div class="w-full h-96 p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg grid place-items-center ">
    <div class="flex flex-row">
        <div class="w-5/12 grid justify-items-start mx-8">
            <div class="bg-white grid place-items-center">
                <img class="w-44 rounded-full" src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="tailwind logo" class="rounded-xl" />
                <span class="font-black text-gray-800 text-2xl flex jusitfy-center inline-block align-top">{{$user->name}}</span>
            </div>
        </div>

        <div class="w-8/12 bg-white flex flex-col space-y-2 p-3">
            <div class="flex flex-row flex items-center">
                <p class="w-32 md:text-lg text-gray-500 text-base">信箱 Email： </p>
                <div class="bg-sky-200 w-28 p-1 m-1 rounded-full">
                    <span class="font-normal text-sky-900 text-base flex justify-center underline underline-offset-2 hover:text-gray-500">{{$user->email}}</span>
                </div>
            </div>
            <div class="flex flex-row flex items-center">
                <p class="w-32 md:text-lg text-gray-500 text-base">手機 Phone： </p>
                <div class="bg-sky-200 w-28 p-1 m-1 rounded-full">
                    <span class="font-normal text-sky-900 text-base flex justify-center underline underline-offset-2 hover:text-gray-500">{{$user->phone}}</span>
                </div>
            </div>
            <div class="flex flex-row flex items-center">
                <p class="w-32 md:text-lg text-gray-500 text-base">職位 Position： </p>
                <div class="bg-sky-200 w-28 p-1 m-1 rounded-full">
                    <span class="font-normal text-sky-900 text-base flex justify-center underline underline-offset-2 hover:text-gray-500">{{$user->group->group_name}}</span>
                </div>
            </div>
            <div class="flex flex-row flex items-center">
                <p class="w-32 md:text-lg text-gray-500 text-base">權限 Authority: </p>
                <div class="bg-sky-200 w-28 p-1 m-1 rounded-full">
                    <span class="font-normal text-sky-900 text-base flex justify-center underline underline-offset-2 hover:text-gray-500">Admin</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="h-screen -mt-20 w-96">        

            <c2 class="flex flex-col justify-between">
                <h5 class="mb-2 text-xl font-bold text-neutral-800 dark:text-neutral-50">
                    地址: 
                </h5>

                <h5 class="mb-2 text-xl font-medium text-neutral-800 dark:text-neutral-50">
                    臺北市信義區西村里8鄰信義路五段7號
                </h5>
            </c2>
            <c2 class="flex flex-col justify-between">
                <h5 class="mb-2 text-xl font-bold text-neutral-800 dark:text-neutral-50 ">
                    手機號碼: 
                </h5>

                <h5 class="mb-2 text-xl font-medium text-neutral-800 dark:text-neutral-50">
                    0949861352

                </h5>
            </c2>
            <c2 class="flex flex-col justify-between">
                <h5 class="mb-2 text-xl font-bold text-neutral-800 dark:text-neutral-50">
                    職位: 
                </h5>

                <h5 class="mb-2 text-xl font-medium text-neutral-800 dark:text-neutral-50">
                    網頁設計人員
                </h5>
            </c2>
            <c2 class="flex flex-col justify-between">
                <h5 class="mb-2 text-xl font-bold text-neutral-800 dark:text-neutral-50">
                    權限: 
                </h5>

                <h5 class="mb-2 text-xl font-medium text-neutral-800 dark:text-neutral-50">
                    Admin
                </h5>
            </c2>
        </div>
    </div>
</div> -->
