@section('title', '人員管理')

<x-app-layout>
    <x-slot name="scripts"></x-slot>

    <div class="grid justify-items-center xl:flex xl:flex-row">
        @include('profile.partials.sidebar')
        <!-- Main content -->
        <div class="pl-4 pr-2 ml-0 xl:ml-[250px] mt-2 w-full min-w-48 xl:w-[900px] flex flex-col overflow-x-auto items-start">
            <div class="w-full p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
                        <table class="w-full border-collapse text-left text-sm text-gray-500">
                            <thead class="bg-[#c3e3f1]">
                                <tr>
                                    <th class="bg-[#c3e3f7] px-6 py-4 font-medium text-gray-900">姓名</th>
                                    <th class="bg-[#c3e3f7] px-6 py-4 font-medium text-gray-900">職位</th>
                                    <th class="bg-[#c3e3f7] px-6 py-4 font-medium text-gray-900">操作</th>
                                </tr>  
                            </thead>
                            <tbody>
                                @foreach($users as $u)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-5 py-5 text-base border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                {{$u->name}}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 text-base border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                {{$u->group->group_name}}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 text-base border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="ml-3">
                                                <a href="{{route('admin.edit', ['id'=> $u->id])}}"><button type="button" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">編輯</button></a>
                                                @include('admin.delete')
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
