<x-slot name="scripts">
    <script type="text/javascript">
        function status() {
            $.ajax({
                method: "POST",
                url : '/status',
                data: {'_token': '{{csrf_token()}}'},
                dataType: 'json',
                success:function(data){
                    document.getElementById("power").innerHTML = "";
                    let string;
                    for(let i = 0; i< data.length; i+=1){
                        current = data;
                        string = "";
                        string += 
                        '<div class="grid grid-cols-3 table-row bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">' + 
                            '<div class="table-cell"><div class="border grid">' +
                            '<div class="justify-self-center p-3 w-full lg:w-auto text-gray-800 text-center block relative lg:static">' + 
                                current[i].power_id + '</div>' +
                            '</div></div>';
                            if(current[i].status == 1){
                                string += 
                                '<div class="table-cell"><div class="border grid">' +
                                    '<div class="justify-self-center p-3 w-full lg:w-auto text-center text-emerald-700 font-medium block relative lg:static">' + 
                                    '訊號恢復</div>' +
                                '</div></div>';
                            }
                            else{
                                string +=
                                '<div class="table-cell"><div class="border grid">' +
                                    '<div class="justify-self-center p-3 w-full lg:w-auto text-center text-red-600 font-semibold block relative lg:static">' + 
                                    '設備斷訊</div>' +
                                '</div></div>';
                            }
                            string += 
                            '<div class="table-cell"><div class="border grid">' +
                                '<div class="justify-self-center p-3 w-full lg:w-auto text-gray-800 text-center block relative lg:static">' + 
                                current[i].onofftime + '</div>' +
                            '</div></div>' +
                        '</div>'  ;
                        document.getElementById("power").innerHTML += string;
                    }
                    
                },
                error: function(errmsg) {
                    console.log("Ajax獲取伺服器資料出現錯誤！"+ errmsg);
                },
            })
        }
           
        setInterval(status, 1000); //every 1 secs
    </script>
</x-slot>
    <div class="table w-full duration-500 mb-4 border border-gray-200 inline-block min-w-full overflow-hidden rounded-lg shadow">
        <div class="table-header-group h-16">
            <div class="table-row">
                <div class="px-2 font-bold uppercase bg-[#dedbff] text-gray-600 border-b border-gray-600 table-cell text-center align-middle">紀錄ID</div>
                <div class="px-2 font-bold uppercase bg-[#dedbff] text-gray-600 border-b border-gray-600 table-cell text-center align-middle">設備狀態</div>
                <div class="px-2 font-bold uppercase bg-[#dedbff] text-gray-600 border-b border-gray-600 table-cell text-center align-middle">斷訊/恢復時間</div>
            </div>
        </div>
        <div id="power" class="table-row-group">
        </div>
    </div>