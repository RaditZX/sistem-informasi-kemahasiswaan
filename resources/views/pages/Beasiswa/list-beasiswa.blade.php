@extends('layouts.main')
@section('content')
    @include('component.navbar')
    <div class="p-2">
        <div class="flex flex-auto justify-center">    
            <div class="basis-1/4 flex flex-col items-end p-2">
                <div class="bg-white rounded shadow-lg p-5 w-fit cursor-pointer" onclick="showPopup()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders2-vertical" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M0 10.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1H3V1.5a.5.5 0 0 0-1 0V10H.5a.5.5 0 0 0-.5.5M2.5 12a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5m3-6.5A.5.5 0 0 0 6 6h1.5v8.5a.5.5 0 0 0 1 0V6H10a.5.5 0 0 0 0-1H6a.5.5 0 0 0-.5.5M8 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2A.5.5 0 0 0 8 1m3 9.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1H14V1.5a.5.5 0 0 0-1 0V10h-1.5a.5.5 0 0 0-.5.5m2.5 1.5a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5"/>
                    </svg>
                </div>
            </div>
            <div class="basis-3/4 flex rounded p-5">   
                <input type="text" placeholder="Cari Beasiswa" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-3/4">
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1 p-5">
        <!-- Card 1 -->
        <div class="p-2">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEik4McHhDC2otgAFVVxX1_9KI4xqY0KLdkThGiFYjsfN720_z_kIvi2TARm24mA68XO1CbMBSILOHFfy0HIQVO9Hn1qXFxSVfTC54ZaoHKLi6Yj-fd6Lm02syaeQ_Q3nkaGu4LpM6JSk-MwEEzzYqjZMbMNDyQiP8InBNz7sFn00DMJXQQBakiNtx8qBw/s1080/Beasiswa-Creativa-Feed.png" style="border-radius: 15px;" class="mb-3 w- h-400" alt="beasiswa" >
            <div class="flex justify-center gap-2 mb-1" style="max-height: 35px">
                <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">D3</div>
                <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">D4</div>
                <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">FULL</div>
            </div>
            <p class="font-bold text-justify mb-1">Beasiswa LPDP</p>
            <p class="text-xs text-justify mb-2">"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam nobis omnis, quaerat aliquam magni laborum repellat libero fuga. Numquam dolore consequatur perspiciatis dolor pariatur est assumenda sapiente aliquam, fugiat doloremque."</p>
            <div class="flex flex-auto justify-left gap-3">
                <img src="https://th.bing.com/th?id=OIP.InKvUSEGq1ZVmF1-PiX8YQAAAA&w=250&h=250&c=8&rs=1&qlt=90&o=6&cb=13&pid=3.1&rm=2" class="w-5 h-5 rounded-full" alt="KEMENDIKBUD">
                <p class="text-xs font-bold ">KEMENDIKBUD</p>
              </div>
        </div>

        <div class="p-2">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEik4McHhDC2otgAFVVxX1_9KI4xqY0KLdkThGiFYjsfN720_z_kIvi2TARm24mA68XO1CbMBSILOHFfy0HIQVO9Hn1qXFxSVfTC54ZaoHKLi6Yj-fd6Lm02syaeQ_Q3nkaGu4LpM6JSk-MwEEzzYqjZMbMNDyQiP8InBNz7sFn00DMJXQQBakiNtx8qBw/s1080/Beasiswa-Creativa-Feed.png" style="border-radius: 15px;" class="mb-3 w- h-400" alt="beasiswa" >
            <div class="flex justify-center gap-2 mb-1" style="max-height: 35px">
                <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">D3</div>
                <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">D4</div>
                <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">FULL</div>
            </div>
            <p class="font-bold text-justify mb-1">Beasiswa LPDP</p>
            <p class="text-xs text-justify mb-2">"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam nobis omnis, quaerat aliquam magni laborum repellat libero fuga. Numquam dolore consequatur perspiciatis dolor pariatur est assumenda sapiente aliquam, fugiat doloremque."</p>
            <div class="flex flex-auto justify-left gap-3">
                <img src="https://th.bing.com/th?id=OIP.InKvUSEGq1ZVmF1-PiX8YQAAAA&w=250&h=250&c=8&rs=1&qlt=90&o=6&cb=13&pid=3.1&rm=2" class="w-5 h-5 rounded-full" alt="KEMENDIKBUD">
                <p class="text-xs font-bold ">KEMENDIKBUD</p>
              </div>
        </div>

        <div class="p-2">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEik4McHhDC2otgAFVVxX1_9KI4xqY0KLdkThGiFYjsfN720_z_kIvi2TARm24mA68XO1CbMBSILOHFfy0HIQVO9Hn1qXFxSVfTC54ZaoHKLi6Yj-fd6Lm02syaeQ_Q3nkaGu4LpM6JSk-MwEEzzYqjZMbMNDyQiP8InBNz7sFn00DMJXQQBakiNtx8qBw/s1080/Beasiswa-Creativa-Feed.png" style="border-radius: 15px;" class="mb-3 w- h-400" alt="beasiswa" >
            <div class="flex justify-center gap-2 mb-1" style="max-height: 35px">
                <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">D3</div>
                <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">D4</div>
                <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">FULL</div>
            </div>
            <p class="font-bold text-justify mb-1">Beasiswa LPDP</p>
            <p class="text-xs text-justify mb-2">"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam nobis omnis, quaerat aliquam magni laborum repellat libero fuga. Numquam dolore consequatur perspiciatis dolor pariatur est assumenda sapiente aliquam, fugiat doloremque."</p>
            <div class="flex flex-auto justify-left gap-3">
                <img src="https://th.bing.com/th?id=OIP.InKvUSEGq1ZVmF1-PiX8YQAAAA&w=250&h=250&c=8&rs=1&qlt=90&o=6&cb=13&pid=3.1&rm=2" class="w-5 h-5 rounded-full" alt="KEMENDIKBUD">
                <p class="text-xs font-bold ">KEMENDIKBUD</p>
              </div>
        </div>      
        
        <div class="p-2">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEik4McHhDC2otgAFVVxX1_9KI4xqY0KLdkThGiFYjsfN720_z_kIvi2TARm24mA68XO1CbMBSILOHFfy0HIQVO9Hn1qXFxSVfTC54ZaoHKLi6Yj-fd6Lm02syaeQ_Q3nkaGu4LpM6JSk-MwEEzzYqjZMbMNDyQiP8InBNz7sFn00DMJXQQBakiNtx8qBw/s1080/Beasiswa-Creativa-Feed.png" style="border-radius: 15px;" class="mb-3 w- h-400" alt="beasiswa" >
            <div class="flex justify-center gap-2 mb-1" style="max-height: 35px">
                <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">D3</div>
                <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">D4</div>
                <div class="basis-1/3 bg-orange-500 text-xxs text-white rounded shadow-lg p-2 flex justify-center" style="border-radius: 10px;">FULL</div>
            </div>
            <p class="font-bold text-justify mb-1">Beasiswa LPDP</p>
            <p class="text-xs text-justify mb-2">"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam nobis omnis, quaerat aliquam magni laborum repellat libero fuga. Numquam dolore consequatur perspiciatis dolor pariatur est assumenda sapiente aliquam, fugiat doloremque."</p>
            <div class="flex flex-auto justify-left gap-3">
                <img src="https://th.bing.com/th?id=OIP.InKvUSEGq1ZVmF1-PiX8YQAAAA&w=250&h=250&c=8&rs=1&qlt=90&o=6&cb=13&pid=3.1&rm=2" class="w-5 h-5 rounded-full" alt="KEMENDIKBUD">
                <p class="text-xs font-bold ">KEMENDIKBUD</p>
              </div>
        </div>     
        </div>
        <div id="popup" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-md hidden flex items-center justify-center" style="width: 81%; right: 0; left: auto;">
            <div class="bg-white w-2/3 p-6 rounded-lg shadow-lg p-5">
                <div class="p-3">
                    <div class="basic-1/2 flex flex-row justify-left gap-20">
                        <div class="flex flex-col items-start gap-3">
                            <p class="text-lg font-bold">Filter</p>
                            
                            <!-- Pendidikan Section -->
                            <p class="text-basic font-bold">Pendidikan</p>
                            <div class="flex flex-row items-start gap-5">
                                <div class="flex flex-col items-center">
                                    <button id="d3" onclick="toggleSelection('d3')" 
                                        style="border: 2px solid #F97316; padding: 8px; border-radius: 50%; cursor: pointer; transition: 0.3s; width: 80px; height: 80px; background-color: white;">
                                        D3
                                    </button>
                                    <p class="text-basic">Diploma 3</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <button id="d4" onclick="toggleSelection('d4')" 
                                        style="border: 2px solid #F97316; padding: 8px; border-radius: 50%; cursor: pointer; transition: 0.3s; width: 80px; height: 80px; background-color: white;">
                                        D4
                                    </button>
                                    <p class="text-basic">Diploma 4</p>
                                </div>
                            </div>
                            
                            <hr style="width: 100%; border: 1px solid #000000; margin: 10px 0;" />

                            <!-- Tipe Beasiswa Section -->
                            <p class="text-basic font-bold">Tipe Beasiswa</p>
                            <div class="flex flex-row items-start gap-5">
                                <div class="flex flex-col items-center">
                                    <button id="half" onclick="toggleSelection('half')" 
                                        style="border: 2px solid #F97316; padding: 8px; border-radius: 50%; cursor: pointer; transition: 0.3s; width: 80px; height: 80px; background-color: white;">
                                        <img src="half-icon.png" alt="half" style="height: 24px; width: 24px;" />
                                    </button>
                                    <p class="text-basic">Half</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <button id="full" onclick="toggleSelection('full')" 
                                        style="border: 2px solid #F97316; padding: 8px; border-radius: 50%; cursor: pointer; transition: 0.3s; width: 80px; height: 80px; background-color: white;">
                                        <img src="full-icon.png" alt="full" style="height: 24px; width: 24px;" />
                                    </button>
                                    <p class="text-basic">Full</p>
                                </div>
                            </div>
                        </div>                      
                          
                        <div class="basic-1/2">
                            <div class="flex flex-col items-start gap-3">
                                <p class="text-lg font-bold">Tipe Beasiswa</p>
                            
                                <!-- Essay Button and Label -->
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <button id="essay" onclick="toggleSelection('essay')" 
                                        style="border: 2px solid #F97316; padding: 8px; border-radius: 50%; cursor: pointer; transition: 0.3s; width: 40px; height: 40px; background-color: white;">
                                    </button>
                                    <label for="essay" onclick="toggleSelection('essay')" style="cursor: pointer; color: #6B7280;">
                                        Essay
                                    </label>
                                </div>
                            
                                <!-- Prestasi Button and Label -->
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <button id="prestasi" onclick="toggleSelection('prestasi')" 
                                        style="border: 2px solid #F97316; padding: 8px; border-radius: 50%; cursor: pointer; transition: 0.3s; width: 40px; height: 40px; background-color: white;">
                                    </button>
                                    <label for="prestasi" onclick="toggleSelection('prestasi')" style="cursor: pointer; color: #6B7280;">
                                        Prestasi
                                    </label>
                                </div>
                            
                                <!-- Nilai / Transkrip Nilai Button and Label -->
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <button id="nilai" onclick="toggleSelection('nilai')" 
                                        style="border: 2px solid #F97316; padding: 8px; border-radius: 50%; cursor: pointer; transition: 0.3s; width: 40px; height: 40px; background-color: white;">
                                    </button>
                                    <label for="nilai" onclick="toggleSelection('nilai')" style="cursor: pointer; color: #6B7280;">
                                        Nilai / Transkrip Nilai
                                    </label>
                                </div>
                            
                                <!-- TOEFL Button and Label -->
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <button id="toefl" onclick="toggleSelection('toefl')" 
                                        style="border: 2px solid #F97316; padding: 8px; border-radius: 50%; cursor: pointer; transition: 0.3s; width: 40px; height: 40px; background-color: white;">
                                    </button>
                                    <label for="toefl" onclick="toggleSelection('toefl')" style="cursor: pointer; color: #6B7280;">
                                        TOEFL
                                    </label>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
                <button onclick="hidePopup()" class="mt-4 bg-red-500 text-white py-2 px-4 rounded">Close</button>
                <button onclick="runFilter()" class="mt-4 bg-green-500 text-white py-2 px-4 rounded">Filter</button>
            </div>
        </div>
        
            <div class="hidden absolute top-12 right-5 w-96 bg-white shadow-lg rounded-lg p-5" id="notificationPopup">
                <h3 class="text-xl font-semibold mb-1">Notifikasi</h3>
                <p class="text-sm text-gray-500 mb-4">Tetap update dengan notifikasi terbaru</p>
                
                <!-- Tabs for notification types -->
                <div class="flex flex-row justify-between items-center border-b mb-4">
                    <div>
                        <button class="text-xs text-green-600 font-semibold border-b-2 border-green-600 pb-1 active" id="showAllButton" onclick="showAll()" style="color: #38a169; border-bottom: 2px solid #38a169;">Semua</button>
                        
                    </div>
                    <button class="text-gray-500 relative" id="unreadCount" onclick="showUnread()">
                        <span class=" text-xs animate-text" id="unreadText" style="transition: transform 0.3s ease;">Belum Dibaca (0)</span>
                    </button>
                    <button class="text-xs text-gray-500 flex items-center" onclick="markAllAsRead()">
                        <i class="fa fa-check-circle"></i> Tandai semua telah dibaca
                    </button>
                </div>
                
                <!-- Notifications using Grid -->
                <div class="grid grid-cols-1 gap-4" id="notificationList">
                    <!-- Placeholder for notifications -->
                </div>
            </div>

@endsection
