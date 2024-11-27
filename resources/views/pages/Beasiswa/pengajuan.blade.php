@extends('layouts.main')

@section('content')
    @include('component.navbar', ['path' => 'List Beasiswa', 'id' => null])

    <div class="max-w-10xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="container px-4 py-6 sm:px-0">
            <h2 class="text-3xl font-bold mb-6">Data Pribadi Mahasiswa</h2>

            <!-- Profile Card -->
            <div class="bg-white p-6 border-2 border-t-0 border-r-0 border-l-0 border-orange-300 mb-6">
                <div class="flex items-center">
                    <div class="w-20 h-20 rounded-full bg-gray-300 mr-6"></div>
                    <div>
                        <h3 class="text-xl font-bold">Daiva Raditya Pradipa</h3>
                        <p class="text-lg text-gray-700">D3 - Teknik Informatika</p>
                        <p class="text-sm text-gray-500">Teknik Komputer dan Informatika</p>
                    </div>
                </div>
            </div>

            <!-- Student Information -->
            <div class="container p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nama Depan</label>
                        <p class="mt-1 text-base text-gray-800">Daiva Raditya</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nama Belakang</label>
                        <p class="mt-1 text-base text-gray-800">Pradipa</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Alamat Email</label>
                        <p class="mt-1 text-base text-gray-800">daiva.raditya.tif23@polban.ac.id</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nomor Telepon</label>
                        <p class="mt-1 text-base text-gray-800">+62 821-212-212</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">NIM</label>
                        <p class="mt-1 text-base text-gray-800">231511038</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Status Mahasiswa</label>
                        <p class="mt-1 text-base text-gray-800">Mengikuti Perkuliahan di Kelas</p>
                    </div>
                </div>
            </div>

            <!-- Notification -->
            <div class="bg-yellow-100 p-4 border border-yellow-300 rounded-lg text-sm text-yellow-800 mb-10">
                Silakan cermati dengan seksama data pribadi Anda. Jika terdapat kekeliruan pada data pribadi Anda, silakan
                update pada menu <a href="#" class="font-medium underline">Profil Mahasiswa</a> → <span
                    class="font-medium underline">Data Pribadi</span>. Jika terdapat kekeliruan pada status mahasiswa Anda,
                silakan hubungi BAAK.
            </div>

            <!-- Title -->
            <h2 class="text-3xl font-bold mb-6">Lampiran Dokumen</h2>

            <!-- Document Fields -->
            <div class="container">
                <!-- Kartu Tanda Mahasiswa -->
                <div class="group">
                    <div class="flex items-center border p-4 bg-white rounded-lg drop-shadow-lg relative cursor-pointer" onclick="toggleUpload(1)">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAodJREFUWEftlkuojVEUx383Bt4GJl55pZDERKSUDIiBgfI2MpPE0GPgMfAaYaCQEgojYYBSpJQBE+UtRSTd65VIUey/1lfL7uzzfft+hy6dVaf2/vZae//OWmuvtTvoYdLRw3hoA5VFpO2h/9pDfYDpwHhgJNCr7N+69e/APeA+8KiZXZUcmgbsAhZkADRTfQosB+40UioDOgSsbRFIvM1G4ED8MQU0GLgCzIgMnjjXf8sEHRDCtQIY7uwWhjMu+X1SQDeA2U7xIrAeeJ4JEasPCkBHgGW28AaYBLwvFBsBbbacKXT2AptqgsTmt5z3NwAHU0D9gBfAEFM4Y24u9EfYXO7PkeuAfoXMBy7b5DSwMgW0Bjhmi2+BscAnm68GDgOCzpUdwWC7M1LoPtpcDhidAhK16CVbgN02ngXczKVw+jHQUOC1rb+yuvZrGueQknaUKU4Irnxs42vB5XNs/A444f5hFc44ZIuA82aoC6N5Q6Afbve+IZm/2tx/1614WIWiic5dYIqt7wS2pYAUV8VX0h/4YuMPgGqTpA6Q9jgaatkSt6/AXqaAHgATbXGy9R5NVSTn2fcu4DjwOcNLvUOYx1nYhzm7xcA5v0+cQ6eAVaaw1dUjFUkVy1ZKpdahpqe6IOm0a194QmuqsgNrUj2zSn270T6xh/TEUDdWAZT8VrSsD80NIRsDKAxVRX1Pzw+lRPbzQwXwpDtpD6B28lck1VzPhoRe6gguhBCu87fhT9GlgHTlr4Z+MzM6WIWyePnpFVhV4sKYtCt7oO0PTwN147oSt45uA8lwamio+1wd6g5cS4EKAHVkXX21lFxpWchyD66tX5ZDtQ/I3aANVOaxtof+OQ/9BMebaiVc4cz0AAAAAElFTkSuQmCC" class="h-6 w-6 mr-4" alt="Upload Icon" />
                        <p class="text-gray-700">Kartu Tanda Mahasiswa (KTM)</p>
                    </div>

                    <!-- Upload Section (Hidden by default) -->
                    <div class="hidden" id="upload-section-1">
                        <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                            <div class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                <label for="file-upload-1" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah berkas</p>
                                    <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                </label>
                            </div>
                            <input id="file-upload-1" name="file-upload-1" type="file" accept=".pdf" class="hidden" onchange="uploadFile(1)">
                        </div>
                    </div>

                    <!-- Display Uploaded File -->
                    <div class="hidden flex items-center border p-4 bg-white drop-shadow-lg" id="file-display-1">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAchJREFUWEft2M+LTlEcx/HXU1ixQkQhGzVY2Vopk2ajWDClZGGWk4iV/Eg2YjM7G2NpGmWNBbOwkZ2wkJWVjD8AC+7Reer0eO69nTv3Ts9Tz6lb93a+3+9538/3/O4ZsdIbMR5jBbQT9zCNHZlK3sCdTJ9/5lUKPcGZJkGjz3XczfWvAvqObbkBB+yv4n5OjCqgPzmBou1iTPHuxDcLqm2gW3iMN2gE1QXQbextCtU2UIAJKoXSCKpLoEZQXQNlQ60HUBnU0LbbBlrB65LpYh/OJ3XrApQzdU2A6tSaKDRRqE6Buvo196F0ndqDZ/iMs8VGbCMO4hyu4AMOJURhfbs5QNgKUNhFvsUJbMGFCPQTX3EU8zgZAR/iQLElCZNiWGzT0grQI7wvntPYj2MJ0CZcwstCnaeYwhx2RftUsdLtc87S0U9ZUGYGC3gVgX5jQwRaxouYsj7QKRzuQqGQsk9J4KUI9Asfo2Kh8ctRoXc4UtK7W0lZGdDmpFNfxJf43SlQ3TDOrV+zQrkN1tmPP9Aqttb9ZsP6H2WH0C6P0lWsYXDMDjOoAgqXDQ+K89VxbG+oxKDbNzzHNYT3/8pYXce0JEpemJFT6C9szWMlYgN/uAAAAABJRU5ErkJggg==" class="h-6 w-6 mr-4" alt="Upload Icon"/>
                        <p class="text-gray-700" id="file-name-display-1">Nama file</p>

                        <button onclick="viewFile(1)" class="ml-auto p-2 text-blue-500 hover:text-blue-700">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAvZJREFUWEftl1moT1EUxn+XZColRPFAyJBHIg8oESljiQciUshVShGhEA+GUIZMoRBlfJApT8iDoZQiszzwZi7z+W7r/Nvt9j77HE+3/Hed7r1nr7X2d7717W/v20AzGw3NDA91QKmO1Bn6rxjqAPSyp6d9+UvgBfAc+JRiIzRfVUNDgEn2DEos+BA4Z8+9suDKAhIDJ4GhZQt7cTeBmcCbVH4ZQIuBLUAbr9gX4BbwDnhrc92BrsBwoL0X/xVoBA4WgSoC1BLYl33VPK/A6Uw3R4CrwPdI8dYZ2LHAfGCiF7MLWAr8qaIhgbkIjHeSblghaaPKGAzsMNbyvFPAjBCoGEOHgLmW/Stry0JgfwTFaEBi/2CsPQ3EaR2xsg1qx9VmYKUfGwI0CzhqgaJ1CnA+sEg74LjtOHdaGlkCfAvkzAEOO+/HAZfdOB+QFpGXdLGg1cDGCDPa0rKA0BAo6Sc0dhpgzT0BBgC/80Af0Lqsr2tt8jEw0A12qqtN1xJC6guE2tcWeA10tvwFrhxcQC2A90AnC5wOaEeFxgpgUwLQoswC9kRipMndNidwcvwmllxA+l2ekrdrNnCsRMEYriJArpZEQrd8x/ktWwVscJD3Bn4GVtT7UDvc0FjLWtlZ18OCl5vxNv3pA5IbayE5rsb6jMo1EQoOBEwzDy0S9VZgmQW+AgT8R0zUeu9ue/09DTgTACVxynV9Jy/a9pKBXD4fU4Gzbu2YMcor1GeNlDH2AcZY7JXsg54FwIeMcbvDVC0lBkh9VvFRTvHrdjg+iqk48l5Hh5gc5szLaMVOzX+KWpbPySQvASO8hU6Yk8uHQoJXuLSoc1DtnODlXzAZBHNT1w9dISReHYT++AjcNu/S9UOsavvq0fVDGvPHXnPp2IeU/r9sZLaQivWv2K48/A6ge9XdVH6KIX8DSAeT7Qzrlyj+wA5l6eV+CkgZDaVqdAR0tc0f3Qx0udfhrJ+fUwVC81UY+pf6lXPqgFKU1RmqM5RiIDX/F3R9hyVaWP2gAAAAAElFTkSuQmCC" alt="View PDF" class="h-6 w-6"/>
                            <span class="sr-only">View PDF 1</span>
                        </button>

                        <!-- Delete Button -->
                        <button onclick="deleteFile(1)" class="ml-4 p-2 text-red-500 hover:text-red-700">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAQVJREFUWEftmEkOgkAQRR+JHsbpQp5BV7pX18aVnsHE6zgexo1gICFMVdVgoqZ6Q4Cqz88reoz4shZ9mR9+3tAUWAAToC/QfQIXYAcctZWwEBoBV61wIW4M3DS5FkMzYK8RrYiZAwdNrsXQGlilopv4mtw3NWv8W8sNSWWrIpRHLeW3fV8qvRsqIFURyucE9ZSKOqp1pF6mFupqCPgbQ3XkrM9LYEMJWT+sLr0biqerxnnQCTmhmjWT97Js9Wgdn3xglMh1Rsi6Uvz4T+2GMgJtNod1FBs3jdJcNgDu1voI8UPgURcjGUrykgOGZXrA0As0lxw8nIEtcGrS0BgK9BCW5oYkbi9eAJol5c0C8QAAAABJRU5ErkJggg==" alt="Delete File" class="h-6 w-6"/>
                            <span class="sr-only">Delete PDF 1</span>
                        </button>

                        <!-- PDF Viewer Modal -->
                        <div id="pdf-viewer" class="fixed inset-0 bg-gray-800 bg-opacity-75 hidden items-center justify-center z-50">
                            <div class="relative w-full max-w-4xl h-full p-4 bg-white rounded shadow-lg overflow-x-auto">
                                <!-- Close Button -->
                                <button onclick="closePdfViewer()" class="absolute top-2 right-2 text-gray-600">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAA7hJREFUWEfVl1moTlEYhh9TZpnHG6TMuZGiDCFDmYuQKSHzVJJc4EZyYZ6HiMwkInNRhjKmhCRkiMwyJtN+9S2ts+z97/8cdc6x6r/4917rW8/6hvdbuwiFbBQpZDz8N0CdgZMF4b04D80F5gArgEn5DRUC9QIOeBArgYn5CRXnoVXAOA9iPTAmv6CSklrhmpDiqSpAd6CBzXsL3AceAPeA93k5RKYqi4PaDMwGWgG1Uza8buE/CFzJFi6t7MPwZWs3nHcOGAQ8SjOQBqT3d7yw+Pa+AlctRA+jyvwJ1AFqAG2AssHmnywN5OXEkQmoBLAFGBiz+gLQEfiSYLkk0AUYFUGrcv2xBJhuB/hreRKQTncI6OCteA1U9v7vA84CfYBmBnce2BZIR0tgqXnNLd8ZeX5wHFQS0I7AMyr9yYAM9U7LA2BrVGnDvHnaZwqwCP60qwXArNBWHNBwwI+zYt/UcqU4sAvolwJV3yQgnDYC2OQ97Bp57rg/KQRSSKQlFQJLT4B2pi+C2g30zQDV0IohbsoyryWpYBoDP9zEEEhunGkvJW4Vvbx5ajklI8WA7cCABKjLwAmgDDA1mFPaDq1q1FDib4wDKhr1rZdRAlayl0pWQZ32oJ4b1K0soGTmTVAIbl+1JmmchiSjnvOS7yEBPQOq2USdfg/QPIB6YSV/w6CUwBK9uKG51WNeqGEvt+faU/r1O2xhyJT1823iTaAF8M2gTnmwkgDpkNqDwpcEpYRV4vqjpuVXeXuo6868pBwqZWGqZRMWm4jpr5LvjAelcHSKZOCaQUlEpS3+kOckFf5Qlbrce2Xh+tOI48p+qCm0MyKllpE4qHcGpeYpW4Ia4u0ukZSMfLdnC4EZ3vv+kaju9WmThFEhcIbVsyRqa2yhSloKXdX+f7DwXTIoVZ/fbvabLdn09WttlLNjw/xKAlIfO2Knd2t0jZABlX8jg9KdSENQuhsJVDYlfvKMGwqvq149O2Yt569emKm5SkOOAm09w/KWKk+tRBcyJa2roo9AN4MqZ+9ahx6wsI70wphjStr1Q012Q0LHV/UpKZ3AyfDnSOge23UlzvbtSOWbJHV6GUgDcvTtLYcUqn8dq4HxSUayBXLwCkFP81jdDGS6rF20a4huDqosHyLxayY3QOH+SlJBuZ8g1GrUnO9a+Pw1flPV89jvvn8Bykvo1gGjvYW6PU7LRofyslm2a8KvmR7AYbc4vz3k9nWeytHHclNl2Z4+N/P0EZDjtljQQLHwBRWyRE8WOqBf1NW6JS3K+t8AAAAASUVORK5CYII=" alt="View PDF" class="h-6 w-6"/>
                                </button>
                                <!-- PDF iframe -->
                                <iframe id="pdf-iframe" src="" width="100%" height="600px" frameborder="0" class="w-full h-full"></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="flex" id="progress-bar-container-1" style="display: none;">
                        <div class="progress-bar" style="width: 100%; background-color: #f3f4f6; height: 10px; margin: 10px 6px;">
                            <div class="progress h-full bg-gradient-to-r from-blue-500 to-orange-500" id="progress-1" style="width: 0%; height: 100%; background-color: #3B3BBD; border-radius: 5px;"></div>
                        </div>
                    </div>

                    <!-- Uploaded Files Container -->
                    <div id="uploaded-files-1"></div>
                </div>

                <!-- Curriculum Vitae -->
                <div class="group">
                    <div class="flex items-center border p-4 bg-white rounded-lg drop-shadow-lg relative cursor-pointer mt-8" onclick="toggleUpload(2)">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAodJREFUWEftlkuojVEUx383Bt4GJl55pZDERKSUDIiBgfI2MpPE0GPgMfAaYaCQEgojYYBSpJQBE+UtRSTd65VIUey/1lfL7uzzfft+hy6dVaf2/vZae//OWmuvtTvoYdLRw3hoA5VFpO2h/9pDfYDpwHhgJNCr7N+69e/APeA+8KiZXZUcmgbsAhZkADRTfQosB+40UioDOgSsbRFIvM1G4ED8MQU0GLgCzIgMnjjXf8sEHRDCtQIY7uwWhjMu+X1SQDeA2U7xIrAeeJ4JEasPCkBHgGW28AaYBLwvFBsBbbacKXT2AptqgsTmt5z3NwAHU0D9gBfAEFM4Y24u9EfYXO7PkeuAfoXMBy7b5DSwMgW0Bjhmi2+BscAnm68GDgOCzpUdwWC7M1LoPtpcDhidAhK16CVbgN02ngXczKVw+jHQUOC1rb+yuvZrGueQknaUKU4Irnxs42vB5XNs/A444f5hFc44ZIuA82aoC6N5Q6Afbve+IZm/2tx/1614WIWiic5dYIqt7wS2pYAUV8VX0h/4YuMPgGqTpA6Q9jgaatkSt6/AXqaAHgATbXGy9R5NVSTn2fcu4DjwOcNLvUOYx1nYhzm7xcA5v0+cQ6eAVaaw1dUjFUkVy1ZKpdahpqe6IOm0a194QmuqsgNrUj2zSn270T6xh/TEUDdWAZT8VrSsD80NIRsDKAxVRX1Pzw+lRPbzQwXwpDtpD6B28lck1VzPhoRe6gguhBCu87fhT9GlgHTlr4Z+MzM6WIWyePnpFVhV4sKYtCt7oO0PTwN147oSt45uA8lwamio+1wd6g5cS4EKAHVkXX21lFxpWchyD66tX5ZDtQ/I3aANVOaxtof+OQ/9BMebaiVc4cz0AAAAAElFTkSuQmCC" class="h-6 w-6 mr-4" alt="Upload Icon" />
                        <p class="text-gray-700">Curriculum Vitae</p>
                    </div>

                    <!-- Upload Section (Hidden by default) -->
                    <div class="hidden" id="upload-section-2">
                        <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                            <div class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                <label for="file-upload-2" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah berkas</p>
                                    <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                </label>
                            </div>
                            <input id="file-upload-2" name="file-upload-2" type="file" accept=".pdf" class="hidden" onchange="uploadFile(2)">
                        </div>
                    </div>

                        <!-- Display Uploaded File -->
                    <div class="hidden flex items-center border p-4 bg-white drop-shadow-lg" id="file-display-2">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAchJREFUWEft2M+LTlEcx/HXU1ixQkQhGzVY2Vopk2ajWDClZGGWk4iV/Eg2YjM7G2NpGmWNBbOwkZ2wkJWVjD8AC+7Reer0eO69nTv3Ts9Tz6lb93a+3+9538/3/O4ZsdIbMR5jBbQT9zCNHZlK3sCdTJ9/5lUKPcGZJkGjz3XczfWvAvqObbkBB+yv4n5OjCqgPzmBou1iTPHuxDcLqm2gW3iMN2gE1QXQbextCtU2UIAJKoXSCKpLoEZQXQNlQ60HUBnU0LbbBlrB65LpYh/OJ3XrApQzdU2A6tSaKDRRqE6Buvo196F0ndqDZ/iMs8VGbCMO4hyu4AMOJURhfbs5QNgKUNhFvsUJbMGFCPQTX3EU8zgZAR/iQLElCZNiWGzT0grQI7wvntPYj2MJ0CZcwstCnaeYwhx2RftUsdLtc87S0U9ZUGYGC3gVgX5jQwRaxouYsj7QKRzuQqGQsk9J4KUI9Asfo2Kh8ctRoXc4UtK7W0lZGdDmpFNfxJf43SlQ3TDOrV+zQrkN1tmPP9Aqttb9ZsP6H2WH0C6P0lWsYXDMDjOoAgqXDQ+K89VxbG+oxKDbNzzHNYT3/8pYXce0JEpemJFT6C9szWMlYgN/uAAAAABJRU5ErkJggg==" class="h-6 w-6 mr-4" alt="Upload Icon"/>
                        <p class="text-gray-700" id="file-name-display-2">Nama file</p>

                        <button onclick="viewFile(2)" class="ml-auto p-2 text-blue-500 hover:text-blue-700">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAvZJREFUWEftl1moT1EUxn+XZColRPFAyJBHIg8oESljiQciUshVShGhEA+GUIZMoRBlfJApT8iDoZQiszzwZi7z+W7r/Nvt9j77HE+3/Hed7r1nr7X2d7717W/v20AzGw3NDA91QKmO1Bn6rxjqAPSyp6d9+UvgBfAc+JRiIzRfVUNDgEn2DEos+BA4Z8+9suDKAhIDJ4GhZQt7cTeBmcCbVH4ZQIuBLUAbr9gX4BbwDnhrc92BrsBwoL0X/xVoBA4WgSoC1BLYl33VPK/A6Uw3R4CrwPdI8dYZ2LHAfGCiF7MLWAr8qaIhgbkIjHeSblghaaPKGAzsMNbyvFPAjBCoGEOHgLmW/Stry0JgfwTFaEBi/2CsPQ3EaR2xsg1qx9VmYKUfGwI0CzhqgaJ1CnA+sEg74LjtOHdaGlkCfAvkzAEOO+/HAZfdOB+QFpGXdLGg1cDGCDPa0rKA0BAo6Sc0dhpgzT0BBgC/80Af0Lqsr2tt8jEw0A12qqtN1xJC6guE2tcWeA10tvwFrhxcQC2A90AnC5wOaEeFxgpgUwLQoswC9kRipMndNidwcvwmllxA+l2ekrdrNnCsRMEYriJArpZEQrd8x/ktWwVscJD3Bn4GVtT7UDvc0FjLWtlZ18OCl5vxNv3pA5IbayE5rsb6jMo1EQoOBEwzDy0S9VZgmQW+AgT8R0zUeu9ue/09DTgTACVxynV9Jy/a9pKBXD4fU4Gzbu2YMcor1GeNlDH2AcZY7JXsg54FwIeMcbvDVC0lBkh9VvFRTvHrdjg+iqk48l5Hh5gc5szLaMVOzX+KWpbPySQvASO8hU6Yk8uHQoJXuLSoc1DtnODlXzAZBHNT1w9dISReHYT++AjcNu/S9UOsavvq0fVDGvPHXnPp2IeU/r9sZLaQivWv2K48/A6ge9XdVH6KIX8DSAeT7Qzrlyj+wA5l6eV+CkgZDaVqdAR0tc0f3Qx0udfhrJ+fUwVC81UY+pf6lXPqgFKU1RmqM5RiIDX/F3R9hyVaWP2gAAAAAElFTkSuQmCC" alt="View PDF" class="h-6 w-6"/>
                            <span class="sr-only">View PDF 2</span>
                        </button>

                        <!-- Delete Button -->
                        <button onclick="deleteFile(2)" class="ml-4 p-2 text-red-500 hover:text-red-700">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAQVJREFUWEftmEkOgkAQRR+JHsbpQp5BV7pX18aVnsHE6zgexo1gICFMVdVgoqZ6Q4Cqz88reoz4shZ9mR9+3tAUWAAToC/QfQIXYAcctZWwEBoBV61wIW4M3DS5FkMzYK8RrYiZAwdNrsXQGlilopv4mtw3NWv8W8sNSWWrIpRHLeW3fV8qvRsqIFURyucE9ZSKOqp1pF6mFupqCPgbQ3XkrM9LYEMJWT+sLr0biqerxnnQCTmhmjWT97Js9Wgdn3xglMh1Rsi6Uvz4T+2GMgJtNod1FBs3jdJcNgDu1voI8UPgURcjGUrykgOGZXrA0As0lxw8nIEtcGrS0BgK9BCW5oYkbi9eAJol5c0C8QAAAABJRU5ErkJggg==" alt="Delete File" class="h-6 w-6"/>
                            <span class="sr-only">Delete PDF 2</span>
                        </button>

                        <!-- PDF Viewer Modal -->
                        <div id="pdf-viewer" class="fixed inset-0 bg-gray-800 bg-opacity-75 hidden items-center justify-center z-50">
                            <div class="relative w-full max-w-4xl h-full p-4 bg-white rounded shadow-lg overflow-x-auto">
                                <!-- Close Button -->
                                <button onclick="closePdfViewer()" class="absolute top-2 right-2 text-gray-600">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAA7hJREFUWEfVl1moTlEYhh9TZpnHG6TMuZGiDCFDmYuQKSHzVJJc4EZyYZ6HiMwkInNRhjKmhCRkiMwyJtN+9S2ts+z97/8cdc6x6r/4917rW8/6hvdbuwiFbBQpZDz8N0CdgZMF4b04D80F5gArgEn5DRUC9QIOeBArgYn5CRXnoVXAOA9iPTAmv6CSklrhmpDiqSpAd6CBzXsL3AceAPeA93k5RKYqi4PaDMwGWgG1Uza8buE/CFzJFi6t7MPwZWs3nHcOGAQ8SjOQBqT3d7yw+Pa+AlctRA+jyvwJ1AFqAG2AssHmnywN5OXEkQmoBLAFGBiz+gLQEfiSYLkk0AUYFUGrcv2xBJhuB/hreRKQTncI6OCteA1U9v7vA84CfYBmBnce2BZIR0tgqXnNLd8ZeX5wHFQS0I7AMyr9yYAM9U7LA2BrVGnDvHnaZwqwCP60qwXArNBWHNBwwI+zYt/UcqU4sAvolwJV3yQgnDYC2OQ97Bp57rg/KQRSSKQlFQJLT4B2pi+C2g30zQDV0IohbsoyryWpYBoDP9zEEEhunGkvJW4Vvbx5ajklI8WA7cCABKjLwAmgDDA1mFPaDq1q1FDib4wDKhr1rZdRAlayl0pWQZ32oJ4b1K0soGTmTVAIbl+1JmmchiSjnvOS7yEBPQOq2USdfg/QPIB6YSV/w6CUwBK9uKG51WNeqGEvt+faU/r1O2xhyJT1823iTaAF8M2gTnmwkgDpkNqDwpcEpYRV4vqjpuVXeXuo6868pBwqZWGqZRMWm4jpr5LvjAelcHSKZOCaQUlEpS3+kOckFf5Qlbrce2Xh+tOI48p+qCm0MyKllpE4qHcGpeYpW4Ia4u0ukZSMfLdnC4EZ3vv+kaju9WmThFEhcIbVsyRqa2yhSloKXdX+f7DwXTIoVZ/fbvabLdn09WttlLNjw/xKAlIfO2Knd2t0jZABlX8jg9KdSENQuhsJVDYlfvKMGwqvq149O2Yt569emKm5SkOOAm09w/KWKk+tRBcyJa2roo9AN4MqZ+9ahx6wsI70wphjStr1Q012Q0LHV/UpKZ3AyfDnSOge23UlzvbtSOWbJHV6GUgDcvTtLYcUqn8dq4HxSUayBXLwCkFP81jdDGS6rF20a4huDqosHyLxayY3QOH+SlJBuZ8g1GrUnO9a+Pw1flPV89jvvn8Bykvo1gGjvYW6PU7LRofyslm2a8KvmR7AYbc4vz3k9nWeytHHclNl2Z4+N/P0EZDjtljQQLHwBRWyRE8WOqBf1NW6JS3K+t8AAAAASUVORK5CYII=" alt="View PDF" class="h-6 w-6"/>
                                </button>
                                <!-- PDF iframe -->
                                <iframe id="pdf-iframe" src="" width="100%" height="600px" frameborder="0" class="w-full h-full"></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="flex" id="progress-bar-container-2" style="display: none;">
                        <div class="progress-bar" style="width: 100%; background-color: #f3f4f6; height: 10px; margin: 10px 6px;">
                            <div class="progress h-full bg-gradient-to-r from-blue-500 to-orange-500" id="progress-2" style="width: 0%; height: 100%; background-color: #3B3BBD; border-radius: 5px;"></div>
                        </div>
                    </div>

                    <!-- Uploaded Files Container -->
                    <div id="uploaded-files-2"></div>
                </div>

                <!-- Transkrip Nilai -->
                <div class="group">
                    <div class="flex items-center border p-4 bg-white rounded-lg drop-shadow-lg relative cursor-pointer mt-8" onclick="toggleUpload(3)">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAodJREFUWEftlkuojVEUx383Bt4GJl55pZDERKSUDIiBgfI2MpPE0GPgMfAaYaCQEgojYYBSpJQBE+UtRSTd65VIUey/1lfL7uzzfft+hy6dVaf2/vZae//OWmuvtTvoYdLRw3hoA5VFpO2h/9pDfYDpwHhgJNCr7N+69e/APeA+8KiZXZUcmgbsAhZkADRTfQosB+40UioDOgSsbRFIvM1G4ED8MQU0GLgCzIgMnjjXf8sEHRDCtQIY7uwWhjMu+X1SQDeA2U7xIrAeeJ4JEasPCkBHgGW28AaYBLwvFBsBbbacKXT2AptqgsTmt5z3NwAHU0D9gBfAEFM4Y24u9EfYXO7PkeuAfoXMBy7b5DSwMgW0Bjhmi2+BscAnm68GDgOCzpUdwWC7M1LoPtpcDhidAhK16CVbgN02ngXczKVw+jHQUOC1rb+yuvZrGueQknaUKU4Irnxs42vB5XNs/A444f5hFc44ZIuA82aoC6N5Q6Afbve+IZm/2tx/1614WIWiic5dYIqt7wS2pYAUV8VX0h/4YuMPgGqTpA6Q9jgaatkSt6/AXqaAHgATbXGy9R5NVSTn2fcu4DjwOcNLvUOYx1nYhzm7xcA5v0+cQ6eAVaaw1dUjFUkVy1ZKpdahpqe6IOm0a194QmuqsgNrUj2zSn270T6xh/TEUDdWAZT8VrSsD80NIRsDKAxVRX1Pzw+lRPbzQwXwpDtpD6B28lck1VzPhoRe6gguhBCu87fhT9GlgHTlr4Z+MzM6WIWyePnpFVhV4sKYtCt7oO0PTwN147oSt45uA8lwamio+1wd6g5cS4EKAHVkXX21lFxpWchyD66tX5ZDtQ/I3aANVOaxtof+OQ/9BMebaiVc4cz0AAAAAElFTkSuQmCC" class="h-6 w-6 mr-4" alt="Upload Icon" />
                        <p class="text-gray-700">Transkrip Nilai</p>
                    </div>

                    <!-- Upload Section (Hidden by default) -->
                    <div class="hidden" id="upload-section-3">
                        <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                            <div class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                <label for="file-upload-3" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah berkas</p>
                                    <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                </label>
                            </div>
                            <input id="file-upload-3" name="file-upload-3" type="file" accept=".pdf" class="hidden" onchange="uploadFile(3)">
                        </div>
                    </div>

                    <!-- Display Uploaded File -->
                    <div class="hidden flex items-center border p-4 bg-white drop-shadow-lg" id="file-display-3">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAchJREFUWEft2M+LTlEcx/HXU1ixQkQhGzVY2Vopk2ajWDClZGGWk4iV/Eg2YjM7G2NpGmWNBbOwkZ2wkJWVjD8AC+7Reer0eO69nTv3Ts9Tz6lb93a+3+9538/3/O4ZsdIbMR5jBbQT9zCNHZlK3sCdTJ9/5lUKPcGZJkGjz3XczfWvAvqObbkBB+yv4n5OjCqgPzmBou1iTPHuxDcLqm2gW3iMN2gE1QXQbextCtU2UIAJKoXSCKpLoEZQXQNlQ60HUBnU0LbbBlrB65LpYh/OJ3XrApQzdU2A6tSaKDRRqE6Buvo196F0ndqDZ/iMs8VGbCMO4hyu4AMOJURhfbs5QNgKUNhFvsUJbMGFCPQTX3EU8zgZAR/iQLElCZNiWGzT0grQI7wvntPYj2MJ0CZcwstCnaeYwhx2RftUsdLtc87S0U9ZUGYGC3gVgX5jQwRaxouYsj7QKRzuQqGQsk9J4KUI9Asfo2Kh8ctRoXc4UtK7W0lZGdDmpFNfxJf43SlQ3TDOrV+zQrkN1tmPP9Aqttb9ZsP6H2WH0C6P0lWsYXDMDjOoAgqXDQ+K89VxbG+oxKDbNzzHNYT3/8pYXce0JEpemJFT6C9szWMlYgN/uAAAAABJRU5ErkJggg==" class="h-6 w-6 mr-4" alt="Upload Icon"/>
                        <p class="text-gray-700" id="file-name-display-3">Nama file</p>

                        <button onclick="viewFile(3)" class="ml-auto p-2 text-blue-500 hover:text-blue-700">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAvZJREFUWEftl1moT1EUxn+XZColRPFAyJBHIg8oESljiQciUshVShGhEA+GUIZMoRBlfJApT8iDoZQiszzwZi7z+W7r/Nvt9j77HE+3/Hed7r1nr7X2d7717W/v20AzGw3NDA91QKmO1Bn6rxjqAPSyp6d9+UvgBfAc+JRiIzRfVUNDgEn2DEos+BA4Z8+9suDKAhIDJ4GhZQt7cTeBmcCbVH4ZQIuBLUAbr9gX4BbwDnhrc92BrsBwoL0X/xVoBA4WgSoC1BLYl33VPK/A6Uw3R4CrwPdI8dYZ2LHAfGCiF7MLWAr8qaIhgbkIjHeSblghaaPKGAzsMNbyvFPAjBCoGEOHgLmW/Stry0JgfwTFaEBi/2CsPQ3EaR2xsg1qx9VmYKUfGwI0CzhqgaJ1CnA+sEg74LjtOHdaGlkCfAvkzAEOO+/HAZfdOB+QFpGXdLGg1cDGCDPa0rKA0BAo6Sc0dhpgzT0BBgC/80Af0Lqsr2tt8jEw0A12qqtN1xJC6guE2tcWeA10tvwFrhxcQC2A90AnC5wOaEeFxgpgUwLQoswC9kRipMndNidwcvwmllxA+l2ekrdrNnCsRMEYriJArpZEQrd8x/ktWwVscJD3Bn4GVtT7UDvc0FjLWtlZ18OCl5vxNv3pA5IbayE5rsb6jMo1EQoOBEwzDy0S9VZgmQW+AgT8R0zUeu9ue/09DTgTACVxynV9Jy/a9pKBXD4fU4Gzbu2YMcor1GeNlDH2AcZY7JXsg54FwIeMcbvDVC0lBkh9VvFRTvHrdjg+iqk48l5Hh5gc5szLaMVOzX+KWpbPySQvASO8hU6Yk8uHQoJXuLSoc1DtnODlXzAZBHNT1w9dISReHYT++AjcNu/S9UOsavvq0fVDGvPHXnPp2IeU/r9sZLaQivWv2K48/A6ge9XdVH6KIX8DSAeT7Qzrlyj+wA5l6eV+CkgZDaVqdAR0tc0f3Qx0udfhrJ+fUwVC81UY+pf6lXPqgFKU1RmqM5RiIDX/F3R9hyVaWP2gAAAAAElFTkSuQmCC" alt="View PDF" class="h-6 w-6"/>
                            <span class="sr-only">View PDF 3</span>
                        </button>

                        <!-- Delete Button -->
                        <button onclick="deleteFile(3)" class="ml-4 p-2 text-red-500 hover:text-red-700">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAQVJREFUWEftmEkOgkAQRR+JHsbpQp5BV7pX18aVnsHE6zgexo1gICFMVdVgoqZ6Q4Cqz88reoz4shZ9mR9+3tAUWAAToC/QfQIXYAcctZWwEBoBV61wIW4M3DS5FkMzYK8RrYiZAwdNrsXQGlilopv4mtw3NWv8W8sNSWWrIpRHLeW3fV8qvRsqIFURyucE9ZSKOqp1pF6mFupqCPgbQ3XkrM9LYEMJWT+sLr0biqerxnnQCTmhmjWT97Js9Wgdn3xglMh1Rsi6Uvz4T+2GMgJtNod1FBs3jdJcNgDu1voI8UPgURcjGUrykgOGZXrA0As0lxw8nIEtcGrS0BgK9BCW5oYkbi9eAJol5c0C8QAAAABJRU5ErkJggg==" alt="Delete File" class="h-6 w-6"/>
                            <span class="sr-only">Delete PDF 3</span>
                        </button>

                        <!-- PDF Viewer Modal -->
                        <div id="pdf-viewer" class="fixed inset-0 bg-gray-800 bg-opacity-75 hidden items-center justify-center z-50">
                            <div class="relative w-full max-w-4xl h-full p-4 bg-white rounded shadow-lg overflow-x-auto">
                                <!-- Close Button -->
                                <button onclick="closePdfViewer()" class="absolute top-2 right-2 text-gray-600">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAA7hJREFUWEfVl1moTlEYhh9TZpnHG6TMuZGiDCFDmYuQKSHzVJJc4EZyYZ6HiMwkInNRhjKmhCRkiMwyJtN+9S2ts+z97/8cdc6x6r/4917rW8/6hvdbuwiFbBQpZDz8N0CdgZMF4b04D80F5gArgEn5DRUC9QIOeBArgYn5CRXnoVXAOA9iPTAmv6CSklrhmpDiqSpAd6CBzXsL3AceAPeA93k5RKYqi4PaDMwGWgG1Uza8buE/CFzJFi6t7MPwZWs3nHcOGAQ8SjOQBqT3d7yw+Pa+AlctRA+jyvwJ1AFqAG2AssHmnywN5OXEkQmoBLAFGBiz+gLQEfiSYLkk0AUYFUGrcv2xBJhuB/hreRKQTncI6OCteA1U9v7vA84CfYBmBnce2BZIR0tgqXnNLd8ZeX5wHFQS0I7AMyr9yYAM9U7LA2BrVGnDvHnaZwqwCP60qwXArNBWHNBwwI+zYt/UcqU4sAvolwJV3yQgnDYC2OQ97Bp57rg/KQRSSKQlFQJLT4B2pi+C2g30zQDV0IohbsoyryWpYBoDP9zEEEhunGkvJW4Vvbx5ajklI8WA7cCABKjLwAmgDDA1mFPaDq1q1FDib4wDKhr1rZdRAlayl0pWQZ32oJ4b1K0soGTmTVAIbl+1JmmchiSjnvOS7yEBPQOq2USdfg/QPIB6YSV/w6CUwBK9uKG51WNeqGEvt+faU/r1O2xhyJT1823iTaAF8M2gTnmwkgDpkNqDwpcEpYRV4vqjpuVXeXuo6868pBwqZWGqZRMWm4jpr5LvjAelcHSKZOCaQUlEpS3+kOckFf5Qlbrce2Xh+tOI48p+qCm0MyKllpE4qHcGpeYpW4Ia4u0ukZSMfLdnC4EZ3vv+kaju9WmThFEhcIbVsyRqa2yhSloKXdX+f7DwXTIoVZ/fbvabLdn09WttlLNjw/xKAlIfO2Knd2t0jZABlX8jg9KdSENQuhsJVDYlfvKMGwqvq149O2Yt569emKm5SkOOAm09w/KWKk+tRBcyJa2roo9AN4MqZ+9ahx6wsI70wphjStr1Q012Q0LHV/UpKZ3AyfDnSOge23UlzvbtSOWbJHV6GUgDcvTtLYcUqn8dq4HxSUayBXLwCkFP81jdDGS6rF20a4huDqosHyLxayY3QOH+SlJBuZ8g1GrUnO9a+Pw1flPV89jvvn8Bykvo1gGjvYW6PU7LRofyslm2a8KvmR7AYbc4vz3k9nWeytHHclNl2Z4+N/P0EZDjtljQQLHwBRWyRE8WOqBf1NW6JS3K+t8AAAAASUVORK5CYII=" alt="View PDF" class="h-6 w-6"/>
                                </button>
                                <!-- PDF iframe -->
                                <iframe id="pdf-iframe" src="" width="100%" height="600px" frameborder="0" class="w-full h-full"></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="flex" id="progress-bar-container-3" style="display: none;">
                        <div class="progress-bar" style="width: 100%; background-color: #f3f4f6; height: 10px; margin: 10px 6px;">
                            <div class="progress h-full bg-gradient-to-r from-blue-500 to-orange-500" id="progress-3" style="width: 0%; height: 100%; background-color: #3B3BBD; border-radius: 5px;"></div>
                        </div>
                    </div>

                    <!-- Uploaded Files Container -->
                    <div id="uploaded-files-3"></div>
                </div>

                <!-- Surat Berperilaku Baik -->
                <div class="group">
                    <div class="flex items-center border p-4 bg-white rounded-lg drop-shadow-lg relative cursor-pointer mt-8" onclick="toggleUpload(4)">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAodJREFUWEftlkuojVEUx383Bt4GJl55pZDERKSUDIiBgfI2MpPE0GPgMfAaYaCQEgojYYBSpJQBE+UtRSTd65VIUey/1lfL7uzzfft+hy6dVaf2/vZae//OWmuvtTvoYdLRw3hoA5VFpO2h/9pDfYDpwHhgJNCr7N+69e/APeA+8KiZXZUcmgbsAhZkADRTfQosB+40UioDOgSsbRFIvM1G4ED8MQU0GLgCzIgMnjjXf8sEHRDCtQIY7uwWhjMu+X1SQDeA2U7xIrAeeJ4JEasPCkBHgGW28AaYBLwvFBsBbbacKXT2AptqgsTmt5z3NwAHU0D9gBfAEFM4Y24u9EfYXO7PkeuAfoXMBy7b5DSwMgW0Bjhmi2+BscAnm68GDgOCzpUdwWC7M1LoPtpcDhidAhK16CVbgN02ngXczKVw+jHQUOC1rb+yuvZrGueQknaUKU4Irnxs42vB5XNs/A444f5hFc44ZIuA82aoC6N5Q6Afbve+IZm/2tx/1614WIWiic5dYIqt7wS2pYAUV8VX0h/4YuMPgGqTpA6Q9jgaatkSt6/AXqaAHgATbXGy9R5NVSTn2fcu4DjwOcNLvUOYx1nYhzm7xcA5v0+cQ6eAVaaw1dUjFUkVy1ZKpdahpqe6IOm0a194QmuqsgNrUj2zSn270T6xh/TEUDdWAZT8VrSsD80NIRsDKAxVRX1Pzw+lRPbzQwXwpDtpD6B28lck1VzPhoRe6gguhBCu87fhT9GlgHTlr4Z+MzM6WIWyePnpFVhV4sKYtCt7oO0PTwN147oSt45uA8lwamio+1wd6g5cS4EKAHVkXX21lFxpWchyD66tX5ZDtQ/I3aANVOaxtof+OQ/9BMebaiVc4cz0AAAAAElFTkSuQmCC" class="h-6 w-6 mr-4" alt="Upload Icon" />
                        <p class="text-gray-700">Surat Berperilaku Baik</p>
                    </div>

                    <!-- Upload Section (Hidden by default) -->
                    <div class="hidden" id="upload-section-4">
                        <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                            <div class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                <label for="file-upload-4" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah berkas</p>
                                    <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                </label>
                            </div>
                            <input id="file-upload-4" name="file-upload-4" type="file" accept=".pdf" class="hidden" onchange="uploadFile(4)">
                        </div>
                    </div>

                    <!-- Display Uploaded File -->
                    <div class="hidden flex items-center border p-4 bg-white drop-shadow-lg" id="file-display-4">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAchJREFUWEft2M+LTlEcx/HXU1ixQkQhGzVY2Vopk2ajWDClZGGWk4iV/Eg2YjM7G2NpGmWNBbOwkZ2wkJWVjD8AC+7Reer0eO69nTv3Ts9Tz6lb93a+3+9538/3/O4ZsdIbMR5jBbQT9zCNHZlK3sCdTJ9/5lUKPcGZJkGjz3XczfWvAvqObbkBB+yv4n5OjCqgPzmBou1iTPHuxDcLqm2gW3iMN2gE1QXQbextCtU2UIAJKoXSCKpLoEZQXQNlQ60HUBnU0LbbBlrB65LpYh/OJ3XrApQzdU2A6tSaKDRRqE6Buvo196F0ndqDZ/iMs8VGbCMO4hyu4AMOJURhfbs5QNgKUNhFvsUJbMGFCPQTX3EU8zgZAR/iQLElCZNiWGzT0grQI7wvntPYj2MJ0CZcwstCnaeYwhx2RftUsdLtc87S0U9ZUGYGC3gVgX5jQwRaxouYsj7QKRzuQqGQsk9J4KUI9Asfo2Kh8ctRoXc4UtK7W0lZGdDmpFNfxJf43SlQ3TDOrV+zQrkN1tmPP9Aqttb9ZsP6H2WH0C6P0lWsYXDMDjOoAgqXDQ+K89VxbG+oxKDbNzzHNYT3/8pYXce0JEpemJFT6C9szWMlYgN/uAAAAABJRU5ErkJggg==" class="h-6 w-6 mr-4" alt="Upload Icon"/>
                        <p class="text-gray-700" id="file-name-display-4">Nama file</p>

                        <button onclick="viewFile(4)" class="ml-auto p-2 text-blue-500 hover:text-blue-700">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAvZJREFUWEftl1moT1EUxn+XZColRPFAyJBHIg8oESljiQciUshVShGhEA+GUIZMoRBlfJApT8iDoZQiszzwZi7z+W7r/Nvt9j77HE+3/Hed7r1nr7X2d7717W/v20AzGw3NDA91QKmO1Bn6rxjqAPSyp6d9+UvgBfAc+JRiIzRfVUNDgEn2DEos+BA4Z8+9suDKAhIDJ4GhZQt7cTeBmcCbVH4ZQIuBLUAbr9gX4BbwDnhrc92BrsBwoL0X/xVoBA4WgSoC1BLYl33VPK/A6Uw3R4CrwPdI8dYZ2LHAfGCiF7MLWAr8qaIhgbkIjHeSblghaaPKGAzsMNbyvFPAjBCoGEOHgLmW/Stry0JgfwTFaEBi/2CsPQ3EaR2xsg1qx9VmYKUfGwI0CzhqgaJ1CnA+sEg74LjtOHdaGlkCfAvkzAEOO+/HAZfdOB+QFpGXdLGg1cDGCDPa0rKA0BAo6Sc0dhpgzT0BBgC/80Af0Lqsr2tt8jEw0A12qqtN1xJC6guE2tcWeA10tvwFrhxcQC2A90AnC5wOaEeFxgpgUwLQoswC9kRipMndNidwcvwmllxA+l2ekrdrNnCsRMEYriJArpZEQrd8x/ktWwVscJD3Bn4GVtT7UDvc0FjLWtlZ18OCl5vxNv3pA5IbayE5rsb6jMo1EQoOBEwzDy0S9VZgmQW+AgT8R0zUeu9ue/09DTgTACVxynV9Jy/a9pKBXD4fU4Gzbu2YMcor1GeNlDH2AcZY7JXsg54FwIeMcbvDVC0lBkh9VvFRTvHrdjg+iqk48l5Hh5gc5szLaMVOzX+KWpbPySQvASO8hU6Yk8uHQoJXuLSoc1DtnODlXzAZBHNT1w9dISReHYT++AjcNu/S9UOsavvq0fVDGvPHXnPp2IeU/r9sZLaQivWv2K48/A6ge9XdVH6KIX8DSAeT7Qzrlyj+wA5l6eV+CkgZDaVqdAR0tc0f3Qx0udfhrJ+fUwVC81UY+pf6lXPqgFKU1RmqM5RiIDX/F3R9hyVaWP2gAAAAAElFTkSuQmCC" alt="View PDF" class="h-6 w-6"/>
                            <span class="sr-only">View PDF 4</span>
                        </button>

                        <!-- Delete Button -->
                        <button onclick="deleteFile(4)" class="ml-4 p-2 text-red-500 hover:text-red-700">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAQVJREFUWEftmEkOgkAQRR+JHsbpQp5BV7pX18aVnsHE6zgexo1gICFMVdVgoqZ6Q4Cqz88reoz4shZ9mR9+3tAUWAAToC/QfQIXYAcctZWwEBoBV61wIW4M3DS5FkMzYK8RrYiZAwdNrsXQGlilopv4mtw3NWv8W8sNSWWrIpRHLeW3fV8qvRsqIFURyucE9ZSKOqp1pF6mFupqCPgbQ3XkrM9LYEMJWT+sLr0biqerxnnQCTmhmjWT97Js9Wgdn3xglMh1Rsi6Uvz4T+2GMgJtNod1FBs3jdJcNgDu1voI8UPgURcjGUrykgOGZXrA0As0lxw8nIEtcGrS0BgK9BCW5oYkbi9eAJol5c0C8QAAAABJRU5ErkJggg==" alt="Delete File" class="h-6 w-6"/>
                            <span class="sr-only">Delete PDF 4</span>
                        </button>

                        <!-- PDF Viewer Modal -->
                        <div id="pdf-viewer" class="fixed inset-0 bg-gray-800 bg-opacity-75 hidden items-center justify-center z-50">
                            <div class="relative w-full max-w-4xl h-full p-4 bg-white rounded shadow-lg overflow-x-auto">
                                <!-- Close Button -->
                                <button onclick="closePdfViewer()" class="absolute top-2 right-2 text-gray-600">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAA7hJREFUWEfVl1moTlEYhh9TZpnHG6TMuZGiDCFDmYuQKSHzVJJc4EZyYZ6HiMwkInNRhjKmhCRkiMwyJtN+9S2ts+z97/8cdc6x6r/4917rW8/6hvdbuwiFbBQpZDz8N0CdgZMF4b04D80F5gArgEn5DRUC9QIOeBArgYn5CRXnoVXAOA9iPTAmv6CSklrhmpDiqSpAd6CBzXsL3AceAPeA93k5RKYqi4PaDMwGWgG1Uza8buE/CFzJFi6t7MPwZWs3nHcOGAQ8SjOQBqT3d7yw+Pa+AlctRA+jyvwJ1AFqAG2AssHmnywN5OXEkQmoBLAFGBiz+gLQEfiSYLkk0AUYFUGrcv2xBJhuB/hreRKQTncI6OCteA1U9v7vA84CfYBmBnce2BZIR0tgqXnNLd8ZeX5wHFQS0I7AMyr9yYAM9U7LA2BrVGnDvHnaZwqwCP60qwXArNBWHNBwwI+zYt/UcqU4sAvolwJV3yQgnDYC2OQ97Bp57rg/KQRSSKQlFQJLT4B2pi+C2g30zQDV0IohbsoyryWpYBoDP9zEEEhunGkvJW4Vvbx5ajklI8WA7cCABKjLwAmgDDA1mFPaDq1q1FDib4wDKhr1rZdRAlayl0pWQZ32oJ4b1K0soGTmTVAIbl+1JmmchiSjnvOS7yEBPQOq2USdfg/QPIB6YSV/w6CUwBK9uKG51WNeqGEvt+faU/r1O2xhyJT1823iTaAF8M2gTnmwkgDpkNqDwpcEpYRV4vqjpuVXeXuo6868pBwqZWGqZRMWm4jpr5LvjAelcHSKZOCaQUlEpS3+kOckFf5Qlbrce2Xh+tOI48p+qCm0MyKllpE4qHcGpeYpW4Ia4u0ukZSMfLdnC4EZ3vv+kaju9WmThFEhcIbVsyRqa2yhSloKXdX+f7DwXTIoVZ/fbvabLdn09WttlLNjw/xKAlIfO2Knd2t0jZABlX8jg9KdSENQuhsJVDYlfvKMGwqvq149O2Yt569emKm5SkOOAm09w/KWKk+tRBcyJa2roo9AN4MqZ+9ahx6wsI70wphjStr1Q012Q0LHV/UpKZ3AyfDnSOge23UlzvbtSOWbJHV6GUgDcvTtLYcUqn8dq4HxSUayBXLwCkFP81jdDGS6rF20a4huDqosHyLxayY3QOH+SlJBuZ8g1GrUnO9a+Pw1flPV89jvvn8Bykvo1gGjvYW6PU7LRofyslm2a8KvmR7AYbc4vz3k9nWeytHHclNl2Z4+N/P0EZDjtljQQLHwBRWyRE8WOqBf1NW6JS3K+t8AAAAASUVORK5CYII=" alt="View PDF" class="h-6 w-6"/>
                                </button>
                                <!-- PDF iframe -->
                                <iframe id="pdf-iframe" src="" width="100%" height="600px" frameborder="0" class="w-full h-full"></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="flex" id="progress-bar-container-4" style="display: none;">
                        <div class="progress-bar" style="width: 100%; background-color: #f3f4f6; height: 10px; margin: 10px 6px;">
                            <div class="progress h-full bg-gradient-to-r from-blue-500 to-orange-500" id="progress-4" style="width: 0%; height: 100%; background-color: #3B3BBD; border-radius: 5px;"></div>
                        </div>
                    </div>

                    <!-- Uploaded Files Container -->
                    <div id="uploaded-files-4"></div>
                </div>

                <!-- Surat Pernyataan -->
                <div class="group">
                    <div class="flex items-center border p-4 bg-white rounded-lg drop-shadow-lg relative cursor-pointer mt-8" onclick="toggleUpload(5)">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAodJREFUWEftlkuojVEUx383Bt4GJl55pZDERKSUDIiBgfI2MpPE0GPgMfAaYaCQEgojYYBSpJQBE+UtRSTd65VIUey/1lfL7uzzfft+hy6dVaf2/vZae//OWmuvtTvoYdLRw3hoA5VFpO2h/9pDfYDpwHhgJNCr7N+69e/APeA+8KiZXZUcmgbsAhZkADRTfQosB+40UioDOgSsbRFIvM1G4ED8MQU0GLgCzIgMnjjXf8sEHRDCtQIY7uwWhjMu+X1SQDeA2U7xIrAeeJ4JEasPCkBHgGW28AaYBLwvFBsBbbacKXT2AptqgsTmt5z3NwAHU0D9gBfAEFM4Y24u9EfYXO7PkeuAfoXMBy7b5DSwMgW0Bjhmi2+BscAnm68GDgOCzpUdwWC7M1LoPtpcDhidAhK16CVbgN02ngXczKVw+jHQUOC1rb+yuvZrGueQknaUKU4Irnxs42vB5XNs/A444f5hFc44ZIuA82aoC6N5Q6Afbve+IZm/2tx/1614WIWiic5dYIqt7wS2pYAUV8VX0h/4YuMPgGqTpA6Q9jgaatkSt6/AXqaAHgATbXGy9R5NVSTn2fcu4DjwOcNLvUOYx1nYhzm7xcA5v0+cQ6eAVaaw1dUjFUkVy1ZKpdahpqe6IOm0a194QmuqsgNrUj2zSn270T6xh/TEUDdWAZT8VrSsD80NIRsDKAxVRX1Pzw+lRPbzQwXwpDtpD6B28lck1VzPhoRe6gguhBCu87fhT9GlgHTlr4Z+MzM6WIWyePnpFVhV4sKYtCt7oO0PTwN147oSt45uA8lwamio+1wd6g5cS4EKAHVkXX21lFxpWchyD66tX5ZDtQ/I3aANVOaxtof+OQ/9BMebaiVc4cz0AAAAAElFTkSuQmCC" class="h-6 w-6 mr-4" alt="Upload Icon" />
                        <p class="text-gray-700">Surat Pernyataan</p>
                    </div>

                    <!-- Upload Section (Hidden by default) -->
                    <div class="hidden" id="upload-section-5">
                        <div class="border-t-0 border border-gray-400 p-4 mx-6 mt-0 text-center">
                            <div class="border border-dashed border-2 border-gray-400 p-3 mx-6 mt-0 rounded-lg text-center">
                                <label for="file-upload-5" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Seret dan letakkan atau klik untuk mengunggah berkas</p>
                                    <p class="mt-1 text-xs text-gray-500">Ukuran maksimum file: 10 MB</p>
                                </label>
                            </div>
                            <input id="file-upload-5" name="file-upload-5" type="file" accept=".pdf" class="hidden" onchange="uploadFile(5)">
                        </div>
                    </div>

                    <!-- Display Uploaded File -->
                    <div class="hidden flex items-center border p-4 bg-white drop-shadow-lg" id="file-display-5">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAchJREFUWEft2M+LTlEcx/HXU1ixQkQhGzVY2Vopk2ajWDClZGGWk4iV/Eg2YjM7G2NpGmWNBbOwkZ2wkJWVjD8AC+7Reer0eO69nTv3Ts9Tz6lb93a+3+9538/3/O4ZsdIbMR5jBbQT9zCNHZlK3sCdTJ9/5lUKPcGZJkGjz3XczfWvAvqObbkBB+yv4n5OjCqgPzmBou1iTPHuxDcLqm2gW3iMN2gE1QXQbextCtU2UIAJKoXSCKpLoEZQXQNlQ60HUBnU0LbbBlrB65LpYh/OJ3XrApQzdU2A6tSaKDRRqE6Buvo196F0ndqDZ/iMs8VGbCMO4hyu4AMOJURhfbs5QNgKUNhFvsUJbMGFCPQTX3EU8zgZAR/iQLElCZNiWGzT0grQI7wvntPYj2MJ0CZcwstCnaeYwhx2RftUsdLtc87S0U9ZUGYGC3gVgX5jQwRaxouYsj7QKRzuQqGQsk9J4KUI9Asfo2Kh8ctRoXc4UtK7W0lZGdDmpFNfxJf43SlQ3TDOrV+zQrkN1tmPP9Aqttb9ZsP6H2WH0C6P0lWsYXDMDjOoAgqXDQ+K89VxbG+oxKDbNzzHNYT3/8pYXce0JEpemJFT6C9szWMlYgN/uAAAAABJRU5ErkJggg==" class="h-6 w-6 mr-4" alt="Upload Icon"/>
                        <p class="text-gray-700" id="file-name-display-5">Nama file</p>

                        <button onclick="viewFile(5)" class="ml-auto p-2 text-blue-500 hover:text-blue-700">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAvZJREFUWEftl1moT1EUxn+XZColRPFAyJBHIg8oESljiQciUshVShGhEA+GUIZMoRBlfJApT8iDoZQiszzwZi7z+W7r/Nvt9j77HE+3/Hed7r1nr7X2d7717W/v20AzGw3NDA91QKmO1Bn6rxjqAPSyp6d9+UvgBfAc+JRiIzRfVUNDgEn2DEos+BA4Z8+9suDKAhIDJ4GhZQt7cTeBmcCbVH4ZQIuBLUAbr9gX4BbwDnhrc92BrsBwoL0X/xVoBA4WgSoC1BLYl33VPK/A6Uw3R4CrwPdI8dYZ2LHAfGCiF7MLWAr8qaIhgbkIjHeSblghaaPKGAzsMNbyvFPAjBCoGEOHgLmW/Stry0JgfwTFaEBi/2CsPQ3EaR2xsg1qx9VmYKUfGwI0CzhqgaJ1CnA+sEg74LjtOHdaGlkCfAvkzAEOO+/HAZfdOB+QFpGXdLGg1cDGCDPa0rKA0BAo6Sc0dhpgzT0BBgC/80Af0Lqsr2tt8jEw0A12qqtN1xJC6guE2tcWeA10tvwFrhxcQC2A90AnC5wOaEeFxgpgUwLQoswC9kRipMndNidwcvwmllxA+l2ekrdrNnCsRMEYriJArpZEQrd8x/ktWwVscJD3Bn4GVtT7UDvc0FjLWtlZ18OCl5vxNv3pA5IbayE5rsb6jMo1EQoOBEwzDy0S9VZgmQW+AgT8R0zUeu9ue/09DTgTACVxynV9Jy/a9pKBXD4fU4Gzbu2YMcor1GeNlDH2AcZY7JXsg54FwIeMcbvDVC0lBkh9VvFRTvHrdjg+iqk48l5Hh5gc5szLaMVOzX+KWpbPySQvASO8hU6Yk8uHQoJXuLSoc1DtnODlXzAZBHNT1w9dISReHYT++AjcNu/S9UOsavvq0fVDGvPHXnPp2IeU/r9sZLaQivWv2K48/A6ge9XdVH6KIX8DSAeT7Qzrlyj+wA5l6eV+CkgZDaVqdAR0tc0f3Qx0udfhrJ+fUwVC81UY+pf6lXPqgFKU1RmqM5RiIDX/F3R9hyVaWP2gAAAAAElFTkSuQmCC" alt="View PDF" class="h-6 w-6"/>
                            <span class="sr-only">View PDF 5</span>
                        </button>

                        <!-- Delete Button -->
                        <button onclick="deleteFile(5)" class="ml-4 p-2 text-red-500 hover:text-red-700">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAQVJREFUWEftmEkOgkAQRR+JHsbpQp5BV7pX18aVnsHE6zgexo1gICFMVdVgoqZ6Q4Cqz88reoz4shZ9mR9+3tAUWAAToC/QfQIXYAcctZWwEBoBV61wIW4M3DS5FkMzYK8RrYiZAwdNrsXQGlilopv4mtw3NWv8W8sNSWWrIpRHLeW3fV8qvRsqIFURyucE9ZSKOqp1pF6mFupqCPgbQ3XkrM9LYEMJWT+sLr0biqerxnnQCTmhmjWT97Js9Wgdn3xglMh1Rsi6Uvz4T+2GMgJtNod1FBs3jdJcNgDu1voI8UPgURcjGUrykgOGZXrA0As0lxw8nIEtcGrS0BgK9BCW5oYkbi9eAJol5c0C8QAAAABJRU5ErkJggg==" alt="Delete File" class="h-6 w-6"/>
                            <span class="sr-only">Delete PDF 5</span>
                        </button>

                        <!-- PDF Viewer Modal -->
                        <div id="pdf-viewer" class="fixed inset-0 bg-gray-800 bg-opacity-75 hidden items-center justify-center z-50">
                            <div class="relative w-full max-w-4xl h-full p-4 bg-white rounded shadow-lg overflow-x-auto">
                                <!-- Close Button -->
                                <button onclick="closePdfViewer()" class="absolute top-2 right-2 text-gray-600">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAA7hJREFUWEfVl1moTlEYhh9TZpnHG6TMuZGiDCFDmYuQKSHzVJJc4EZyYZ6HiMwkInNRhjKmhCRkiMwyJtN+9S2ts+z97/8cdc6x6r/4917rW8/6hvdbuwiFbBQpZDz8N0CdgZMF4b04D80F5gArgEn5DRUC9QIOeBArgYn5CRXnoVXAOA9iPTAmv6CSklrhmpDiqSpAd6CBzXsL3AceAPeA93k5RKYqi4PaDMwGWgG1Uza8buE/CFzJFi6t7MPwZWs3nHcOGAQ8SjOQBqT3d7yw+Pa+AlctRA+jyvwJ1AFqAG2AssHmnywN5OXEkQmoBLAFGBiz+gLQEfiSYLkk0AUYFUGrcv2xBJhuB/hreRKQTncI6OCteA1U9v7vA84CfYBmBnce2BZIR0tgqXnNLd8ZeX5wHFQS0I7AMyr9yYAM9U7LA2BrVGnDvHnaZwqwCP60qwXArNBWHNBwwI+zYt/UcqU4sAvolwJV3yQgnDYC2OQ97Bp57rg/KQRSSKQlFQJLT4B2pi+C2g30zQDV0IohbsoyryWpYBoDP9zEEEhunGkvJW4Vvbx5ajklI8WA7cCABKjLwAmgDDA1mFPaDq1q1FDib4wDKhr1rZdRAlayl0pWQZ32oJ4b1K0soGTmTVAIbl+1JmmchiSjnvOS7yEBPQOq2USdfg/QPIB6YSV/w6CUwBK9uKG51WNeqGEvt+faU/r1O2xhyJT1823iTaAF8M2gTnmwkgDpkNqDwpcEpYRV4vqjpuVXeXuo6868pBwqZWGqZRMWm4jpr5LvjAelcHSKZOCaQUlEpS3+kOckFf5Qlbrce2Xh+tOI48p+qCm0MyKllpE4qHcGpeYpW4Ia4u0ukZSMfLdnC4EZ3vv+kaju9WmThFEhcIbVsyRqa2yhSloKXdX+f7DwXTIoVZ/fbvabLdn09WttlLNjw/xKAlIfO2Knd2t0jZABlX8jg9KdSENQuhsJVDYlfvKMGwqvq149O2Yt569emKm5SkOOAm09w/KWKk+tRBcyJa2roo9AN4MqZ+9ahx6wsI70wphjStr1Q012Q0LHV/UpKZ3AyfDnSOge23UlzvbtSOWbJHV6GUgDcvTtLYcUqn8dq4HxSUayBXLwCkFP81jdDGS6rF20a4huDqosHyLxayY3QOH+SlJBuZ8g1GrUnO9a+Pw1flPV89jvvn8Bykvo1gGjvYW6PU7LRofyslm2a8KvmR7AYbc4vz3k9nWeytHHclNl2Z4+N/P0EZDjtljQQLHwBRWyRE8WOqBf1NW6JS3K+t8AAAAASUVORK5CYII=" alt="View PDF" class="h-6 w-6"/>
                                </button>
                                <!-- PDF iframe -->
                                <iframe id="pdf-iframe" src="" width="100%" height="600px" frameborder="0" class="w-full h-full"></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="flex" id="progress-bar-container-5" style="display: none;">
                        <div class="progress-bar" style="width: 100%; background-color: #f3f4f6; height: 10px; margin: 10px 6px;">
                            <div class="progress h-full bg-gradient-to-r from-blue-500 to-orange-500" id="progress-5" style="width: 0%; height: 100%; background-color: #3B3BBD; border-radius: 5px;"></div>
                        </div>
                    </div>

                    <!-- Uploaded Files Container -->
                    <div id="uploaded-files-5"></div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center pt-20 p-3">
                    <button type="submit" id="submit-btn" class="h-10 w-full bg-gray-500 text-white px-4 rounded-lg opacity-50 cursor-not-allowed" disabled>Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>



    <script>
        // Function to toggle visibility of the upload section and initially hide the progress bar
        function toggleUpload(section) {
            // Menampilkan atau menyembunyikan bagian upload berdasarkan section yang diklik
            const uploadSection = document.getElementById(`upload-section-${section}`);
            uploadSection.classList.toggle('hidden');

            // Menyembunyikan file display dan progress bar ketika upload section ditampilkan
            const fileDisplay = document.getElementById(`file-display-${section}`);
            const progressBar = document.getElementById(`progress-bar-container-${section}`);
            fileDisplay.classList.add('hidden');
            progressBar.style.display = 'none';
        }

        function uploadFile(section) {
            const fileInput = document.getElementById(`file-upload-${section}`);
            const fileNameDisplay = document.getElementById(`file-name-display-${section}`);
            const fileDisplay = document.getElementById(`file-display-${section}`);
            const progressBar = document.getElementById(`progress-bar-container-${section}`);
            const progress = document.getElementById(`progress-${section}`);

            const file = fileInput.files[0];
            if (file) {
                // Menampilkan nama file yang di-upload
                fileNameDisplay.textContent = file.name;
                fileDisplay.classList.remove('hidden');
                
                // Menampilkan progress bar
                progressBar.style.display = 'flex';
                
                // Simulasi upload dengan progress
                let progressValue = 0;
                let interval = setInterval(() => {
                    progressValue += 10;
                    if (progressValue >= 100) {
                        clearInterval(interval);
                    }
                    progress.style.width = `${progressValue}%`;
                }, 20); // Progress bertambah setiap 500ms
            }


            // If there are files to upload, proceed with the XMLHttpRequest
            if (filesToUpload) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/pengajuan/store'); // Update with your actual upload endpoint

                // Show progress for each file upload
                xhr.upload.addEventListener('progress', (event) => {
                    if (event.lengthComputable) {
                        const percentComplete = (event.loaded / event.total) * 100;

                        // Update progress bars for each section
                        fileInputs.forEach((_, index) => {
                            const progressBar = document.getElementById(`progress-${index + 1}`);
                            const progressText = document.getElementById(`progress-text-${index + 1}`);
                            progressBar.style.width = percentComplete + '%';
                            progressText.innerText = Math.round(percentComplete) + '%';
                        });
                    }
                });

                // Handle successful upload response
                xhr.onload = () => {
                    if (xhr.status === 200) {
                        fileInputs.forEach((_, index) => {
                            const progressBar = document.getElementById(`progress-${index + 1}`);
                            progressBar.style.width = '100%'; // Ensure the progress bar is filled
                        });
                        alert('Files uploaded successfully!');
                    } else {
                        alert('File upload failed: ' + xhr.responseText);
                    }
                };

                // Handle upload error
                xhr.onerror = () => {
                    alert('An error occurred during the upload.');
                };

                // Send the FormData object with the files
                xhr.send(formData);
            } else {
                alert('No files selected for upload.');
            }
        }

        function viewFile(id) {
            // Mengambil nama file atau path file berdasarkan ID
            const filePath = document.getElementById(`file-name-display-${id}`).innerText;

            // Mengatur src iframe ke path file PDF yang di-upload
            const pdfIframe = document.getElementById('pdf-iframe');
            pdfIframe.src = `/storage/uploads/${filePath}`; // Sesuaikan dengan path file yang disimpan di server

            // Menampilkan modal PDF viewer
            const pdfViewer = document.getElementById('pdf-viewer');
            pdfViewer.classList.remove('hidden');
        }

        function closePdfViewer() {
            const pdfViewer = document.getElementById('pdf-viewer');
            pdfViewer.classList.add('hidden');
            const pdfIframe = document.getElementById('pdf-iframe');
            pdfIframe.src = '';
        }

        function deleteFile(fileNumber) {
            // Reset progress bar
            document.getElementById('progress-' + fileNumber).style.width = '0%';

            // Sembunyikan elemen file display dan progress bar
            document.getElementById('file-display-' + fileNumber).classList.add('hidden');
            document.getElementById('progress-bar-container-' + fileNumber).classList.add('hidden');

            // Tampilkan kembali upload section
            document.getElementById('upload-section-' + fileNumber).classList.remove('hidden');

            // Ganti input file dengan elemen baru untuk reset penuh
            const oldInput = document.getElementById('file-upload-' + fileNumber);
            const newInput = oldInput.cloneNode(true); // Buat elemen baru dengan atribut yang sama
            oldInput.parentNode.replaceChild(newInput, oldInput);

            // Tambahkan kembali event listener untuk elemen input baru
            newInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file && file.type === 'application/pdf') {
                    // Tampilkan progress bar dan sembunyikan upload section
                    const uploadSection = document.getElementById(`upload-section-${fileNumber}`);
                    uploadSection.classList.add('hidden');
                    const progressBarContainer = document.getElementById(`progress-bar-container-${fileNumber}`);
                    progressBarContainer.classList.remove('hidden');
                    
                    // Simulasikan unggahan dengan progress
                    simulateUpload(fileNumber, file.name);
                } else {
                    // Beri peringatan jika file bukan PDF
                    alert('Harap unggah file dengan format PDF.');
                    event.target.value = ''; // Hapus seleksi file
                }
            });
        }



        // Set up file input change event listener to validate for PDF and hide upload section if file is valid
        document.querySelectorAll('input[type="file"]').forEach((input, index) => {
            input.addEventListener('change', function(event) {
                const file = event.target.files[0];

                if (file && file.type === 'application/pdf') {
                    const uploadSection = document.getElementById(`upload-section-${index + 1}`);
                    uploadSection.style.display = 'none'; // Hide upload section after PDF selection
                    const progressBarContainer = document.getElementById(`progress-bar-container-${index + 1}`);
                    progressBarContainer.classList.remove('hidden'); // Show progress bar when PDF is selected
                } else {
                    alert('Please select a PDF file.');
                    event.target.value = ''; // Clear selection if not a PDF
                }
            });
        });
    </script>

@endsection
